<?php

namespace App\Http\Controllers\Front;

use App\Helpers\FileHelper;
use App\Http\Traits\ResponseTrait;
use App\Model\Admin\Block;
use App\Model\Admin\Category;
use App\Model\Admin\CategorySpecial;
use App\Model\Admin\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Response;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\Contact;
use App\Model\Admin\Order;
use App\Model\Admin\OrderDetail;
use App\Model\Admin\Partner;
use App\Model\Admin\Policy;
use App\Model\Admin\Post;
use App\Model\Admin\PostCategory;
use App\Model\Admin\ProductRate;
use App\Model\Admin\Review;
use App\Model\Admin\Voucher;
use App\Model\Common\User;
use DB;
use Mail;
use SluggableScopeHelpers;

class FrontController extends Controller
{
    use ResponseTrait;

    public $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function homePage(CategoryService $categoryService)
    {
        $data_vip_account = User::query()->where('upgrade_type', 1)->pluck('id')->toArray();
        $data['banners'] = Banner::with(['image'])->where('position', 1)->get();
        $data['smallBanners'] = Banner::with(['image'])->where('position', 2)->orderBy('id', 'desc')->limit(2)->get();
        $data['partners'] = Partner::with(['image'])->limit(3)->get();
        $data['reviews'] = Review::all();
        $data['newProducts'] = Product::with(['image'])->where('status', 1)->limit(6)->orderBy('id', 'DESC')->inRandomOrder()->get();
        $data['categorySpecialPost'] = CategorySpecial::query()->with([
            'posts' => function ($q) {
                $q->where('status', 1);
            }
        ])
            ->has('posts')
            ->where('type', 20)
            ->where('show_home_page', 1)
            ->orderBy('order_number')->get();
        $data['categorySpecial'] = CategorySpecial::query()->with([
            'products' => function ($q) {
                $q->with([
                    'product_rates' => function ($q) {
                        $q->where('status', 2);
                    }
                ])->where('status', 1);
            }
        ])
            ->has('products')
            ->where('type', 10)
            ->where('show_home_page', 1)
            ->orderBy('order_number')->get()->map(function ($query) use ($data_vip_account) {
                $product_ids = $query->products->pluck('id')->toArray();
                $products = Product::query()->where(function($q) use ($product_ids, $data_vip_account) {
                    $q->whereIn('id', $product_ids);
                    $q->orWhereIn('created_by', $data_vip_account);
                })->where('status', 1)
                    ->orderByRaw("
                        CASE
                            WHEN created_by IN (" . implode(',', $data_vip_account ?: [0]) . ") THEN 0
                            ELSE 1
                        END
                    ")
                    ->orderByRaw("
                        CASE
                            WHEN created_by IN (" . implode(',', $data_vip_account ?: [0]) . ") THEN top_up_at
                            ELSE NULL
                        END DESC
                    ")
                    ->get();
                $query->setRelation('products', $products);
                return $query;
            });

        $data['newBlogs'] = Post::with(['image'])->where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->select(['id', 'name', 'slug', 'intro', 'created_at'])
            ->limit(10)->get();

        $productCategories = Category::query()->with(['products' => function ($q) {
            $q->where('status', 1);
        }])->where('parent_id', 0)->where('show_home_page', 1)->orderBy('sort_order')->get();

        $productCategories = $productCategories->map(function ($query) use ($categoryService, $data_vip_account) {
            $arr_category_id = $categoryService->getAllChildCategory($query);
            $arr_category_id = array_merge($arr_category_id, [$query->id]);
            $products = Product::query()
                ->whereIn('cate_id', $arr_category_id)
                ->where('status', 1)
                ->orderByRaw("
                    CASE
                        WHEN created_by IN (" . implode(',', $data_vip_account ?: [0]) . ") THEN 0
                        ELSE 1
                    END
                ")
                ->orderByRaw("
                    CASE
                        WHEN created_by IN (" . implode(',', $data_vip_account ?: [0]) . ") THEN top_up_at
                        ELSE NULL
                    END DESC
                ")
                ->get();
            $query->setRelation('products', $products);
            return $query;
        });

        $data['productCategories'] = $productCategories;
        // block khối ảnh cuối trang
        // $block = Block::query()->find(1);
        // $data['block'] = $block;
        // $data['postCategories'] = PostCategory::query()->where('parent_id', 0)->get()->map(function ($query) {
        //     $query->posts = $query->posts->where('status', 1)->take(6);
        //     return $query;
        // });

        return view('site.home', $data);
    }

    // ajax load product home page
    public function loadProductHomePage(Request $request)
    {
        $category = CategorySpecial::findBySlug($request->handle);
        $products = $category->products()->with([
            'image', 'galleries',
            'product_rates' => function ($q) {
                $q->where('status', 2);
            }
        ])->where('status', 1)->limit(10)->orderBy('created_at', 'desc')->get();
        $html = '';
        foreach ($products as $product) {
            $html .= view('site.partials.item_product', compact('product', 'category'))->render();
        }

        return Response::json([
            'html' => $html,
        ]);
    }

    // ajax get product quick view
    public function getProductQuickView(Request $request)
    {
        // $product = Product::findBySlug($request->handle);
        $product = Product::with([
            'product_rates' => function ($q) {
                $q->where('status', 2);
            }
        ])->where('id', $request->product_id)->first();
        $html = view('site.partials.quick_view_product', compact('product'))->render();

        return Response::json([
            'html' => $html,
        ]);
    }

    public function showProductDetail($slug)
    {
        try {
            $arr_view_count = [50, 67, 35, 49];
            $categories = Category::getAllCategory();
            $product = Product::with(['category.category_parent'])->where('slug', $slug)->first();
            $product->base_price = $product->base_price + $arr_view_count[array_rand($arr_view_count)];
            $product->save();
            $attributes = [];
            foreach ($product->attributeValues as $attribute) {
                if (!isset($attributes[$attribute->id])) {
                    $attributes[$attribute->id] = [
                        'name' => $attribute->name,
                        'values' => [$attribute->pivot->value]
                    ];
                } else {
                    $attributes[$attribute->id]['values'][] = $attribute->pivot->value;
                }
            }
            $product->attributes = $attributes;

            // sản phẩm tương tự
            $productsRelated = $product->category->products()->with([
                'product_rates' => function ($q) {
                    $q->where('status', 2);
                }
            ])->whereNotIn('id', [$product->id])->orderBy('created_at', 'desc')->get();

            $bestSellerProducts = Product::query()->with([
                'product_rates' => function ($q) {
                    $q->where('status', 2);
                }
            ])->where('status', 1)->inRandomOrder()->limit(10)->get();

            $category = Category::query()->where('id', $product->cate_id)->first();

            $arr_product_rate_images = [];
            foreach ($product->product_rates as $rate) {
                foreach ($rate->images as $image) {
                    $arr_product_rate_images[] = $image->path;
                }
            }

            $canReview = false;
            if (\Auth::guard('client')->check()) {
                $existsOrder = OrderDetail::where('product_id', $product->id)
                    ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
                    ->where('orders.customer_email', \Auth::guard('client')->user()->email)
                    ->where('orders.status', Order::THANH_CONG)->exists();
                if ($existsOrder) {
                    $canReview = true;
                }
            }

            return view('site.products.product_detail', compact('categories', 'product', 'productsRelated', 'category', 'arr_product_rate_images', 'bestSellerProducts', 'canReview'));
        } catch (\Exception $exception) {
            return view('site.errors');
            Log::error($exception);
        }
    }


    public function showProductCategory(Request $request, $categorySlug = null)
    {
        $categories = Category::parent()->with('products')->orderBy('sort_order')->get();
        $category = Category::findBySlug($categorySlug);
        $sort = $request->get('sort') ?: 'lasted';
        if ($category) {
            $category_parent_id = $category->parent ? $category->parent->id : null;
            $arr_category_id = array_merge($category->childs->pluck('id')->toArray(), [$category->id, $category_parent_id]);
            if ($category->childs) {
                foreach ($category->childs as $child) {
                    $arr_category_id = array_merge($arr_category_id, $child->childs->pluck('id')->toArray());
                }
            }

            $products = Product::with([
                'product_rates' => function ($q) {
                    $q->where('status', 2);
                }
            ])->where('status', 1)->whereIn('cate_id', $arr_category_id)->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $category = CategorySpecial::findBySlug($categorySlug);
            $product_ids = $category->products->pluck('id')->toArray();
            $data_vip_account = User::query()->where('upgrade_type', 1)->pluck('id')->toArray();

            // Tạo câu lệnh SQL an toàn
            $vipIdsSql = implode(',', $data_vip_account ?: [0]);

            $products = Product::query()->where(function($q) use ($product_ids, $vipIdsSql, $data_vip_account) {
                $q->whereIn('id', $product_ids);
                $q->orWhereIn('created_by', $data_vip_account);
            })->where('status', 1)
            ->orderByRaw("
                CASE
                    WHEN created_by IN ($vipIdsSql) THEN 0
                    ELSE 1
                END
            ")
            ->orderByRaw("
                CASE
                    WHEN created_by IN ($vipIdsSql) THEN top_up_at
                    ELSE NULL
                END DESC
            ")
            ->paginate(20);
        }

        $title = $category->name;
        $short_des = $category->short_des;
        $title_sub = $category->name;

        // $categorySpecial = CategorySpecial::query()->with(['products' => function($q) {$q->where('status', 1)->limit(5);}])
        //     ->has('products')
        //     ->where('type',10)
        //     ->where('show_home_page', 1)
        //     ->orderBy('order_number')->get();

        if (!$category) {
            return view('site.errors');
        }

        return view('site.products.product_category', compact('categories', 'category', 'sort', 'products', 'title', 'short_des', 'title_sub'));
    }

    public function loadMoreProduct(Request $request)
    {
        $category = Category::query()->find($request->cate_id);

        $products = Product::query()->where('status', 1);

        if ($sort = $request->get('sort')) {
            if ($sort == 'lasted') {
                $products->orderBy('created_at', 'desc');
            } else if ($sort == 'priceAsc') {
                $products->orderBy('price', 'asc');
            } else if ($sort == 'priceDesc') {
                $products->orderBy('price', 'desc');
            }
        } else {
            $products->orderBy('created_at', 'desc');
        }

        $product_all_ids = $category->products()->pluck('id')->toArray();

        if ($request->product_ids_load_more) {
            $products->whereIn('id', array_diff($product_all_ids, $request->product_ids_load_more));
        }

        $products = $products->where('cate_id', $category->id)->limit(1)->get();

        // mảng product id
        $product_ids = $products->pluck('id')->toArray();

        $html = '';

        $product_ids_ = array_merge($request->product_ids_load_more ?? [], $product_ids);

        $hasProductsNextPage = false;

        if ($product_ids && Product::query()->whereNotIn('id', $product_ids_)->count()) $hasProductsNextPage = true;

        foreach ($products as $product) {
            $html .= view('site.partials.card_product', compact('product', 'category'))->render();
        }


        return Response::json([
            'html' => $html,
            'product_ids' => $product_ids,
            'hasProductsNextPage' => $hasProductsNextPage,
        ]);
    }


    // Giới thiệu
    public function aboutUs()
    {
        return view('site.about_us');
    }

    // Đăng ký cộng tác viên
    public function connectUs()
    {
        return view('site.connect_register');
    }

    // Liên hệ
    public function contactUs()
    {
        return view('site.contact_us');
    }

    public function postContact(Request $request)
    {
        $rule  =  [
            'your_name' => 'required',
            'your_phone'  => 'required|regex:/^(0)[0-9]{9,11}$/',
            'your_email'  => 'required|email|max:255',
            'your_message' => 'required',
        ];

        $validate = Validator::make(
            $request->all(),
            $rule,
            [
                'your_name.required' => 'Vui lòng nhập họ tên',
                'your_phone.required' => 'Vui lòng nhập số điện thoại',
                'your_phone.regex' => 'Số điện thoại không đúng định dạng',
                'your_email.required' => 'Vui lòng nhập email',
                'your_email.email' => 'Email không đúng định dạng',
                'your_message.required' => 'Vui lòng nhập nội dung',
            ]
        );

        if ($validate->fails()) {
            return $this->responseErrors('Gửi yêu cầu thất bại!', $validate->errors());
        }

        $contact = new Contact();
        $contact->user_name = $request->your_name;
        $contact->email = $request->your_email;
        $contact->phone_number = $request->your_phone;
        $contact->content = $request->your_message;
        $contact->location = $request->your_location ?? null;
        $contact->save();

        return $this->responseSuccess('Gửi yêu cầu thành công!');
    }

    // Blogs
    public function listBlog(Request $request, $slug)
    {
        $category = PostCategory::where('slug', $slug)->first();
        if (!$category) {
            $category = CategorySpecial::findBySlug($slug);
            if (!$category) {
                return view('site.errors');
            } else {
                $post_ids = $category->posts->pluck('id')->toArray();
                $data['blogs'] = Post::with(['image'])->where(['status' => 1])
                    ->orderBy('id', 'DESC')
                    ->select(['id', 'name', 'intro', 'created_at', 'slug', 'cate_id', 'created_by'])
                    ->whereIn('id', $post_ids)
                    ->paginate(20);
            }
        } else {
            $data['blogs'] = Post::with(['image'])->where(['status' => 1, 'cate_id' => $category->id])
                ->orderBy('id', 'DESC')
                ->select(['id', 'name', 'intro', 'created_at', 'slug', 'cate_id', 'created_by'])
                ->paginate(20);
        }

        $data['cate_title'] = $category->name;
        $data['categories'] = PostCategory::with([
            'posts' => function ($query) {
                $query->where(['status' => 1])->get();
            }
        ])->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        $data['newBlogs'] = Post::with(['image'])->where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->select(['id', 'name', 'slug', 'created_at'])
            ->limit(6)->get();
        return view('site.blogs.list', $data);
    }

    public function indexBlog(Request $request)
    {
        $data['blogs'] = Post::with(['image'])->where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->select(['id', 'name', 'intro', 'created_at', 'slug', 'created_by'])
            ->paginate(20);

        $data['cate_title'] = 'Tin tức';
        $data['categories'] = PostCategory::with([
            'posts' => function ($query) {
                $query->where(['status' => 1])->get();
            }
        ])->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        $data['newBlogs'] = Post::with(['image'])->where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->select(['id', 'name', 'slug', 'created_at'])
            ->limit(6)->get();

        return view('site.blogs.list', $data);
    }

    public function detailBlog(Request $request, $slug)
    {
        $blog = Post::with(['image', 'user_create'])->where('slug', $slug)->first();
        $category = PostCategory::where('id', $blog->cate_id)->first();
        $data['other_blogs'] = Post::with(['image'])->where(['status' => 1, 'cate_id' => $blog->cate_id])
            ->where('id', '!=', $blog->id)
            ->select(['id', 'name', 'intro', 'created_at', 'slug', 'cate_id'])
            ->limit(16)->inRandomOrder()->get();
        $data['blog_title'] = $blog->name;
        $data['blog_description'] = $blog->intro;
        $data['categories'] = PostCategory::with([
            'posts' => function ($query) {
                $query->where(['status' => 1])->get();
            }
        ])->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        $data['newBlogs'] = Post::with(['image'])->where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->select(['id', 'name', 'slug', 'created_at'])
            ->limit(6)->get();
        $data['blog'] = $blog;
        $data['blog_slug'] = $blog->slug;
        $data['cate_title'] = $category->name;
        $data['category'] = $category;
        $productCategories = Category::query()->with(['products' => function ($q) {
            $q->where('status', 1);
        }])->where('parent_id', '!=',  0)->where('show_home_page', 1)->orderBy('sort_order')->get();
        $data['productCategories'] = $productCategories;
        return view('site.blogs.detail', $data);
    }

    // Tìm kiếm
    public function autoSearchComplete(Request $request)
    {
        if (isset($request->keyword)) {
            $products = Product::with(['image'])->where('name', 'LIKE', '%' . $request->keyword . '%')->where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();
            $view = view("site.partials.ajax_search_results", compact('products'))->render();
        } else {
            $view = '';
        }

        return Response::json([
            'html' => $view
        ]);
    }

    public function resetData()
    {
        \Illuminate\Support\Facades\DB::table('orders')->truncate();
        \Illuminate\Support\Facades\DB::table('contacts')->truncate();
    }

    // laster buy products
    public function lasterBuyProducts()
    {
        $product = \DB::table('products')
            ->where('status', 1)
            ->leftJoin('files', function ($join) {
                $join->on('files.model_id', '=', 'products.id')
                    ->where('files.custom_field', 'image')->where('files.model_type', Product::class);
            })
            ->inRandomOrder()->first(['products.id', 'products.name', 'products.slug', 'files.path']);
        return Response::json([
            'product' => $product,
        ]);
    }

    // review
    public function submitReview(Request $request)
    {
        $rule  =  [
            'name' => 'required',
            'email'  => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'phone'  => 'required|regex:/^(0)[0-9]{9,11}$/',
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'required',
            'galleries' => 'required|array|min:1|max:5',
            'galleries.*.image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'desc' => 'required',
            'product_id' => 'required|exists:products,id',
        ];

        $validate = Validator::make(
            $request->all(),
            $rule,
            [
                'name.required' => 'Vui lòng nhập họ tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.regex' => 'Số điện thoại không đúng định dạng',
                'email.required' => 'Vui lòng nhập email',
                'email.regex' => 'Email không đúng định dạng',
                'rating.required' => 'Vui lòng đánh giá sản phẩm',
                'rating.numeric' => 'Đánh giá không hợp lệ',
                'rating.min' => 'Đánh giá không hợp lệ',
                'rating.max' => 'Đánh giá không hợp lệ',
                'title.required' => 'Vui lòng nhập tiêu đề',
                'galleries.required' => 'Vui lòng chọn ít nhất 1 hình ảnh',
                'galleries.array' => 'Dữ liệu không hợp lệ',
                'galleries.min' => 'Vui lòng chọn ít nhất 1 hình ảnh',
                'galleries.max' => 'Vui lòng chọn tối đa 5 hình ảnh',
                'desc.required' => 'Vui lòng nhập nội dung đánh giá',
                'galleries.*.image.image' => 'Vui lòng chọn file hình ảnh',
                'galleries.*.image.mimes' => 'File không hợp lệ',
                'galleries.*.image.max' => 'File không được lớn hơn 5MB',
                'product_id.required' => 'Sản phẩm không hợp lệ',
                'product_id.exists' => 'Sản phẩm không hợp lệ',
            ]
        );


        if ($validate->fails()) {
            return $this->responseErrors('Gửi yêu cầu thất bại!', $validate->errors());
        }

        $store_data = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'rating' => $request->rating,
            'title' => $request->title,
            'desc' => $request->desc,
        ];

        DB::beginTransaction();
        try {
            $object = new ProductRate();
            $object->fill($store_data);
            $object->save();

            $galleries = $request->galleries;
            foreach ($galleries as $gallery) {
                if (isset($gallery['image'])) {
                    $file = $gallery['image'];
                    FileHelper::uploadFile($file, 'product_rate', $object->id, ProductRate::class, 'image', 1);
                }
            }

            DB::commit();
            return $this->responseSuccess('Gửi đánh giá thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    // Tìm kiếm trang list product
    public function search(Request $request)
    {
        $query = Product::query()->where('status', 1);
        if (!empty($request->keyword)) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('title_seo', 'like', '%' . $request->keyword . '%');
            });
        }
        if (!empty($request->tag)) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->tag);
            });
        }
        $products = $query->paginate(12);
        $title = 'Tìm kiếm';
        $short_des = 'Kết quả tìm kiếm';
        $title_sub = 'Tìm thấy ' . count($products) . ' kết quả phù hợp';
        return view('site.products.product_category', compact('products', 'title', 'short_des', 'title_sub'));
    }

    // chính sách
    public function showPolicy(Request $request, $slug)
    {
        $policy = Policy::where('slug', $slug)->first();
        return view('site.policy', compact('policy'));
    }
}
