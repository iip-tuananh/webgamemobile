<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Model\Common\User as ThisModel;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Validator;
use App\Employee;
use Auth;
use \stdClass;
use Response;
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use DB;
use App\Http\Traits\ResponseTrait;
use App\Helpers\FileHelper;
use App\Model\Common\User;

class UserController extends Controller
{
	use ResponseTrait;

	protected $view = 'common.users';
	protected $route = 'User';

	public function index()
	{
		return view($this->view.'.index');
	}

	// Hàm phân trang, search cho datatable
    public function searchData(Request $request)
    {
        $objects = ThisModel::searchByFilter($request);

        return Datatables::of($objects)
			->editColumn('updated_by', function ($object) {
				return $object->user_update ? $object->user_update->name : '';
			})
            ->editColumn('created_at', function ($object) {
                return Carbon::parse($object->created_at)->format("d/m/Y");
            })
			->editColumn('status', function ($object) {
                return getStatus($object->status, ThisModel::STATUSES);
            })
            ->editColumn('type', function ($object) {
                return $object->getTypeUser($object->type);
            })
            ->editColumn('upgrade_type', function ($object) {
                return $object->upgrade_type == 1 ? 'VIP' : 'Thường';
            })
            ->editColumn('upgrade_to_date', function ($object) {
                return $object->upgrade_to_date ? Carbon::parse($object->upgrade_to_date)->format("d/m/Y") : '';
            })
            ->editColumn('name', function ($object) {
                return '<div style="position: relative;">
                    '.$object->name.'
                    '.($object->upgrade_type == 1 ? '<span class="badge badge-warning" style="position: absolute; right: 0; top: -8px;"><i class="fa fa-crown"></i> VIP</span>' : '').'
                </div>';
            })
            ->editColumn('roles', function ($object) {
                $result = '';
                foreach ($object->roles as $role) {
                    $result .= '<span class="badge badge-dark mr-1">'.$role->name.'</span>';
                }
                return $result;
            })
			->editColumn('created_by', function ($object) {
                return $object->user_create ? $object->user_create->name : '';
            })
            ->addColumn('action', function ($object) {
				$result = '';
				if ($object->canEdit()) {
					$result = '<a href="' . route($this->route.'.edit',$object->id) .'" title="Sửa" class="btn btn-sm btn-primary edit"><i class="fas fa-pencil-alt"></i></a> ';
				}
				if ($object->canDelete()) {
					$result .= '<a href="' . route($this->route.'.delete', $object->id) . '" title="Khóa" class="btn btn-sm btn-danger confirm"><i class="fas fa-times"></i></a>';
				}
				return $result;

            })
			->rawColumns(['image', 'status', 'action', 'roles', 'name'])
            ->addIndexColumn()
            ->make(true);
    }

	public function create()
	{
		return view($this->view.'.create', compact([]));
	}

	public function edit($id)
	{
		$object = ThisModel::getDataForEdit($id);
		return view($this->view.'.edit', compact(['object']));
	}

	public function editProfile($id)
	{
        if (Auth::user()->id != $id) {
            // return $this->responseErrors('Không có quyền sửa thông tin của tài khoản khác!');
            return view('not_found');
        }
		$object = ThisModel::getDataForEdit($id);
		return view($this->view.'.edit', compact(['object']));
	}

	public function store(Request $request)
	{
		$rule = [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'account_name' => 'required|unique:users',
			'password' => 'required|min:6|regex:/^[a-zA-Z0-9\@\$\!\%\*\#\?\&]+$/',
			'password_confirm' => 'required|same:password',
			'status' => 'required|in:0,1',
			'image' => 'required|file|mimes:jpg,jpeg,png|max:3000',
			'roles' => 'required_unless:type,10|array|min:1',
			'roles.*' => 'required_unless:type,10|exists:roles,id',
			'type' => 'required|in:'.implode(',', array_column(ThisModel::USER_TYPES, 'id')),
            'upgrade_type' => 'required_if:type,10|in:0,1',
            'upgrade_to_date' => 'required_if:upgrade_type,1|date'
		];

		$validate = Validator::make(
			$request->all(),
			$rule,
            []
		);

		if ($validate->fails()) {
			return $this->responseErrors("", $validate->errors());
		}


		DB::beginTransaction();
		try {
			$object = new ThisModel();
			$object->name = $request->name;
			$object->email = $request->email;
            $object->account_name = $request->account_name;
            $object->password = bcrypt($request->password);
			$object->status = $request->status;
			$object->phone_number = $request->phone_number;
			$object->type = $request->type;
            $object->upgrade_type = $request->upgrade_type;
            $object->upgrade_to_date = $request->upgrade_to_date;
			$object->save();

            if ($request->roles) {
                $object->roles()->sync($request->roles);
            }

			FileHelper::uploadFile($request->image, 'users', $object->id, ThisModel::class, 'image');


			DB::commit();
			return $this->responseSuccess();
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function update(Request $request, $id)
	{
		$object = ThisModel::findOrFail($id);

		$rule = [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$id,
            'account_name' => 'required|unique:users,account_name,'.$id,
            'password' => 'nullable|min:6|regex:/^[a-zA-Z0-9\@\$\!\%\*\#\?\&]+$/',
			'password_confirm' => 'required_with:password|same:password',
			'status' => 'required|in:0,1',
			'roles' => 'required_unless:type,10|array|min:1',
			'roles.*' => 'required_unless:type,10|exists:roles,id',
			'type' => 'required|in:'.implode(',', array_column(ThisModel::USER_TYPES, 'id')),
            'upgrade_type' => 'required_if:type,10|in:0,1',
            'upgrade_to_date' => 'required_if:upgrade_type,1|date'
		];

		$validate = Validator::make(
			$request->all(),
			$rule,
			[]
		);

		if ($validate->fails()) {
			return $this->responseErrors("", $validate->errors());
		}

		DB::beginTransaction();
		try {
			$object->name = $request->name;
			$object->email = $request->email;
			$object->account_name = $request->account_name;
			if ($request->password != null) $object->password = bcrypt($request->password);
			$object->status = $request->status;
			$object->phone_number = $request->phone_number;
			$object->type = $request->type;
			$object->upgrade_type = $request->upgrade_type;
			$object->upgrade_to_date = $request->upgrade_to_date;
			$object->save();

            if ($request->roles) {
                $object->roles()->sync($request->roles);
            } else {
                $object->roles()->sync([]);
            }

			if($request->image) {
                if($object->image) {
                    FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
                }
				FileHelper::uploadFile($request->image, 'users', $object->id, ThisModel::class, 'image');
			}

			DB::commit();
			return $this->responseSuccess();
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function delete($id)
    {
		$object = ThisModel::findOrFail($id);
		if (!$object->canDelete()) {
			$message = array(
				"message" => "Không thể khóa!",
				"alert-type" => "warning"
			);
		} else {
			$object->status = 0;
			$object->save();
			$message = array(
				"message" => "Thao tác thành công!",
				"alert-type" => "success"
			);
		}
        return redirect()->route($this->route.'.index')->with($message);
	}


	// Xuất Excel
    public function exportExcel() {
        return (new FastExcel(ThisModel::all()))->download('danh_sach_tai_khoan.xlsx', function ($object) {
            return [
				'ID' => $object->id,
                'Tên' => $object->name,
                'email' => $object->email,
                'Loại' => $object->getTypeUser($object->type),
                'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
            ];
        });
    }

	// Xuất PDF
    public function exportPDF() {
        $data = ThisModel::all();
		PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView($this->view.'.pdf', compact('data'));
        return $pdf->download('danh_sach_tai_khoan.pdf');
    }
}
