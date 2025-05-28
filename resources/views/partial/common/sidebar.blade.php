<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3">
        {{-- <div class="image">
            <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info" style="width: 100%;">
            @if(Auth::user()->type == App\Model\Common\User::SUPER_ADMIN)
            <a href="#" class="d-block" style="color: #fd7e14">Xin chào: {{ Auth::user()->account_name }}</a>
            @else
                @if(Auth::user()->image && Auth::user()->image->path)
                <img alt="" class="img-circle elevation-2" style="width: 30px; height: 30px;" ng-src="{{ Auth::user()->image->path ?? '' }}">
                @else
                <i class="fas fa-user-circle" style="font-size: 30px; color: #000000; background-color: #000000; border-radius: 50%;"></i>
                @endif
                <a href="{{ route('User.editProfile', Auth::user()->id) }}" class="" style="color: #fd7e14; position: relative; display: inline-block;">
                    {{ App\Model\Common\User::find(Auth::user()->id)->name }}
                    @if (Auth::user()->upgrade_type == 1)
                    <span class="badge badge-warning" style="position: absolute; top: -6px; right: -60%; z-index: 100;"><i class="fa fa-crown"></i> VIP</span>
                    @endif
                </a>
            @endif
        </div>
    </div>
    @if (!Auth::user()->is_customer)
    <!-- Sidebar Menu Admin -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
                <a href="{{ route('dash') }}" class="nav-link {{ Request::routeIs('dash') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Trang chủ
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="{{ route('category_special.index') }}" class="nav-link {{ Request::routeIs('category_special.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-stream"></i>
                    <p>
                        Danh mục đặc biệt
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview  {{ request()->is('common/products') || request()->is('uptek/products*') || request()->is('admin/categories') || request()->is('admin/categories*') ? 'menu-open' : '' }} ">
                <a href="" class="nav-link {{ Request::routeIs('Product.index') || Request::routeIs('Product.create') || Request::routeIs('Product.edit') || Request::routeIs('Product.show') || Request::routeIs('ip_products.index') || Request::routeIs('ip_products.show') ? 'active' : '' }}">
                    <i class="nav-icon fab fa-dropbox"></i>
                    <p>
                        Quản lý sản phẩm
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Category.index') }}" class="nav-link {{ Request::routeIs('Category.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách danh mục</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Category.create') }}" class="nav-link {{ Request::routeIs('Category.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Thêm mới danh mục</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Product.index') }}" class="nav-link {{ Request::routeIs('Product.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách sản phẩm</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('ip_products.index') }}" class="nav-link {{ Request::routeIs('ip_products.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Quản lý IP</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('Product.create') }}" class="nav-link {{ Request::routeIs('Product.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Thêm mới sản phẩm</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('attributes.index') }}" class="nav-link {{ Request::routeIs('attributes.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục thuộc tính hàng hóa</p>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('product_rates.index') }}" class="nav-link {{ Request::routeIs('product_rates.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Đánh giá sản phẩm</p>
                        </a>
                    </li> --}}
                </ul>
            </li>

            {{-- <li class="nav-item has-treeview">
                <a href="{{route('vouchers.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-tag"></i>
                    <p>
                        Danh mục mã giảm giá
                    </p>
                </a>
            </li> --}}

            <li class="nav-item has-treeview  {{ request()->is('admin/posts') || request()->is('admin/posts/*') || request()->is('admin/post-categories') || request()->is('admin/post-categories/*') ? 'menu-open' : '' }} ">

                <a href="#" class="nav-link {{ Request::routeIs('PostCategory.create') || Request::routeIs('Post.create') || Request::routeIs('Post.index') || Request::routeIs('PostCategory.index') || Request::routeIs('Post.edit') || Request::routeIs('PotCategory.edit') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Bài viết
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('PostCategory.index') }}" class="nav-link {{ Request::routeIs('PostCategory.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục bài viết</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('PostCategory.create') }}" class="nav-link {{ Request::routeIs('PostCategory.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Thêm mới danh mục</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('Post.index') }}" class="nav-link {{ Request::routeIs('Post.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách bài viết</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('Post.create') }}" class="nav-link {{ Request::routeIs('Post.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Thêm mới bài viết</p>
                        </a>
                    </li> --}}
                </ul>
            </li>

            <li class="nav-item has-treeview  {{ request()->is('admin/stores') ||  request()->is('admin/banners') ||  request()->is('admin/origins') || request()->is('admin/manufacturers/*') || request()->is('admin/attributes') ? 'menu-open' : '' }} ">

                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Danh mục khác
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    {{-- <li class="nav-item">
                        <a href="{{ route('origins.index') }}" class="nav-link {{ Request::routeIs('origins.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục nguồn gốc xuất xứ</p>
                        </a>
                    </li> --}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('manufacturers.index') }}" class="nav-link {{ Request::routeIs('manufacturers.index') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Danh mục hãng sản xuất</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    {{-- <li class="nav-item">
                        <a href="{{ route('Project.index') }}" class="nav-link {{ Request::routeIs('Project.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục dự án</p>
                        </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a href="{{ route('partners.index') }}" class="nav-link {{ Request::routeIs('partners.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục TVC doanh nghiệp</p>
                        </a>
                    </li> --}}

                    <li class="nav-item">
                        <a href="{{ route('tags.index') }}" class="nav-link {{ Request::routeIs('tags.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục tag</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('banners.index') }}" class="nav-link {{ Request::routeIs('banners.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục banner trang chủ</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('policies.index') }}" class="nav-link {{ Request::routeIs('policies.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục chính sách</p>
                        </a>
                    </li>

                   {{-- <li class="nav-item">--}}
{{--                        <a href="{{ route('stores.index') }}" class="nav-link {{ Request::routeIs('stores.index') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Danh mục đơn vị thành viên</p>--}}
{{--                        </a>--}}
{{--                    </li> --}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('consultants.index') }}" class="nav-link {{ Request::routeIs('consultants.index') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Danh mục nhân viên liên hệ</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a href="{{ route('contacts.index') }}" class="nav-link {{ Request::routeIs('contacts.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục khách hàng liên hệ</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('Review.index') }}" class="nav-link {{ Request::routeIs('Review.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>
                                Đánh giá khách hàng
                            </p>
                        </a>
                    </li> --}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('recruitments.index') }}" class="nav-link {{ Request::routeIs('recruitments.index') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Danh mục tin tuyển dụng</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('apply-recruitments.index') }}" class="nav-link {{ Request::routeIs('apply-recruitments.index') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Danh mục đơn ứng tuyển</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>

            {{-- <li class="nav-item has-treeview  {{ request()->is('admin/tickets') ? 'menu-open' : '' }} ">
                <a href="#" class="nav-link {{ Request::routeIs('Ticket.index') || Request::routeIs('Ticket.show') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                        Quản lý ticket
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Ticket.index') }}" class="nav-link {{ Request::routeIs('Ticket.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách ticket</p>
                        </a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="nav-item has-treeview">
                <a href="{{ route('orders.index') }}" class="nav-link {{ Request::routeIs('orders.index') || Request::routeIs('orders.show') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-file-invoice-dollar"></i>

                    <p>
                        Quản lý đơn hàng
                    </p>
                </a>
            </li> --}}

            {{-- <li class="nav-item has-treeview  {{ request()->is('admin/blocks') || request()->is('admin/blocks/*') ? 'menu-open' : '' }} ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        Khối nội dung HTML
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Block.index') }}" class="nav-link {{ Request::routeIs('Block.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('Block.create') }}" class="nav-link {{ Request::routeIs('Block.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li> --}}


                    {{-- <li class="nav-item">
                        <a href="{{ route('showrooms.index') }}" class="nav-link {{ Request::routeIs('showrooms.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Khối nội dung trang Showroom</p>
                        </a>
                    </li> --}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('e-brochure.index') }}" class="nav-link {{ Request::routeIs('e-brochure.create') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Khối nội dung trang E-brochure</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                {{-- </ul>
            </li> --}}

            {{-- <li class="nav-item has-treeview  {{ request()->is('admin/reviews') || request()->is('admin/reviews*') ? 'menu-open' : '' }} ">
                <a href="{{ route('Review.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-star"></i>
                    <p>
                        Đánh giá khách hàng
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li> --}}

            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-handshake"></i>
                    <p>
                        Khách hàng
                        <i class=" fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('CustomerGroup.index') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Nhóm khách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Customer.index') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách khách</p>
                        </a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="nav-item {{ Request::routeIs('Supplier.index') ? 'active' : '' }}">
                <a href="{{ route('Supplier.index') }}" class="nav-link">
                    <i class="fas fa-truck nav-icon"></i>
                    <p>
                        Nhà cung cấp
                    </p>
                </a>
            </li> --}}
            {{-- <li class="nav-item has-treeview {{ request()->is('common/cars*') || request()->is('vehicle-manufacts*') || request()->is('vehicle-types*') || request()->is('vehicle-categories*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Danh mục xe
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('VehicleManufact.index') }}" class="nav-link {{ Request::routeIs('VehicleManufact.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục hãng xe</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('VehicleType.index') }}" class="nav-link {{ Request::routeIs('VehicleType.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục loại xe</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('VehicleCategory.index') }}" class="nav-link {{ Request::routeIs('VehicleCategory.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục dòng xe</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Car.index') }}" class="nav-link {{ Request::routeIs('Car.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh mục xe</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-codepen"></i>
                    <p>
                        Tài sản cố định
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('FixedAsset.index') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách tài sản</p>
                        </a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-percent"></i>
                    <p>
                        CT Khuyến mãi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('PromoCampaign.index') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách chương trình</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('PromoCampaign.create') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Thêm mới chương trình</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Báo cáo thông kê
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Report.revenueReport') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo thưởng hoa hồng</p>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('Report.promoReport') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo khuyến mại</p>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo kho</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Report.promoProductReport') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo khuyến mại tặng hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Report.customerSaleReport') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo bán hàng theo khách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo quỹ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Báo cáo khác</p>
                        </a>
                    </li> --}}
                {{-- </ul>
            </li> --}}
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{ Request::routeIs('User.index') || Request::routeIs('User.create') || Request::routeIs('User.edit') || Request::routeIs('User.show') || Request::routeIs('Role.index') || Request::routeIs('Role.create') || Request::routeIs('Role.edit') || Request::routeIs('Role.show') ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                        Người dùng
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('User.index') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Tài khoản</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('User.create') }}" class="nav-link">
                            <i class="far fas fa-angle-right nav-icon"></i>
                            <p>Tạo tài khoản</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Role.index') }}" class="nav-link">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Chức vụ</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview  {{ request()->is('uptek/configs') || request()->is('uptek/customer-levels') || request()->is('uptek/accumulate-point/*') ? 'menu-open' : '' }} ">
                <a href="#" class="nav-link {{ Request::routeIs('Config.edit') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Cấu hình hệ thống
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Config.edit') }}" class="nav-link  {{ Request::routeIs('Config.edit') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Cấu hình chung</p>
                        </a>
                    </li>

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('configStatistic.index') }}" class="nav-link {{ Request::routeIs('configStatistic.index') ? 'active' : '' }}">--}}
{{--                            <i class="far fas  fa-angle-right nav-icon"></i>--}}
{{--                            <p>Cấu hình số liệu thống kê</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu-admin -->
    @else
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
            {{-- <li class="nav-item has-treeview menu-open">
                <a href="{{ route('dash-client') }}" class="nav-link {{ Request::routeIs('dash-client') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Trang chủ
                    </p>
                </a>
            </li> --}}
            <li class="nav-item has-treeview  {{ request()->is('common/products') || request()->is('uptek/products*') || request()->is('admin/categories') || request()->is('admin/categories*') ? 'menu-open' : '' }} ">
                <a href="#" class="nav-link {{ Request::routeIs('Product.index') || Request::routeIs('Product.show') ? 'active' : '' }}">
                    <i class="nav-icon fab fa-dropbox"></i>
                    <p>
                        Quản lý sản phẩm
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Product.index') }}" class="nav-link {{ Request::routeIs('Product.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách sản phẩm</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{ Request::routeIs('orders.create') || Request::routeIs('orders.cart') || Request::routeIs('orders.index') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-file-invoice-dollar"></i>
                    <p>
                        Quản lý đơn hàng
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('orders.create') }}" class="nav-link {{ Request::routeIs('orders.create') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Tạo đơn hàng mới</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.cart') }}" class="nav-link {{ Request::routeIs('orders.cart') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Giỏ hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('orders.index')}}" class="nav-link {{ Request::routeIs('orders.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách đơn hàng</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item has-treeview  {{ request()->is('admin/tickets') ? 'menu-open' : '' }} ">
                <a href="#" class="nav-link {{ Request::routeIs('Ticket.index') || Request::routeIs('Ticket.show') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                        Quản lý ticket
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Ticket.index') }}" class="nav-link {{ Request::routeIs('Ticket.index') ? 'active' : '' }}">
                            <i class="far fas  fa-angle-right nav-icon"></i>
                            <p>Danh sách ticket</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}">
                <a href="{{ route('User.editProfile', Auth::user()->id) }}" class="nav-link {{ Request::routeIs('User.editProfile') ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Tài khoản</p>
                </a>
            </li>
        </ul>
    </nav>
    @endif
</div>
