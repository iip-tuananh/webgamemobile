<?php

namespace App\Http\Controllers\Admin;

use App\ExcelImports\ProductImport;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Model\Admin\AttributeValue;
use App\Model\Admin\Manufacturer;
use App\Model\Admin\Post;
use App\Model\Admin\Product;
use App\Model\Admin\ProductCategorySpecial;
use App\Model\Admin\ProductVideo;
use App\Model\Admin\Tag;
use Cassandra\Exception\ProtocolException;
use Illuminate\Http\Request;
use App\Model\Admin\Product as ThisModel;
use App\Model\Common\Unit;
use Yajra\DataTables\DataTables;
use Validator;
use \stdClass;
use Response;
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use DB;
use App\Helpers\FileHelper;
use App\Model\Admin\Config;
use App\Model\Common\User;
use App\Model\Common\ActivityLog;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
	protected $view = 'admin.products';
	protected $route = 'Product';

	public function index()
	{
        $can_create = false;
        if(Auth::user()->type == User::SUPER_ADMIN || Auth::user()->type == User::QUAN_TRI_VIEN) {
            $can_create = true;
        }
        if(Auth::user()->type == User::KHACH_HANG) {
            $products = ThisModel::query()->where('created_by', Auth::user()->id)->get();
            if($products->count() < 1) {
                $can_create = true;
            }
        }
		return view($this->view.'.index', compact('can_create'));
	}

	// Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {
		$objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
			->addColumn('name', function ($object) {
				return $object->name;
			})
			->editColumn('base_price', function ($object) {
				return formatCurrent($object->base_price);
			})
			->editColumn('price', function ($object) {
				return formatCurrent($object->price);
			})
			->editColumn('created_at', function ($object) {
				return Carbon::parse($object->created_at)->format("d/m/Y");
			})
			->editColumn('created_by', function ($object) {
				return $object->user_create->name ? $object->user_create->name : '';
			})
			->editColumn('updated_by', function ($object) {
				return $object->user_update->name ? $object->user_update->name : '';
			})
			->editColumn('cate_id', function ($object) {
					return $object->category ? $object->category->name : '';
			})
            ->addColumn('category_special', function ($object) {
                return $object->category_specials->implode('name', ', ');
            })
			->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';

                if($object->canEdit()) {
                    $result = $result . ' <a href="'.route($this->route.'.edit', $object->id).'" title="sửa" class="dropdown-item edit"><i class="fa fa-angle-right"></i>Sửa</a>';
                }
                if ($object->canDelete()) {
                    $result = $result . ' <a href="' . route($this->route.'.delete', $object->id) . '" title="xóa" class="dropdown-item confirm"><i class="fa fa-angle-right"></i>Xóa</a>';

                }
                if(Auth::user()->type == User::SUPER_ADMIN || Auth::user()->type == User::QUAN_TRI_VIEN) {
                    $result = $result . ' <a href="javascript:void(0)" title="thêm vào danh mục đặc biệt" class="dropdown-item add-category-special"><i class="fa fa-angle-right"></i>Thêm vào danh mục đặc biệt</a>';
                }
                if(Auth::user()->is_customer_vip) {
                    $result = $result . ' <a href="javascript:void(0)" title="Top up" class="dropdown-item top-up"><i class="fa fa-angle-right"></i>Top up</a>';
                }
                $result = $result . '</div></div>';
                return $result;
			})
			->addIndexColumn()
			->rawColumns(['action'])
			->make(true);
    }

	public function create()
	{
        $products = ThisModel::query()->where('created_by', Auth::user()->id)->get();
        if($products->count() >= 1 && Auth::user()->type == User::KHACH_HANG) {
			return redirect()->route($this->route.'.index')->with('error', 'Bạn chỉ được phép đăng 1 game, vui lòng xóa game để tạo game mới');
        }
        $tags = Tag::query()->where('type', Tag::TYPE_PRODUCT)->latest()->get();
        $config = Config::query()->first(['revenue_percent_1', 'revenue_percent_2', 'revenue_percent_3', 'revenue_percent_4', 'revenue_percent_5']);

		return view($this->view.'.create', compact('tags', 'config'));
	}

	public function store(ProductStoreRequest $request)
	{
		$json = new stdClass();
        $products = ThisModel::query()->where('created_by', Auth::user()->id)->get();
        if($products->count() >= 1 && Auth::user()->type == User::KHACH_HANG) {
			$json->success = false;
			$json->message = "Bạn chỉ được phép đăng 1 game, vui lòng xóa game để tạo game mới";
			return Response::json($json);
        }
		DB::beginTransaction();
		try {
			$object = new ThisModel();
            $object->type = $request->type;
			$object->name = $request->name;
            $object->title_seo = $request->title_seo;
			$object->cate_id = $request->cate_id;
			$object->intro = $request->intro;
			$object->short_des = $request->short_des;
			$object->body = $request->body;
			$object->base_price = $request->base_price;
            $object->origin = $request->origin;
			$object->price = $request->price;
			$object->status = $request->status;
			$object->manufacturer_id = $request->manufacturer_id;
			$object->origin_id = $request->origin_id;
            $object->url_custom = $request->url_custom;
            $object->state = $request->state ?? Product::CON_HANG;
            $object->is_pin = $request->is_pin ?? Product::NOT_PIN;
            $object->origin_link = $request->origin_link;
            $object->aff_link = $request->aff_link;
            $object->short_link = $request->short_link;

			$object->save();

            if($request->image) {
                FileHelper::uploadFile($request->image, 'products', $object->id, ThisModel::class, 'image',99);
            }

			$object->syncGalleries($request->galleries);
			$object->syncDocuments($request->attachments, 'products/attachments/');
            if($request->tag_ids) $object->addTags($request->tag_ids);

            if($request->input('attributes')) {
                $object->syncAttributes($request->input('attributes'));
            }

            if(isset($request->all()['videos'])) {
                foreach ($request->all()['videos'] as $video) {
                    ProductVideo::query()->create([
                        'link' => $video['link'],
                        'video' => $video['video'],
                        'product_id' => $object->id,
                    ]);
                }
            }

			DB::commit();
			$json->success = true;
			$json->message = "Thao tác thành công!";
			return Response::json($json);
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function edit($id)
	{
		$object = ThisModel::getDataForEdit($id);
        $tags = Tag::query()->where('type', Tag::TYPE_PRODUCT)->latest()->get();
        $config = Config::query()->first(['revenue_percent_1', 'revenue_percent_2', 'revenue_percent_3', 'revenue_percent_4', 'revenue_percent_5']);
        $object->tag_ids = $object->tags->pluck('id')->toArray();

        return view($this->view.'.edit', compact('object','tags'));
	}

	public function update(ProductUpdateRequest $request, $id)
	{
		$json = new stdClass();

		DB::beginTransaction();
		try {
			$object = ThisModel::findOrFail($id);

			if (!$object->canEdit()) {
				$json->success = false;
				$json->message = "Bạn không có quyền sửa hàng hóa này";
				return Response::json($json);
			}

            $object->type = $request->type;
			$object->name = $request->name;
            $object->title_seo = $request->title_seo;
			$object->cate_id = $request->cate_id;
			$object->intro = $request->intro;
			$object->short_des = $request->short_des;
			$object->body = $request->body;
			$object->base_price = $request->base_price;
			$object->price = $request->price;
            $object->origin = $request->origin;
			$object->status = $request->status;
			$object->manufacturer_id = $request->manufacturer_id;
			$object->origin_id = $request->origin_id;
            $object->url_custom = $request->url_custom;
            $object->state = $request->state ?? Product::CON_HANG;
            $object->is_pin = $request->is_pin ?? Product::NOT_PIN;
            $object->origin_link = $request->origin_link;
            $object->aff_link = $request->aff_link;
            $object->short_link = $request->short_link;

			$object->save();

			if($request->image) {
				if($object->image) {
					FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
				}
				FileHelper::uploadFile($request->image, 'products', $object->id, ThisModel::class, 'image',99);
			}

			$object->syncGalleries($request->galleries);
            $object->syncDocuments($request->attachments, 'products/attachments/');

            if($request->tag_ids) $object->updateTags($request->tag_ids);
            if($request->input('attributes')) {
                $object->syncAttributes($request->input('attributes'));
            }

            if(isset($request->all()['videos'])) {
                ProductVideo::query()->where('product_id', $object->id)->delete();
                foreach ($request->all()['videos'] as $video) {
                    ProductVideo::query()->create([
                        'link' =>$video['link'],
                        'video' => $video['video'],
                        'product_id' => $object->id,
                    ]);
                }
            }

			DB::commit();
			ActivityLog::createRecord("Cập nhật hàng hóa thành công", route('Product.edit', $object->id, false));
			$json->success = true;
			$json->message = "Thao tác thành công!";
			return Response::json($json);
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function delete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		$object = ThisModel::findOrFail($id);
		if (!$object->canDelete()) {
			$message = array(
				"message" => "Không thể xóa!",
				"alert-type" => "warning"
			);
		} else {
            if($object->image) {
                FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
            }
			$object->delete();
			$message = array(
				"message" => "Thao tác thành công!",
				"alert-type" => "success"
			);
		}
        return redirect()->route($this->route.'.index')->with($message);
	}


	public function getData(Request $request, $id) {
        $json = new stdclass();
        $json->success = true;
        $json->data = ThisModel::getDataForEdit($id);
        return Response::json($json);
	}

	// Xuất Excel
	public function exportExcel(Request $request)
	{
		return (new FastExcel(ThisModel::searchByFilter($request)))->download('danh_sach_hang_hoa.xlsx', function ($object) {
			if(Auth::user()->type == User::G7 || Auth::user()->type == User::NHOM_G7) {
				return [
					'ID' => $object->id,
					'Mã' => $object->code,
					'Tên' => $object->name,
					'Loại' => $object->category->name,
					'Giá đề xuất' => formatCurrency($object->price),
					'Giá bán' => formatCurrency($object->g7_price->price),
					'Điểm tích lũy' => $object->point,
					'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
				];
			} else {
				return [
					'ID' => $object->id,
					'Mã' => $object->code,
					'Tên' => $object->name,
					'Loại' => $object->category->name,
					'Giá đề xuất' => formatCurrency($object->price),
					'Điểm tích lũy' => $object->point,
					'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
				];
			}
		});
	}

	// Xuất PDF
	public function exportPDF(Request $request) {
		$data = ThisModel::searchByFilter($request);
		$pdf = PDF::loadView($this->view.'.pdf', compact('data'));
		return $pdf->download('danh_sach_hang_hoa.pdf');
	}

    public function addToCategorySpecial(Request $request) {
        $product = Product::query()->find($request->product_id);

        $product->category_specials()->sync($request->category_special_ids);

        return Response::json(['success' => true, 'message' => 'Thao tác thành công']);
    }

    // xóa nhiều sản phẩm
    public function actDelete(Request $request) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $product_ids = explode(',', $request->product_ids);
        foreach ($product_ids as $product_id) {
            $product = ThisModel::findOrFail($product_id);
            if($product->image) {
                FileHelper::forceDeleteFiles($product->image->id, $product->id, ThisModel::class, 'image');
            }
        }

        Product::query()->whereIn('id', $product_ids)->delete();

        $message = array(
            "message" => "Thao tác thành công!",
            "alert-type" => "success"
        );

        return redirect()->route($this->route.'.index')->with($message);
    }

    public function deleteFile(Request $request, $id) {
        $json = new \stdClass();
        $req = Product::findOrFail($id);

        $attachments = explode(", ", $req->attachments);

        if (!$request->file || !in_array($request->file, $attachments)) {
            $json->success = false;
            $json->message = "Không có file";
            return \Response::json($json);
        }

        if (file_exists(public_path().$request->file)) unlink(public_path().$request->file);

        $attachments = array_diff($attachments, [$request->file]);
        $req->attachments = join(", ", $attachments);
        $req->save();
        $json->success = true;
        $json->message = "Xóa thành công";
        $json->data = $req;

        return \Response::json($json);
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
			$import = new ProductImport;
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

    public function getListProducts(Request $request) {
        $products = ThisModel::searchByFilter($request);
        $products = $products->map(function ($product) {
            $product->sell_price = $product->sell_price;
            return $product;
        });
        return Response::json($products);
    }

    // Top up
    public function topUp(Request $request, $id) {
        $product = ThisModel::findOrFail($id);
        if ($product->created_by != Auth::user()->id) {
            return Response::json(['success' => false, 'message' => 'Bạn không có quyền thực hiện thao tác này']);
        }
        if (!Auth::user()->is_customer_vip) {
            return Response::json(['success' => false, 'message' => 'Bạn không có quyền thực hiện thao tác này']);
        }
        if ($product->top_up_at && Carbon::parse($product->top_up_at)->addMinutes(10) > Carbon::now()) {
            return Response::json(['success' => false, 'message' => 'Chỉ được top up 1 lần trong 10 phút']);
        }
        $product->top_up_at = Carbon::now();
        $product->save();
        return Response::json(['success' => true, 'message' => 'Thao tác thành công']);
    }
}
