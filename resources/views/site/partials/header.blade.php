<!-- header-area start -->
<header class="theme-main-menu theme-menu-one pt-0">
    <div class="topbar py-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="topbar-content d-flex align-items-center justify-content-center justify-content-md-between">
                        <div class="ht-email d-none d-lg-inline-block" style="margin-left: 10px;">
                            <div class="d-flex align-items-center">
                                <a style="background-color: #e9401e;" class="me-2 head-icon-social" href="mailto:{{$config->email}}"><i class="fa fa-envelope"></i></a>
                                <a style="background-color: #4090FF;" class="me-2 head-icon-social" href="tel:{{str_replace(' ', '', $config->hotline)}}"><i class="fa fa-phone"></i></a>
                                <a style="background-color: #0c86ef;" class="me-2 head-icon-social" href="{{$config->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a style="background-color: #00AFF0;" class="me-2 head-icon-social" href="https://zalo.me/{{$config->zalo}}" target="_blank"><img src="/site/images/zalo.png" alt="zalo" width="30" height="30"></a>
                                <a style="background-color: #9b3f24;" class="me-2 head-icon-social" href="{{$config->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ht-promo d-none d-md-inline-block">
                        </div>
                        <div class="ht-links">
                            <a href="" title="Vietnam">
                                <img src="/site/images/vietnamese.png" alt="Vietnam" width="25" height="25">
                            </a>
                            <a href="" title="English" class="me-4">
                                <img src="/site/images/english.png" alt="English" width="25" height="25">
                            </a>
                            @if(Auth::check())
                            <a href="{{route('index')}}" class="btn btn-danger">
                                <span>
                                    <img src="{{Auth::user()->avatar}}" alt="avatar" width="25" height="25" style="border-radius: 50%; border: 1px solid #fff;" loading="lazy">
                                </span>
                                {{Auth::user()->name}}
                            </a>
                            @else
                            <a href="{{route('front.login-client')}}" class="btn btn-danger"><span><i class="bi bi-person-plus"></i></span> Đăng nhập</a>
                            <a href="{{route('front.login-client')}}?register=true" class="btn btn-danger"><span><i class="bi bi-person-plus"></i></span> Đăng ký</a>
                            @endif
                            <a class="me-4 chating btn btn-danger" href="tel:{{ str_replace(' ', '', $config->hotline)}}"><span><img width="25"
                                src="/site/images/support-1.png" alt="icon"></span> Hỗ trợ 24/7</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-sm-4 col-6">
                    <div class="logo-area">
                        <a class="front" href="{{route('front.home-page')}}"><img src="{{$config->image->path}}" loading="lazy"
                                alt="Header-logo"></a>
                        <a class="back" href="{{route('front.home-page')}}"><img src="{{$config->image->path}}" loading="lazy"
                                alt="Header-logo"></a>
                    </div>
                </div>
                <div class="col-lg-10 col-sm-8 col-6 d-flex align-items-center justify-content-end">
                    <div class="main-menu d-none d-lg-block">
                        <nav id="mobile-menu">
                            <ul class="menu-list">
                                <li>
                                    <a href="{{route('front.home-page')}}">
                                        Trang chủ
                                    </a>
                                </li>
                                @foreach($productCategories as $category)
                                <li>
                                    <a class="{{$category->childs->count() > 0 ? 'menu-has-child' : ''}}" href="{{route('front.show-product-category', $category->slug)}}">{{$category->name}}</a>
                                    @if($category->childs->count() > 0)
                                    <ul class="sub-menu">
                                        @foreach($category->childs as $child)
                                        <li>
                                            <a href="{{route('front.show-product-category', $child->slug)}}">{{$child->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                                @foreach($postCategories as $category)
                                <li>
                                    <a class="{{$category->getChilds()->count() > 0 ? 'menu-has-child' : ''}}" href="{{route('front.list-blog', $category->slug)}}">{{$category->name}}</a>
                                    @if($category->getChilds()->count() > 0)
                                    <ul class="sub-menu">
                                        @foreach($category->getChilds() as $child)
                                        <li>
                                            <a href="{{route('front.list-blog', $child->slug)}}">{{$child->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{route('front.contact-us')}}">
                                        Liên hệ
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="right-nav mb-0 d-flex align-items-center ms-sm-5">
                        <div class="cart__menu">
                            <a class="shopping-cart" href="javascript:void(0)">
                                <i class="bi bi-bag"></i>
                                <span class="badge" ng-if="cart.count > 0"><% cart.count %></span>
                            </a>
                        </div>
                        <div class="search-area d-none me-sm-4 ms-2">
                            <a class="search_input" href="#" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                                <i class="bi bi-search"></i>
                            </a>
                        </div>
                        <div class="hamburger-menu d-lg-none d-md-inline-block">
                            <a class="round-menu" href="javascript:void(0);">
                                <i class="far fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.theme-main-menu -->
</header>
<!-- header-area end -->
<!-- slide-bar start -->
<aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);">
            <i class="fas fa-times"></i>
        </a>
    </div>
    <!-- offset-sidebar start -->
    <div class="offset-sidebar">
        <div class="offset-widget offset-logo mb-30">
            <a href="{{route('front.home-page')}}">
                <img src="{{$config->image->path}}" alt="logo" loading="lazy" style="width: 100%;">
            </a>
        </div>
        <div class="mobile-menu-wrapper overflow-hidden mb-5">
            <div class="mobile-menu"></div>
        </div>
        <div class="offset-widget mb-40">
            <div class="info-widget">
                <h4 class="offset-title mb-20">About Us</h4>
                <p class="mb-30">
                    {{$config->web_des}}
                </p>
            </div>
        </div>
        <div class="offset-widget mb-30 pr-10">
            <div class="info-widget info-widget2">
                <h4 class="offset-title mb-20">Contact Info</h4>
                <p>
                    <i class="fal fa-address-book"></i>
                    {{$config->address_company}}
                </p>
                <p>
                    <i class="fal fa-phone"></i>
                    {{$config->hotline}}
                </p>
                <p>
                    <i class="fal fa-envelope-open"></i>
                    {{$config->email}}
                </p>
            </div>
        </div>
        {{-- <div class="login-btn text-center">
            <a class="ht_btn w-100" href="{{route('front.login-client')}}">Đăng nhập</a>
        </div> --}}
    </div>
    <!-- offset-sidebar end -->
</aside>
<div class="body-overlay"></div>
<!-- slide-bar end -->
