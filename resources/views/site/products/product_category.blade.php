@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $short_des }}
@endsection
@section('css')
@endsection

@section('content')
    <!-- main start -->
    <main>
        <!-- breadcrumb start -->
        <section class="pt-30p">
            <div class="section-pt">
                <div class="relative bg-cover bg-no-repeat rounded-24 overflow-hidden"
                    style="background-image: url('/site/images/breadcrumbImg.png');">
                    <div class="container">
                        <div class="grid grid-cols-12 gap-30p relative xl:py-[130px] md:py-30 sm:py-25 py-20 z-[2]">
                            <div class="lg:col-start-2 lg:col-end-12 col-span-12">
                                <h2 class="heading-2 text-w-neutral-1 mb-3">
                                    {{ $title }}
                                </h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front.home-page') }}" class="breadcrumb-link">
                                            Trang chủ
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-icon">
                                            <i class="ti ti-chevrons-right"></i>
                                        </span>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-current">{{ $title }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="overlay-11"></div>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->
        <!-- trending section start -->
        <section class="section-pb pt-60p">
            <div class="container">
                <div class="grid 4xl:grid-cols-2 xxl:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-24p">
                    @foreach ($products as $product)
                        <div class="w-full bg-b-neutral-3 p-24p rounded-24 grid 4xl:grid-cols-2 grid-cols-1 items-center gap-24p group"
                            data-aos="zoom-in">
                            <div class="overflow-hidden rounded-24">
                                <img class="w-full xxl:h-[304px] xl:h-[280px] md:h-[260px] h-[240px] object-cover group-hover:scale-110 transition-1"
                                    src="{{ $product->product_image }}" alt="{{ $product->name }}" />
                            </div>
                            <div>
                                <div class="flex-y flex-wrap gap-2">
                                    @foreach ($product->tags as $tag)
                                        <span class="badge badge-neutral-2 badge-smm">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <a href="{{ route('front.show-product-detail', $product->slug) }}"
                                    class="heading-3 text-w-neutral-1 4xl:line-clamp-2 line-clamp-1 link-1 my-16p text-split-left">
                                    {{ $product->title_seo }}
                                </a>
                                <div class="flex-y flex-wrap *:py-2 *:px-3 mb-20p">
                                    <div class="flex-y gap-2.5">
                                        <span class="badge badge-secondary size-3 badge-circle"></span>
                                        <p class="text-base text-neutral-100">
                                            <span class="span">{{ formatCurrency($product->base_price) }}</span> Lượt xem
                                        </p>
                                    </div>
                                    <div class="flex-y gap-2.5">
                                        <span class="badge badge-primary size-3 badge-circle"></span>
                                        @php
                                            $diffInHours = now()->diffInHours($product->created_at);
                                            $diffInDays = now()->diffInDays($product->created_at);
                                            $diffInWeeks = now()->diffInWeeks($product->created_at);
                                        @endphp
                                        <p class="text-base text-neutral-100">
                                            <span class="span">
                                                @if($diffInHours < 24)
                                                    {{ $diffInHours }} giờ trước
                                                @elseif($diffInDays < 7)
                                                    {{ $diffInDays }} ngày trước
                                                @else
                                                    {{ $diffInWeeks }} tuần trước
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex-y flex-wrap gap-3">
                                    <img class="size-60p rounded-full shrink-0"
                                        src="{{ $product->user_create ? $product->user_create->avatar : '' }}"
                                        alt="{{ $product->user_create->name }}" />
                                    <div>
                                        <a href="javascript:void(0)" class="text-l-medium link-1 text-w-neutral-1 mb-1">
                                            {{ $product->user_create->name }}
                                            <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                        </a>
                                        <span class="text-s-medium text-w-neutral-4">Leader</span>
                                    </div>
                                </div>
                                <div class="flex-y flex-wrap gap-1" style="margin-top: 20px;">
                                    <a href="{{ $product->origin_link }}" class="btn btn-xs btn-primary rounded-12">
                                        {{-- <i class="fas fa-play"></i> --}}
                                        Chơi ngay
                                    </a>
                                    <a href="{{ $product->short_link }}" class="btn btn-xs rounded-12 btn-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                        Fanpage
                                    </a>
                                    <a href="{{ $product->aff_link }}" class="btn btn-xs rounded-12 btn-zalo">
                                        <i class="fas fa-comments"></i>
                                        Box Zalo
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex-c mt-48p">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
        <!-- trending section end -->
    </main>
    <!-- main end -->
@endsection

@push('script')
@endpush
