<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Model\Admin\Ticket as ThisModel;
use App\Model\Admin\TicketLog;
use App\Model\Admin\IpProductTicket;
use App\Model\Admin\IpProduct;
use App\Model\Common\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Model\Common\Notification;
use stdClass;

class TicketController extends Controller
{
    protected $view = 'admin.tickets';
    protected $route = 'Ticket';

    public function index()
    {
        return view($this->view.'.index');
    }

    public function searchData(Request $request)
    {
        $data = ThisModel::searchByFilter($request->all());
        return Datatables::of($data)
            ->addColumn('customer', function ($data) {
                return $data->user->name;
            })
            ->addColumn('status_text', function ($data) {
                return getStatus($data->status, ThisModel::STATUSES);
            })
            ->addColumn('created_at', function ($data) {
                return formatDate($data->created_at);
            })
            ->addColumn('updated_at', function ($data) {
                return formatDate($data->updated_at);
            })
            ->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';

                $result = $result . ' <a href="'. route($this->route.'.show', $object->id) .'" title="Xem chi tiết" class="dropdown-item"><i class="fa fa-angle-right"></i>Xem chi tiết</a>';
                if (!Auth::user()->is_customer) {
                    $result = $result . ' <a href="javascript:void(0)" title="Đổi trạng thái" class="dropdown-item change-status"><i class="fa fa-angle-right"></i>Đổi trạng thái</a>';
                }
                $result = $result . '</div></div>';
                return $result;
			})
            ->addIndexColumn()
            ->rawColumns(['action', 'status_text'])
            ->make(true);
    }

    public function create()
    {
        return view($this->view.'.create');
    }

    public function show($id)
    {
        $ticket = ThisModel::with(['ipProducts.ipProduct', 'user'])->findOrFail($id);
        if(Auth::user()->is_customer && Auth::user()->id != $ticket->user_id) {
            return view('not_found');
        }
        $ticket->ips = $ticket->ipProducts->map(function ($item) {
            return $item->ipProduct->ip;
        })->implode(', ');
        $ticket_logs = TicketLog::with('user_create')->where('ticket_id', $id)->get();
        return view($this->view.'.show', compact('ticket', 'ticket_logs'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'ip_ids' => 'required|array|min:1',
                'message' => 'required',
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

            $object->title = $request->title;
            $object->status = ThisModel::STATUS_NEW;
            $object->user_id = Auth::user()->id;
            $object->save();

            if ($request->ip_ids) {
                foreach ($request->ip_ids as $ip_id) {
                    $ipProduct = new IpProductTicket();
                    $ipProduct->ip_product_id = $ip_id;
                    $ipProduct->ticket_id = $object->id;
                    $ipProduct->save();
                }
            }

            $log = new TicketLog();
            $log->ticket_id = $object->id;
            $log->message = $request->message;
            $log->type = Auth::user()->type;
            $log->save();

            if(Auth::user()->is_customer) {
                $users = User::whereIn('type', [User::SUPER_ADMIN, User::QUAN_TRI_VIEN])->get();
                foreach($users as $user) {
                    $notification = new Notification();
                    $notification->url = route("Ticket.show", $object->id, false);
                    $notification->content = "Có ticket mới từ khách hàng <b>" . Auth::user()->name . "</b>";
                    $notification->status = 0;
                    $notification->receiver_id = $user->id;
                    $notification->save();

                    $notification->send();
                }
            }
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

    public function update(Request $request, $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'message' => 'required',
            ]
        );

        if ($validate->fails()) {
            return Response::json(['success' => false, 'errors' => $validate->errors()]);
        }

        $ticket = ThisModel::findOrFail($id);
        $ticket->logs()->create([
            'ticket_id' => $ticket->id,
            'message' => $request->message,
            'type' => Auth::user()->type,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);

        if(Auth::user()->is_customer) {
            $users = User::whereIn('type', [User::SUPER_ADMIN, User::QUAN_TRI_VIEN])->get();
            foreach($users as $user) {
                $notification = new Notification();
                $notification->url = route("Ticket.show", $ticket->id, false);
                $notification->content = "Ticket của khách hàng <b>" . $ticket->user->name . "</b> có tin nhắn mới";
                $notification->status = 0;
                $notification->receiver_id = $user->id;
                $notification->created_by = Auth::user()->id;
                $notification->save();

                $notification->send();
            }
        } else {
            $notification = new Notification();
            $notification->url = route("Ticket.show", $ticket->id, false);
            $notification->content = "Ticket có tin nhắn mới từ quản trị viên";
            $notification->status = 0;
            $notification->receiver_id = $ticket->user->id;
            $notification->created_by = Auth::user()->id;
            $notification->save();

            $notification->send();
        }

        return Response::json(['success' => true, 'message' => 'Thao tác thành công!']);
    }

    public function updateStatus(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'ticket_id' => 'required',
                'status' => 'required',
            ]
        );

        if ($validate->fails()) {
            return Response::json(['success' => false, 'errors' => $validate->errors()]);
        }

        $ticket = ThisModel::where('id', $request->ticket_id)->first();
        if(!$ticket) {
            return Response::json(['success' => false, 'message' => 'Không tìm thấy ticket']);
        }

        $ticket->status = $request->status;
        $ticket->save();

        $notification = new Notification();
        $notification->url = route("Ticket.show", $ticket->id, false);
        $notification->content = "Ticket có trạng thái mới";
        $notification->status = 0;
        $notification->receiver_id = $ticket->user->id;
        $notification->created_by = Auth::user()->id;
        $notification->save();

        $notification->send();
        return Response::json(['success' => true, 'message' => 'Thao tác thành công!']);
    }
}