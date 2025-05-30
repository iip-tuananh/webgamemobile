@extends('site.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('description')
    {{ $product->short_des }}
@endsection

@section('css')
@endsection

@section('content')
    <!-- main start -->
    <main>
        <!-- game details hero start -->
        <section class="pt-30p">
            <div class="section-pt">
                <div
                    class="relative bg-cover bg-no-repeat rounded-24 overflow-hidden" style="background-image: url('{{$product->product_image}}');">
                    <div
                        class="container relative 3xl:px-[140px] max-3xl:px-80p xl:py-[130px] md:py-30 sm:py-25 py-20 z-[2]">
                        <div class="max-w-[670px]">
                            <h1 class="heading-1 text-w-neutral-1 mb-3 text-left">
                                {{$product->name}}
                            </h1>
                            <p class="text-m-medium text-w-neutral-1 mb-24p">
                                {!! $product->intro !!}
                            </p>
                            <div class="flex items-center flex-wrap gap-3">
                                <a href="{{$product->origin_link}}" class="btn btn-md btn-primary rounded-12">
                                    <i class="fa fa-play"></i>
                                    Chơi ngay
                                </a>
                                <a href="{{$product->short_link}}" class="btn btn-md btn-facebook rounded-12">
                                    <i class="fab fa-facebook-f"></i>
                                    Fanpage
                                </a>
                                <a href="{{$product->aff_link}}" class="btn btn-md btn-zalo rounded-12">
                                    <i class="fas fa-comments"></i>
                                    Box Zalo
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="overlay-1"></div>
                </div>
            </div>
        </section>
        <!-- game details hero end -->
        <!-- game details section start -->
        <section class="pt-60p overflow-visible">
            <div class="container">
                <h3 class="heading-3 text-w-neutral-1 mb-30p">
                    Overview
                </h3>
                <div class="grid grid-cols-12 gap-x-24p gap-y-10">
                    <div class="xxl:col-span-8 col-span-12">
                        <div class="swiper thumbs-carousel-container mb-30p" data-carousel-name="home-hero-slider"
                            data-slides-per-view="4">
                            <div class="swiper thumbs-gallery-main">
                                <div class="swiper-wrapper">
                                    @foreach ($product->galleries as $gallery)
                                    <div class="swiper-slide rounded-12 overflow-hidden">
                                        <img class="w-full xxl:h-[480px] xl:h-[400px] md:h-[380px] sm:h-[320px] h-[280px] object-cover"
                                            src="{{$gallery->image ? $gallery->image->path : ''}}" alt="{{$product->name}}" />
                                    </div>
                                    @endforeach
                                    <div class="swiper-slide rounded-12 overflow-hidden">
                                        <img class="w-full xxl:h-[480px] xl:h-[400px] md:h-[380px] sm:h-[320px] h-[280px] object-cover"
                                            src="{{$product->product_image}}" alt="{{$product->name}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="thumbs-gallery pt-30p">
                                <div class="swiper-wrapper">
                                    @foreach ($product->galleries as $gallery)
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden cursor-pointer rounded-16">
                                            <img class="w-full xxl:h-[200px] lg:h-[160px] md:h-[140px] sm:h-25 h-18 object-cover hover:scale-110 transition-1"
                                                src="{{$gallery->image ? $gallery->image->path : ''}}" alt="game">
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden cursor-pointer rounded-16">
                                            <img class="w-full xxl:h-[200px] lg:h-[160px] md:h-[140px] sm:h-25 h-18 object-cover hover:scale-110 transition-1"
                                                src="{{$product->product_image}}" alt="{{$product->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }" class="pt-30p ">
                            <h4 class="heading-4 text-w-neutral-1 mb-16p">Giới thiệu game</h4>
                            <div class="grid grid-cols-1 gap-16p">
                                {!!$product->body!!}
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-4 col-span-12 relative">
                        <div class="xxl:sticky xxl:top-30">
                            <div class="p-40p rounded-12 bg-b-neutral-3">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <img class="avatar size-60p" src="{{$product->user_create->avatar}}"
                                        alt="{{$product->user_create->name}}" />
                                    <div>
                                        <span class="text-xl-medium text-w-neutral-1 mb-1">
                                            {{$product->user_create->name}}
                                        </span>
                                        <span class="text-m-regular text-w-neutral-4">
                                            Trạng thái: {{$product->status ? 'Đang hoạt động' : 'Đã khóa'}}
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-1 gap-16p py-24p *:flex *:items-center *:justify-between *:flex-wrap *:gap-16p">
                                    <div>
                                        <span class="text-m-regular text-w-neutral-4">
                                            Lượt xem:
                                        </span>
                                        <span class="text-m-medium text-w-neutral-1">
                                            {{ formatCurrency($product->base_price) }} view
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-m-regular text-w-neutral-4">
                                            Ngày đăng:
                                        </span>
                                        <span class="text-m-medium text-w-neutral-1">
                                            {{Carbon\Carbon::parse($product->created_at)->format('H:i d/m/Y')}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-m-regular text-w-neutral-4">
                                            Nền tảng:
                                        </span>
                                        <span class="text-m-medium text-w-neutral-1">
                                            {{$product->origin}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-m-regular text-w-neutral-4">
                                            Danh mục:
                                        </span>
                                        <span class="text-m-medium text-w-neutral-1">
                                            @php
                                                $category = $product->category;
                                                $parent = $category->category_parent;
                                                $parent_name = $parent ? '<a href="'.route('front.show-product-category', $parent->slug).'" class="text-m-medium text-w-neutral-1 hover:text-primary" style="display: inline-block;">'.$parent->name.'</a>, ' : '';
                                                $category_name = $category ? '<a href="'.route('front.show-product-category', $category->slug).'" class="text-m-medium text-w-neutral-1 hover:text-primary" style="display: inline-block;">'.$category->name.'</a>' : '';
                                            @endphp
                                            {!!$parent_name!!}{!!$category_name!!}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-m-regular text-w-neutral-4">
                                            Thẻ tag:
                                        </span>
                                        @php
                                            $tags = $product->tags;
                                            $tag_names = $tags->pluck('name')->toArray();
                                            $tag_names = array_map(function($tag) {
                                                return '<a href="'.route('front.search').'?tag='.$tag.'" class="text-m-medium text-w-neutral-1 hover:text-primary" style="display: inline-block;">'.$tag.'</a>, ';
                                            }, $tag_names);
                                        @endphp
                                        <span class="text-m-medium text-w-neutral-1">
                                            {!!implode(', ', $tag_names)!!}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center flex-wrap gap-3">
                                    <a href="{{$product->origin_link}}" class="btn btn-md btn-primary rounded-12">
                                        <i class="fa fa-play"></i>
                                        Chơi ngay
                                    </a>
                                    <a href="{{$product->short_link}}" class="btn btn-md btn-facebook rounded-12">
                                        <i class="fab fa-facebook-f"></i>
                                        Fanpage
                                    </a>
                                    <a href="{{$product->aff_link}}" class="btn btn-md btn-zalo rounded-12">
                                        <i class="fas fa-comments"></i>
                                        Box Zalo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- game details section end -->
        <!-- related games start -->
        @if ($productsRelated->count() > 0)
        <section class="section-py">
            <div class="container">
                <div class="flex items-center justify-between flex-wrap gap-24p mb-40p">
                    <h2 class="heading-2 text-w-neutral-1 text-split-left">
                        Sản phẩm liên quan
                    </h2>
                    <a href="{{route('front.show-product-category', $product->category->slug)}}" class="btn btn-md btn-primary rounded-12">
                        <i class="fa fa-eye"></i>
                        Xem tất cả
                    </a>
                </div>
                <div class="swiper four-card-carousel" data-carousel-name="related-games" data-aos="fade-up">
                    <div class="swiper-wrapper pb-15">
                        @foreach ($productsRelated as $item)
                        <div class="swiper-slide">
                            <div class="w-full bg-b-neutral-3 px-20p pt-20p pb-32p rounded-12">
                                <a href="{{route('front.show-product-detail', $item->slug)}}" class="glitch-effect rounded-12 overflow-hidden mb-24p">
                                    <div class="glitch-thumb">
                                        <img class="w-full md:h-[228px] h-[200px] object-cover"
                                            src="{{$item->product_image}}" alt="{{$item->name}}" />
                                    </div>
                                    <div class="glitch-thumb">
                                        <img class="w-full md:h-[228px] h-[200px] object-cover"
                                            src="{{$item->product_image}}" alt="{{$item->name}}" />
                                    </div>
                                </a>
                                <div>
                                    <a href="{{route('front.show-product-detail', $item->slug)}}" class="heading-4 text-w-neutral-1 link-1 line-clamp-1">
                                        {{$item->title_seo}}
                                    </a>
                                </div>
                                <div class="flex items-center justify-between flex-wrap gap-1 mt-24p">
                                    <a href="{{$product->short_link}}" class="btn btn-xs rounded-12 btn-facebook w-40">
                                        <i class="fab fa-facebook-f"></i>
                                        Fanpage
                                    </a>
                                    <a href="{{$product->aff_link}}" class="btn btn-xs rounded-12 btn-zalo w-40">
                                        <i class="fas fa-comments"></i>
                                        Box Zalo
                                    </a>
                                    <a href="{{$product->origin_link}}" class="btn btn-xs btn-primary rounded-12 w-full">
                                        <i class="fas fa-play"></i>
                                        Chơi ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination pagination-one related-games-carousel-pagination flex-c gap-2.5">
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- related trending end -->
    </main>
    <!-- main end -->
@endsection

@push('script')
    {{-- <script>
        // Plus number quantiy product detail
        var plusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal)) {
                    jQuery('input[name="quantity"]').val(currentVal + 1);
                } else {
                    jQuery('input[name="quantity"]').val(1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        // Minus number quantiy product detail
        var minusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    jQuery('input[name="quantity"]').val(currentVal - 1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        app.controller('ProductDetailController', function($scope, $http, $interval, cartItemSync, $rootScope, $compile) {
            $scope.product = @json($product);
            $scope.form = {
                quantity: 1
            };

            $scope.selectedAttributes = [];
            jQuery('.product-attribute-values .badge').click(function() {
                if (!jQuery(this).hasClass('active')) {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).addClass('active');
                    if ($scope.selectedAttributes.length > 0 && $scope.selectedAttributes.find(item => item
                            .index == jQuery(this).data('index'))) {
                        $scope.selectedAttributes.find(item => item.index == jQuery(this).data('index'))
                            .value = jQuery(this).data('value');
                    } else {
                        let index = jQuery(this).data('index');
                        $scope.selectedAttributes.push({
                            index: index,
                            name: jQuery(this).data('name'),
                            value: jQuery(this).data('value'),
                        });
                    }
                } else {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).removeClass('active');
                    $scope.selectedAttributes = $scope.selectedAttributes.filter(item => item.index !=
                        jQuery(this).data('index'));
                }
                $scope.$apply();
                console.log($scope.selectedAttributes);
            });

            $scope.addToCartFromProductDetail = function() {
                let quantity = $('form input[name="quantity"]').val();
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Thao tác thành công !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.addToCartCheckoutFromProductDetail = function() {
                let quantity = $('form input[name="quantity"]').val();
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Thao tác thành công !')
                            window.location.href = "{{ route('cart.index') }}";
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script> --}}
@endpush
