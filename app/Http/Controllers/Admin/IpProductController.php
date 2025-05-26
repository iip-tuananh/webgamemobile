<?php

namespace App\Http\Controllers\Admin;

use App\ExcelImports\IpProductImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\IpProduct as ThisModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use \stdClass;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Product;
use App\Helpers\FileHelper;
use App\Model\Admin\Order;
use App\Model\Admin\Ticket;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Model\Common\User;
use App\Model\Common\Notification;
use PDF;

class IpProductController extends Controller
{
    protected $view = 'admin.ip_products';
    protected $route = 'ip_products';
    public function index()
    {
        return view($this->view.'.index');
    }

    public function searchData(Request $request)
    {
        $objects = ThisModel::searchByFilter($request);
        return DataTables::of($objects)
            ->addColumn('ip', function ($object) {
                if ($object->ip == 0) {
                    return '';
                }
                return '<a href="'.route('ip_products.show', $object->id).'" title="'.$object->ip.'">'.$object->ip.'</a> <a class="cursor-pointer ml-1 text-warning" title="Copy" onclick="copyToClipboard(\''.$object->ip.'\')"><i class="fa fa-copy"></i></a>';
            })
            ->addColumn('username', function ($object) {
                return '<span>'.$object->username.'</span> <a class="cursor-pointer ml-1 text-warning" title="Copy" onclick="copyToClipboard(\''.$object->username.'\')"><i class="fa fa-copy"></i></a>';
            })
            ->addColumn('password', function ($object) {
                return '<span>'.$object->password.'</span> <a class="cursor-pointer ml-1 text-warning" title="Copy" onclick="copyToClipboard(\''.$object->password.'\')"><i class="fa fa-copy"></i></a>';
            })
            ->addColumn('plan', function ($object) {
                return $object->product ? $object->product->name : '';
            })
            ->addColumn('sell_price', function ($object) {
                return $object->product ? formatCurrency($object->product->sell_price) . 'đ' : '';
            })
            ->addColumn('location', function ($object) {
                return $object->product ? $object->product->origin : '';
            })
            ->addColumn('start_date', function ($object) {
                return $object->start_date ? formatDate($object->start_date) : '';
            })
            ->addColumn('end_date', function ($object) {
                return $object->end_date ? formatDate($object->end_date) : '';
            })
            ->addColumn('status', function ($object) {
                return getStatus($object->status, ThisModel::STATUES);
            })
            ->addColumn('payment_status', function ($object) {
                return getStatus($object->payment_status, ThisModel::PAYMENT_STATUSES);
            })
            ->addColumn('customer_name', function ($object) {
                if ($object->user) {
                    return '<a href="'.route('User.edit', $object->user->id).'" title="'.$object->user->account_name.'" target="_blank">'.$object->user->account_name.'</a>';
                }
                return '';
            })
            ->addColumn('note', function ($object) {
                if ($object->tickets->count() > 0) {
                    $result = '';
                    foreach ($object->tickets as $ticket) {
                        if ($ticket->ticket && $ticket->ticket->status != Ticket::STATUS_CLOSED) {
                            $result .= '<a href="'.route('Ticket.show', $ticket->ticket->id).'" title="Xem ticket" class="text-primary"><span class="badge badge-warning">'.$ticket->ticket->title.'</span></a><br>';
                        }
                        if ($ticket->ticket && $ticket->ticket->status == Ticket::STATUS_CLOSED && $ticket->ticket->updated_at->addDays(5) > now()) {
                            $result .= '<a href="'.route('Ticket.show', $ticket->ticket->id).'" title="Xem ticket" class="text-danger"><span class="badge badge-success">'.$ticket->ticket->title.' (Đã xử lý)</span></a><br>';
                        }
                    }
                    return $result;
                }
                return $object->note;
            })
            ->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';

                $result = $result . ' <a href="'. route($this->route.'.show', $object->id) .'" title="Xem chi tiết" class="dropdown-item"><i class="fa fa-angle-right"></i>Xem chi tiết</a>';
                // $result = $result . ' <a href="javascript:void(0)" title="Xem lịch sử" class="dropdown-item show-history"><i class="fa fa-angle-right"></i>Xem lịch sử</a>';
                if ($object->canEdit()) {
                    $result = $result . ' <a href="javascript:void(0)" title="Sửa" class="dropdown-item edit"><i class="fa fa-angle-right"></i>Sửa</a>';
                }
                if ($object->canDelete()) {
                    $result = $result . ' <a href="'. route($this->route.'.delete', $object->id) .'" title="Xóa" class="dropdown-item delete"><i class="fa fa-angle-right"></i>Xóa</a>';
                }
                if (\Auth::user()->is_customer) {
                    $result = $result . ' <a href="javascript:void(0)" title="Tạo ticket" class="dropdown-item create-ticket"><i class="fa fa-angle-right"></i>Tạo ticket</a>';
                }
                $result = $result . '</div></div>';
                return $result;
			})
            ->rawColumns(['status', 'payment_status', 'customer_name', 'action', 'ip', 'username', 'password', 'note'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        return view($this->view.'.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'ip' => 'required|max:255|unique:ip_products,ip',
                'product_id' => 'required',
            ]
        );
        $json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
        }

        DB::beginTransaction();
        try {
            $object = new ThisModel();

            $object->ip = $request->ip;
            $object->product_id = $request->product_id;
            $object->data_center = $request->data_center ?? null;
            $object->status = ThisModel::STATUS_INACTIVE;
            $object->username = $request->username ?? 'user';
            $object->password = $request->password ?? '123456';
            $object->save();

            DB::commit();
            $json->success = true;
            $json->message = "Thao tác thành công!";
            $json->data = $object;
            return Response::json($json);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    function update(Request $request, $id)
    {
        $object = ThisModel::findOrFail($id);
        if (!$object->canEdit()) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền truy cập']);
        }
        $validate = Validator::make(
            $request->all(),
            [
                'ip' => 'required|max:255|unique:ip_products,ip,'.$id,
                'product_id' => 'required',
            ]
        );
        $json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
        }

        DB::beginTransaction();
        try {
            $object->ip = $request->ip;
            $object->product_id = $request->product_id;
            $object->data_center = $request->data_center ?? null;
            $object->username = $request->username ?? 'user';
            $object->password = $request->password ?? '123456';
            $object->save();

            DB::commit();
            $json->success = true;
            $json->message = "Thao tác thành công!";
            $json->data = $object;
            return Response::json($json);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function getDataForEdit($id)
    {
        $data = ThisModel::find($id);
        if (!$data->canEdit()) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền truy cập']);
        }
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function show($id)
    {
        $data = ThisModel::with('product')->find($id);
        if (!$data) {
            return view('not_found');
        }
        if (\Auth::user()->id != $data->user_id && \Auth::user()->is_customer) {
            return view('not_found');
        }
        return view($this->view.'.show', compact('data'));
    }

    public function renewMulti(Request $request)
    {
        $ip_product_ids = $request->ip_product_ids;
        $ip_products = ThisModel::whereIn('id', $ip_product_ids)->get();

        $total_price = 0;
        foreach ($ip_products as $ip_product) {
            $total_price += $ip_product->product->sell_price;
        }
        $lastId = Order::query()->latest('id')->first()->id ?? 1;

        $order = new Order();
        $order->code = 'ORDER' . date('Ymd') . '-' . $lastId;
        $order->type = Order::TYPE_RENEW;
        $order->status = Order::DANG_TAO;
        $order->payment_status = Order::UNPAID;
        $order->user_id = Auth::user()->id;
        $order->customer_name = Auth::user()->name;
        $order->customer_phone = Auth::user()->phone_number;
        $order->customer_email = Auth::user()->email ?? null;
        $order->customer_address = Auth::user()->address ?? null;
        $order->customer_required = $request->note ?? null;
        $order->total_before_discount = $total_price;
        $order->total_after_discount = $total_price;
        $order->save();

        foreach ($ip_products as $ip_product) {
            $order->details()->create([
                'order_id' => $order->id,
                'ip_product_id' => $ip_product->id,
                'product_id' => $ip_product->product_id,
                'qty' => 1,
                'price' => $ip_product->product->sell_price,
                'attributes' => null,
            ]);
        }

        if (Auth::user()->is_customer) {
            $users = User::whereIn('type', [User::SUPER_ADMIN, User::QUAN_TRI_VIEN])->get();
            foreach($users as $user) {
                $notification = new Notification();
                $notification->url = route("orders.show", $order->id, false);
                $notification->content = "Đơn hàng mới từ khách hàng <b>" . Auth::user()->name . "</b>";
                $notification->status = 0;
                $notification->receiver_id = $user->id;
                $notification->created_by = Auth::user()->id;
                $notification->save();

                $notification->send();
            }
        }
        return Response::json(['success' => true, 'message' => 'Đơn hàng đã được tạo thành công', 'order_code' => $order->code]);
    }

    // Import Excel
	public function importExcel(Request $request) {
		$validate = Validator::make(
			$request->all(),
			[
                'file' => 'required|file|mimes:xlsx,xls,csv,txt',
			],
			[
				'file.required' => 'Không được để trống',
				'file.file' => 'Không hợp lệ',
				'file.mimes' => 'Không hợp lệ',
			]
		);

		$json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Import thất bại!";
            return Response::json($json);
        }
        DB::beginTransaction();
        try {
			$import = new IpProductImport;
			Excel::import($import, $request->file('file'));

            DB::commit();

            $json->success = true;
            $json->details = [
                'import' => $import->getImportCount(),
                'skip' => $import->getSkipCount(),
                'invalid_rows' => $import->getInvalidRow(),
            ];
            $json->message = "Import thành công!";
            return Response::json($json);
        } catch (Exception $e) {
            DB::rollBack();
            $json->success = false;
            $json->message = "Đã có lỗi xảy ra!";
            return Response::json($json);
        }
	}

    // Xuất PDF
	public function exportPDF(Request $request) {
        // ini_set('max_execution_time', 300);
        // ini_set("memory_limit", "512M");
        $customer = null;
        if ($request->customer_id) {
            $customer = User::where('id', $request->customer_id)->first();
        }

		$data = ThisModel::searchByFilter($request)->with(['user', 'product'])->get();
		$pdf = PDF::loadView($this->view.'.pdf', compact('data', 'customer'))
                ->setPaper('A4', 'portrait')
                ->setOptions(['defaultFont' => 'DejaVu Sans']);
		return $pdf->download('hoa_don_'.date('Ymd').'.pdf');
	}

    public function delete($id)
    {
        $object = ThisModel::findOrFail($id);
        if (!$object->canDelete()) {
            $message = array(
                "message" => "Không thể xóa!",
                "alert-type" => "warning"
            );
        } else {
            $object->delete();
            $message = array(
                "message" => "Thao tác thành công!",
                "alert-type" => "success"
            );
        }

        return redirect()->route($this->route.'.index')->with($message);
    }
}
