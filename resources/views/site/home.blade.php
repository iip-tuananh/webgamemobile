@extends('site.layouts.master')
@section('title')
    {{ $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection
@section('css')
<style>
    .theme__main__banner-one .nice-select {
        width: 100%;
        border: 2px solid;
        /* border-image: linear-gradient(to right, #ff6737, #ff4f13) 1; */
        border-radius: 5px;
        line-height: 28px;
    }

    .theme__main__banner-one .domain-list {
        position: relative;
        width: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        grid-auto-flow: dense;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(225px, 1fr));
        justify-content: center;
    }

    @media (max-width: 768px) {
        .theme__main__banner-one .domain-list {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        }
    }

    .theme__main__banner-one .domain-list li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        overflow: hidden;
        text-align: center;
        margin: 20px;
        border-radius: 1rem;
        border: 1px solid #ebebeb;
    }

    .theme__main__banner-one .custom-shadow {
        -webkit-box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.12);
        -webkit-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
        border-radius: 1.5rem !important;
    }

    .theme__main__banner-one .custom-shadow:hover {
        -webkit-transform: translateY(-5px);
        transform: translateY(-5px);
        -webkit-box-shadow: 0 1rem 3rem rgba(31, 45, 61, 0.125) !important;
        box-shadow: 0 1rem 3rem rgba(31, 45, 61, 0.125) !important;
    }

    .theme__main__banner-one .single-domain img {
        display: inline-block;
        max-width: 100px;
        min-height: 13px;
        max-height: 34px;
        border-radius: 50%;
    }

    .btn-order-vps {
        background: linear-gradient(to right, #ff6737, #ff4f13);
        color: #fff;
        border: none;
    }
</style>
@endsection
@section('content')
<main ng-controller="HomeController" ng-cloak>
    <!-- theme__main__banner start -->
    <section class="theme__main__banner-one position-relative pb-50 pt-50 pb-md-100" style="background: url('/site/images/map-bg.png') no-repeat center center;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="theme__content text-lg-start text-center mb-5 mb-lg-0">
                        <h2 class="text-dark">Bạn muốn tìm vps nước nào ?</h2>
                        <h5 class="theme__subtitle text-dark">Bắt đầu xây dựng thương hiệu của bạn trên internet</h5>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <select class="form-select" ng-model="selectedCategory" ng-change="redirectToCategory(selectedCategory)">
                                    <option value="">Vui lòng chọn vps phù hợp</option>
                                    @foreach ($productCategories as $category)
                                    <option value="{{$category->slug}}"><a href="{{route('front.show-product-category', $category->slug)}}">{{$category->name}}</a></option>
                                    @endforeach
                                    <option value="vps-dat-hang" >VPS - ĐẶT HÀNG</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-order-vps" ng-click="redirectToCategory('vps-dat-hang')" style="height: 42px;">ĐẶT HÀNG VPS</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero__img">
                        <img src="/site/images/dedicated-server.svg " alt="hero__img" loading="lazy">
                        <img src="/site/images/logo-coin.png " alt="hero__img" class="animation-icon-img animation-icon-5" loading="lazy">
                        {{-- <img src="/site/images/wordpress-logo.svg " alt="hero__img" class="animation-icon-img animation-icon-5" loading="lazy"> --}}
                    </div>
                </div>
            </div>
            <div class="domain-name-block pt-100 mt--125">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <ul class="list-inline domain-list">
                            @foreach ($productCategories as $item)
                                <li class="list-inline-item white-bg custom-shadow">
                                    <a href="{{route('front.show-product-category', $item->slug)}}" style="padding: 15px;">
                                        <div class="single-domain">
                                            <img src="{{$item->image ? $item->image->path : ''}}" alt="domain" class="img-fluid">
                                            <div class="text-center mt-2" style="font-weight: 600;">{{$item->name}}</div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- theme__maina__banner end -->

    <!-- services__area start -->
    <section class="services__area pt-50 pb-50 pt-lg-60 pb-lg-30">
        <img class="shapes__one" src="/site/images/s-pattern-1a.svg" alt="pattern">
        <img class="shapes__two" src="/site/images/s-pattern-2a.svg" alt="pattern two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center mb-60" data-aos="fade-up" data-aos-delay="100">
                        {{-- <h4 class="section__title-sub">Services</h4> --}}
                        <h2 class="section__title-main">Tổng quan về dịch vụ</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="justify-content: center;">
                @foreach($productCategories as $productCategory)
                <div class="col-xl-4 col-lg-4 col-md-6 mb-50" data-aos="fade-up">
                    <div class="ht-services text-center">
                        <a class="ht-services__icon" href="{{route('front.show-product-category', $productCategory->slug)}}">
                            <div class="ht-services__icon-front">
                                <img src="{{$productCategory->image ? $productCategory->image->path : ''}}" alt="cloud" class="img-fluid" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 5px solid #fff;">
                            </div>
                            <div class="ht-services__icon-back">
                                <img src="{{$productCategory->image ? $productCategory->image->path : ''}}" alt="cloud" class="img-fluid" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 5px solid #fff;">
                            </div>
                        </a>
                        <h3 class="ht-services__title text-dark"><a href="{{route('front.show-product-category', $productCategory->slug)}}">{{$productCategory->name}}</a></h3>
                        <p class="text-dark m-0">{{$productCategory->short_des}}</p>
                    </div>
                    <div class="text-center" style="background-color: #383838; padding: 20px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <h4 class="ht-services__price mb-2 text-white">
                            <span>{{ formatCurrency($productCategory->min_sell_price) }}đ/tháng</span>
                        </h4>
                        <a class="ht-services__btn text-white" href="{{route('front.show-product-category', $productCategory->slug)}}">Learn More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- services__area end -->
    <!-- price__area start -->
    @foreach($categorySpecial as $category)
    <section class="price__area pt-50 pb-50 pt-lg-60 pb-lg-30" style="background: linear-gradient(to bottom, #0073ec 45%, rgba(114, 2, 187, 0.25) 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center mb-60" data-aos="fade-up" data-aos-delay="100">
                        {{-- <h4 class="section__title-sub">Our Pricing</h4> --}}
                        <h2 class="section__title-main text-white">{{$category->name}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($category->products as $key => $product)
                @if($key == 1)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="ht-plan active mb-30">
                        <div class="ht-plan__header">
                            {{-- <div class="ht-plan__icon">
                                <img class="ht-plan__icon-front" src="/site/images/server.svg"
                                    alt="icon" loading="lazy">
                                <img class="ht-plan__icon-back" src="/site/images/server.svg"
                                    alt="icon" loading="lazy">
                            </div> --}}
                            <h3 class="ht-plan__header-title">{{$product->name}}</h3>
                            <p class="ht-plan__header-desc">{{$product->short_des}}</p>
                            <div class="ht-plan__header-price">
                                <h2 class="price-title">{{ formatCurrency($product->sell_price) }}</h2>
                                <span>đ/tháng</span>
                            </div>
                        </div>
                        <div class="ht-plan__body mb-35">
                            <ul class="ht-plan__body-feature">
                                <li><a href="#">{{$product->cpu}} CPU</a></li>
                                <li><a href="#">{{$product->ram}} RAM</a></li>
                                <li><a href="#">{{$product->storage}} Storage</a></li>
                                <li><a href="#">{{$product->band_width}} Bandwidth</a></li>
                                @if($product->stream)
                                <li><a href="#">{{$product->stream}} Stream</a></li>
                                @endif
                                @if($product->os)
                                <li><a href="#">{{$product->os}}</a></li>
                                @endif
                                @if($product->origin)
                                <li><a href="#">{{$product->origin}}</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="ht-plan__footer">
                            <a class="ht_btn" href="javascript:void(0)" ng-click="addToCart({{$product->id}})">Đăng ký</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6 mt-lg-4 pt-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="ht-plan mb-30">
                        <div class="ht-plan__header">
                            {{-- <div class="ht-plan__icon">
                                <img class="ht-plan__icon-front" src="/site/images/server.svg" alt="icon" loading="lazy">
                                <img class="ht-plan__icon-back" src="/site/images/server.svg" alt="icon" loading="lazy">
                            </div> --}}
                            <h3 class="ht-plan__header-title">{{$product->name}}</h3>
                            <p class="ht-plan__header-desc">{{$product->short_des}}</p>
                            <div class="ht-plan__header-price">
                                <h2 class="price-title">{{ formatCurrency($product->sell_price) }}</h2>
                                <span>đ/tháng</span>
                            </div>
                        </div>
                        <div class="ht-plan__body mb-25">
                            <ul class="ht-plan__body-feature">
                                <li><a href="#">{{$product->cpu}} CPU</a></li>
                                <li><a href="#">{{$product->ram}} RAM</a></li>
                                <li><a href="#">{{$product->storage}} Storage</a></li>
                                <li><a href="#">{{$product->band_width}} Bandwidth</a></li>
                                @if($product->stream)
                                <li><a href="#">{{$product->stream}} Stream</a></li>
                                @endif
                                @if($product->os)
                                <li><a href="#">{{$product->os}}</a></li>
                                @endif
                                @if($product->origin)
                                <li><a href="#">{{$product->origin}}</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="ht-plan__footer">
                            <a class="ht_btn" href="javascript:void(0)" ng-click="addToCart({{$product->id}})">Đăng ký</a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    @endforeach
    <!-- price__area end -->
    <!-- chose__area start -->
    <section class="chose__area pt-50 pb-50 pt-lg-55 pb-lg-30" style="background: url(/site/images/offer-bg-3.png) no-repeat center center / cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="chose__content-wrapper mb-30">
                        <div class="section__title mb-40 pe-xl-3">
                            {{-- <h4 class="section__title-sub">Why Choose Us</h4> --}}
                            <h2 class="section__title-main text-white">Tại sao nên chọn chúng tôi</h2>
                            {{-- <p>Dynamically innovate enabled synergy vis-a-vis user friendly channels.
                                Appropriately engage extensible supply chains before cutting-edge opportunities.
                            </p> --}}
                        </div>
                        <div class="chose__feature">
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#collapseOne"> Hiệu suất mạnh mẽ <span class="float-end"><i class="fa fa-caret-down"></i></span></a>
                            <div class="collapse p-3" id="collapseOne" style="background-color: #f8f9fa;">
                                <p class="text-dark">Chúng tôi sử dụng CPU Intel Xeon dòng E3 và E5 trên các máy chủ của mình, cùng với ổ SSD trong RAID để mang đến cho bạn những máy ảo nhanh vượt trội</p>
                            </div>
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#collapseTwo"> Hệ điều hành đa dạng <span class="float-end"><i class="fa fa-caret-down"></i></span></a>
                            <div class="collapse p-3" id="collapseTwo" style="background-color: #f8f9fa;">
                                <p class="text-dark">Chúng tôi hỗ trợ nhiều hệ điều hành khác nhau bao gồm Windows Server, Windows Desktop và Linux</p>
                            </div>
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#collapseThree"> An toàn thông tin<span class="float-end"><i class="fa fa-caret-down"></i></span></a>
                            <div class="collapse p-3" id="collapseThree" style="background-color: #f8f9fa;">
                                <p class="text-dark">Kiểm soát, ngăn chặn xâm nhập, hạn chế rủi ro hệ thống. Bảo đảm dữ liệu bảo mật và an toàn</p>
                            </div>
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#collapseFour"> Hỗ trợ 24/7<span class="float-end"><i class="fa fa-caret-down"></i></span></a>
                            <div class="collapse p-3" id="collapseFour" style="background-color: #f8f9fa;">
                                <p class="text-dark">Đội ngũ IT, Chăm sóc khách hàng chuyên nghiệp, sẵn sàng cho mọi tình huống, hỗ trợ nhanh chóng</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="chose__img text-lg-end mb-30 pe-lg-3">
                        <img src="/site/images/ilus-main-1a.png" alt="ilustration"
                            class="chose__img-ilus img-fluid">
                        <img src="/site/images/tick-mark-1a.svg" alt="tickmark" class="chose__img-top">
                        <img src="/site/images/board-1a.svg" alt="board" class="chose__img-top-1">
                        <img class="chose__img-shapes-two" src="/site/images/ab-star-1a.svg"
                            alt="About Shape Two">
                        <img class="chose__img-shapes-three" src="/site/images/ch-big-star-1a.svg"
                            alt="About Shape Three">
                        <img class="chose__img-shapes-four" src="/site/images/ab-star-3a.svg"
                            alt="About Shape Four">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- chose__area end -->
    <!-- testimonial__area start -->
    {{-- <section class="testimonial__area pt-50 pb-50 pt-lg-60 pb-lg-30">
        <img class="shapes__one" src="/site/images/s-pattern-1a.svg" alt="pattern">
        <img class="shapes__two" src="/site/images/s-pattern-2a.svg" alt="pattern two">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-xl-6">
                    <div class="section__title text-center mb-60">
                        <h2 class="section__title-main">Đánh giá khách hàng
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-slider-container">
            <div class="row testimonial__slider">
                @foreach($reviews as $review)
                <div class="col-lg-4">
                    <div class="testimonial__wrapper">
                        <div class="rating">
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                        </div>
                        <p>
                            {{$review->message}}
                        </p>
                        <img class="author__avatar" src="assets/img/testimonial/author-1.jpg"
                            alt="autho avatar">
                        <h3 class="author__name text-white">
                            {{$review->name}}
                        </h3>
                        <h5 class="author__designation">
                            Medical Assistant
                        </h5>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination-area d-none d-md-inline-block">
                <div class="next_t1"><i class="bi bi-chevron-left"></i></div>
                <div class="prev_t1"><i class="bi bi-chevron-right"></i></div>
            </div>
        </div>
    </section> --}}
    <!-- testimonial__area end -->
    <!-- blog__area start -->
    {{-- @foreach($categorySpecialPost as $category)
    <section class="blog__area pt-50 pb-50 pt-lg-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section__title text-center mb-60" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="section__title-main">{{$category->name}}</h2>
                    </div>
                </div>
            </div>
            <div class="row blog__slider__one">
                @foreach($category->posts as $post)
                <div class="col-lg-4">
                    <div class="ht-blog">
                        <div class="ht-blog__thumb mb-20">
                            <img class="w-100" src="{{$post->image ? $post->image->path : ''}}" alt="blog" loading="lazy">
                            <div class="ht-blog__date">
                                {{ formatDate($post->created_at) }}
                            </div>
                        </div>
                        <div class="ht-blog__content mb-20">
                            <div class="ht-blog__meta mt-10">
                                <span><a href="#" class="text-dark"><img src="/site/images/icon-1a.svg" alt="icon">
                                        Admin</a></span>
                                <span><a href="#" class="text-dark"><img src="/site/images/icon-2a.svg" alt="icon">
                                        {{$post->category->name}}</a></span>
                            </div>
                            <h3 class="blog-title text-dark"><a href="{{route('front.detail-blog', $post->slug)}}">{{$post->name}}</a>
                            </h3>
                            <p class="text-dark">{{$post->intro}}</p>
                            <div class="ht-blog-btn mt-2">
                                <a class="ht_btn" href="{{route('front.detail-blog', $post->slug)}}">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach --}}
    <section class="blog__area pt-50 pb-50 pt-lg-60">
        <div class="container">
            <div class="row">
                @foreach($postCategories as $category)
                <div class="col-xl-6 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section__title mb-10" data-aos="fade-up" data-aos-delay="100">
                                <h4 class="section__title-main">{{$category->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($category->posts as $post)
                        <div class="col-lg-12">
                            <div class="ht-blog mb-20">
                                <div class="ht-blog__content mb-20">
                                    <div class="blog-title text-dark" style="font-size: 18px"><a href="{{route('front.detail-blog', $post->slug)}}">{{$post->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- blog__area end -->
</main>
@endsection
@push('script')
<script>
    app.controller('HomeController', function($scope, $http) {
        $scope.selectedCategory = '';
        $scope.redirectToCategory = function(category) {
            if(category == 'vps-dat-hang') {
                $('#modal-vps-dat-hang').modal('show');
            } else if(category == '') {
                $scope.selectedCategory = '';
                $scope.$applyAsync();
            } else {
                window.location.href = '{{route('front.show-product-category', ['categorySlug' => 'categorySlug'])}}'.replace('categorySlug', category);
            }
        };
    });
</script>
@endpush
