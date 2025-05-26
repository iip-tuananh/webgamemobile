<?php

namespace App\Http\Controllers\Admin;

use App\ExcelExports\OrderExcel;
use App\ExcelImports\OrderImport;
use App\Model\Admin\Order;
use Illuminate\Http\Request;
use App\Model\Admin\Order as ThisModel;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use \stdClass;

use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Helpers\FileHelper;
use App\Model\Admin\Category;
use App\Model\Admin\OrderRevenueDetail;
use App\Model\Admin\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\Common\Customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\Common\Notification;
use App\Model\Common\User;
use App\Services\PayosService;

class OrderController extends Controller
{
    protected $payosService;

    public function __construct(PayosService $payosService)
    {
        $this->payosService = $payosService;
    }

    protected $view = 'admin.orders';
    protected $route = 'orders';

    public function index()
    {
        return view($this->view . '.index');
    }

    public function create()
    {
        $categories = Category::with('image')->get();
        return view($this->view . '.create', compact('categories'));
    }

    // Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {
        $objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
            ->addColumn('total_price', function ($object) {
                return number_format($object->total_price);
            })
            ->editColumn('code', function ($object) {
                return '<a href = "'.route('orders.show', $object->id).'" title = "Xem chi tiết">' . $object->code . '</a>';
            })
            ->editColumn('type', function ($object) {
                return getStatus($object->type, ThisModel::TYPES);
            })
            ->editColumn('code_client', function ($object) {
                return '<a href = "javascript:void(0)" title = "Xem chi tiết" class="show-order-client">' . $object->code . '</a>';
            })
            ->editColumn('created_at', function ($object) {
                return $object->type == 0 ? formatDate($object->created_at) : formatDate($object->aff_order_at);
            })
            ->editColumn('payment_status', function ($object) {
                return getStatus($object->payment_status, ThisModel::PAYMENT_STATUSES);
            })
            ->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';
                if (Auth::user()->is_super_admin) {
                    $result = $result . ' <a href="" title="đổi trạng thái" class="dropdown-item update-status"><i class="fa fa-angle-right"></i>Đổi trạng thái</a>';
                    $result = $result . ' <a href="" title="đổi trạng thái thanh toán" class="dropdown-item update-payment-status"><i class="fa fa-angle-right"></i>Đổi trạng thái thanh toán</a>';
                }
                $result = $result . ' <a href="'.route('orders.show', $object->id).'" title="xem chi tiết" class="dropdown-item"><i class="fa fa-angle-right"></i>Xem chi tiết</a>';
                if ($object->canPay() && Auth::user()->is_customer) {
                    $result = $result . ' <a href="'.route('orders.checkout').'?order_code='.$object->code.'" title="thanh toán" class="dropdown-item"><i class="fa fa-angle-right"></i>Thanh toán</a>';
                }
                if (Auth::user()->is_customer && $object->canDelete()) {
                    $result = $result . ' <a href="'.route('orders.delete', $object->id).'" title="xóa" class="dropdown-item"><i class="fa fa-angle-right"></i>Xóa</a>';
                }
                $result = $result . '</div></div>';
                return $result;
            })
            ->addColumn('action_client', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';
                if ($object->type == 0) {
                    $result = $result . ' <a href="" title="Hủy đơn hàng" class="dropdown-item update-status"><i class="fa fa-angle-right"></i>Hủy đơn hàng</a>';
                    $result = $result . ' <a href="'.route('orders.show', $object->id).'" title="xem chi tiết" class="dropdown-item"><i class="fa fa-angle-right"></i>Xem chi tiết</a>';
                }
                $result = $result . '</div></div>';
                return $result;
            })
            ->addIndexColumn()
            ->rawColumns(['code', 'action', 'action_client', 'code_client', 'payment_status', 'type'])
            ->make(true);
    }

    public function store(Request $request) {
        $json = new \stdClass();
        if (!$request->product['id']) {
            $json->success = false;
            $json->message = "Vui lòng chọn sản phẩm!";
            return Response::json($json);
        }
        $product = Product::with([
            'ip_products' => function ($query) {
                $query->where('status', 1);
            }
        ])->where('id', $request->product['id'])->first();
        if (!$product) {
            $json->success = false;
            $json->message = "Không tìm thấy sản phẩm!";
            return Response::json($json);
        }
        $count_ip_product = !Auth::user()->is_customer_vip ? $product->ip_products->count() : 1000;

        $translate = [
            'quantity.min' => 'Không được nhỏ hơn 1',
            'quantity.max' => 'Không được lớn hơn ' . $count_ip_product,
        ];
        $validate = Validator::make(
            $request->all(),
            [
                'quantity' => 'required|numeric|min:1|max:' . $count_ip_product,
            ],
            $translate
        );

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
        }

        $lastId = Order::query()->latest('id')->first()->id ?? 1;

        $order = new Order();
        $order->code = 'ORDER' . date('Ymd') . '-' . $lastId;
        $order->type = $request->type;
        $order->status = Order::DANG_TAO;
        $order->payment_status = Order::UNPAID;
        $order->user_id = Auth::user()->id;
        $order->customer_name = Auth::user()->name;
        $order->customer_phone = Auth::user()->phone_number;
        $order->customer_email = Auth::user()->email ?? null;
        $order->customer_address = Auth::user()->address ?? null;
        $order->customer_required = $request->note ?? null;
        $order->total_before_discount = $request->product['sell_price'] * $request->quantity;
        $order->total_after_discount = $request->product['sell_price'] * $request->quantity;
        $order->save();

        if ($request->product) {
            $order->details()->create([
                'order_id' => $order->id,
                'product_id' => $request->product['id'],
                'qty' => $request->quantity,
                'price' => $request->product['sell_price'],
                'attributes' => $request->product['attributes'] ?? null,
            ]);
        }
        if (Auth::user()->is_customer && $order->status == Order::MOI) {
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

    public function storeCart(Request $request) {
        $json = new \stdClass();
        if (empty($request->product)) {
            $json->success = false;
            $json->message = "Vui lòng kiểm tra lại giỏ hàng!";
            return Response::json($json);
        }
        foreach ($request->product as $key => $product) {
            $product = Product::with([
                'ip_products' => function ($query) {
                    $query->where('status', 1);
                }
            ])->where('id', $product['id'])->first();
            if (!$product) {
                $json->success = false;
                $json->message = "Không tìm thấy sản phẩm!";
                return Response::json($json);
            }
            // $count_ip_product = !Auth::user()->is_customer_vip ? $product->ip_products->count() : 1000;
            $count_ip_product = 1000;

            $translate = [
                'product.' . $key . '.quantity.min' => 'Không được nhỏ hơn 1',
                'product.' . $key . '.quantity.max' => 'Không được lớn hơn ' . $count_ip_product,
            ];
            $validate = Validator::make(
                $request->all(),
                [
                    'product.' . $key . '.quantity' => 'required|numeric|min:1|max:' . $count_ip_product,
                ],
                $translate
            );

            if ($validate->fails()) {
                $json->success = false;
                $json->errors = $validate->errors();
                $json->message = "Thao tác thất bại!";
                return Response::json($json);
            }
        }

        $lastId = Order::query()->latest('id')->first()->id ?? 1;

        $order = new Order();
        $order->code = 'ORDER' . date('Ymd') . '-' . $lastId;
        $order->type = $request->type;
        $order->status = Order::DANG_TAO;
        $order->payment_status = Order::UNPAID;
        $order->user_id = Auth::user()->id;
        $order->customer_name = Auth::user()->name;
        $order->customer_phone = Auth::user()->phone_number;
        $order->customer_email = Auth::user()->email ?? null;
        $order->customer_address = Auth::user()->address ?? null;
        $order->customer_required = $request->note ?? null;
        $order->total_before_discount = $request->total_price;
        $order->total_after_discount = $request->total_price;
        $order->save();

        foreach ($request->product as $key => $product) {
            $order->details()->create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'qty' => $product['quantity'],
                'price' => $product['price'],
                'attributes' => null,
            ]);
        }
        \Cart::clear();

        if (Auth::user()->is_customer && $order->status == Order::MOI) {
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

    public function checkout(Request $request) {
        $order = Order::query()->with([
            'details.product',
            'details.ip_product'
        ])->where('payment_status', Order::UNPAID)->where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('customer_email', Auth::user()->email);
        });
        if ($request->order_code) {
            $order = $order->where('code', $request->order_code);
        }
        if ($request->order_id) {
            $order = $order->where('id', $request->order_id);
        }
        $order = $order->first();

        return view($this->view . '.checkout', compact('order'));
    }

    public function cart() {
        $cartCollection = \Cart::getContent();
        $total_price = \Cart::getTotal();
        $total_qty = \Cart::getContent()->sum('quantity');
        return view($this->view . '.cart', compact('cartCollection', 'total_price', 'total_qty'));
    }

    public function show(Request $request, $id) {
        $order = Order::query()->with(['details.product'])->find($id);
//        $order->payment_method_name = Order::PAYMENT_METHODS[$order->payment_method];

        return view($this->view . '.show', compact('order'));
    }

    public function updateStatus(Request $request)
    {
        $order = Order::query()->find($request->order_id);

        $order->status = $request->status;
        $order->save();
        // $order_revenue_details = OrderRevenueDetail::query()->where('order_id', $order->id)->get();
        // foreach ($order_revenue_details as $order_revenue_detail) {
        //     if ($order->status == Order::MOI) {
        //         $order_revenue_detail->status = OrderRevenueDetail::STATUS_PENDING;
        //     } else if ($order->status == Order::DUYET) {
        //         $order_revenue_detail->status = OrderRevenueDetail::STATUS_PAID;
        //     } else if ($order->status == Order::THANH_CONG) {
        //         $order_revenue_detail->status = OrderRevenueDetail::STATUS_WAIT_QUYET_TOAN;
        //     } else if ($order->status == Order::HUY) {
        //         $order_revenue_detail->status = OrderRevenueDetail::STATUS_CANCEL;
        //     }
        //     $order_revenue_detail->save();
        // }

        return Response::json(['success' => true, 'message' => 'cập nhật trạng thái đơn hàng thành công']);
    }

    public function delete(Request $request, $id) {
        $order = Order::query()->find($id);
        if (!$order) {
            return Response::json(['success' => false, 'message' => 'Đơn hàng không tồn tại']);
        }
        if (!$order->canDelete()) {
            return Response::json(['success' => false, 'message' => 'Không có quyền xóa đơn hàng này']);
        }
        $order->details()->delete();
        $order->delete();
        return Response::json(['success' => true, 'message' => 'Đơn hàng đã được xóa thành công']);
    }

    // xóa nhiều đơn hàng
    public function actDelete(Request $request) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $order_ids = explode(',', $request->order_ids);
        foreach ($order_ids as $order_id) {
            $order = ThisModel::findOrFail($order_id);
            if ($order->canDelete()) {
                $order->details()->delete();
                $order->delete();
            }
        }

        $message = array(
            "message" => "Thao tác thành công!",
            "alert-type" => "success"
        );

        return redirect()->route($this->route.'.index')->with($message);
    }

    public function exportList(Request $request) {
        $data = Order::searchByFilter($request)->where('type', 0)->values();
        $result['CHI_TIET'] = Order::getTableList($data);
        $result['COLSPAN'] = 8;
        $result['FROM_DATE'] = $request->startDate ? Carbon::parse($request->startDate)->format('d/m/Y') : '';
        $result['TO_DATE'] = $request->endDate ? Carbon::parse($request->endDate)->format('d/m/Y') : '';

        return (new OrderExcel())
            ->forData($result)
            ->download('danh_sach_don_hang.xlsx');
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
			$import = new OrderImport;
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

    public function createPayment(Request $request)
    {
        $order = Order::query()->find($request->order_id);
        $total_price = intval($order->total_price);
        $paymentData = $this->payosService->createPayment($total_price, $order->code, $order->id);

        if ($paymentData && $paymentData['code'] == '00') {
            return response()->json([
                'success' => true,
                'message' => 'Tạo link thanh toán thành công',
                'data' => $paymentData
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không thể tạo thanh toán',
            'data' => $paymentData
        ]);
    }

    public function handleSuccess(Request $request)
    {
        if (!empty($request->type) && $request->type == 'no_payos_buy_vip') {
            $order = Order::query()->with('details')->where('id', $request->order_id)->first();
            $order->status = Order::MOI;
            $order->save();

            $extend = $order->type == Order::TYPE_RENEW ? true : false;

            $order->updateIpProduct(false, $extend);

            if (Auth::user()->is_customer && $order->status == Order::MOI) {
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
            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng mới được tạo thành công'
            ]);
        } else {
            $order = Order::query()->with('details')->where('id', $request->orderCode)->first();
            if ($request->cancel == true) {
                $order->status = Order::HUY;
                $order->save();
                return redirect()->route('orders.index')->with('messagePayment', 'error', 'Đã hủy thanh toán');
            } else {
                if ($request->status == 'PAID') {
                    $order->payment_status = Order::PAID;
                    $order->status = Order::MOI;
                    $order->save();

                    $extend = $order->type == Order::TYPE_RENEW ? true : false;

                    $order->updateIpProduct(true, $extend);
                    return redirect()->route('orders.index')->with('messagePayment', 'success', 'Đã thanh toán thành công');
                } else {
                    return redirect()->route('orders.index')->with('messagePayment', 'error', 'Đã thanh toán thất bại');
                }
            }
        }
    }
}
