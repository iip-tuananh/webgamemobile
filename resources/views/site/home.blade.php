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
@endsection
@section('content')
<main>
    <!-- hero section start -->
    <section class="section-pt overflow-visible">
        <div class="container relative pt-[30px]">
            <div class="grid grid-cols-12 items-center gap-30p">
                <div class="xxl:col-span-12 col-span-12">
                    <div class="relative">
                        <div class="swiper one-card-carousel rounded-12" data-carousel-name="home-two-hero">
                            <div class="swiper-wrapper">
                                @foreach ($banners as $banner)
                                <div class="swiper-slide">
                                    <div class="w-full rounded-16 overflow-hidden relative">
                                        <img class="w-full lg:h-[506px] md:h-[440px] h-[380px] object-cover"
                                            src="{{$banner->image->path}}" alt="banner" />
                                        {{-- <div class="overlay-1"></div> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div>
                                <div
                                    class="swiper-pagination pagination-two home-two-hero-carousel-pagination items-center gap-2.5  pb-40p px-40p sm:flex justify-end hidden">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero section end -->
    <!-- home 3 all games section start -->
    @foreach ($categorySpecial as $category)
    <section class="section-pt">
        <div class="container">
            <div class="flex items-center justify-between flex-wrap gap-24p">
                <h2 class="heading-2">
                    {{$category->name}}
                </h2>
            </div>
            <div class="mt-40p" data-aos="fade-up">
                <div class="swiper four-card-carousel" data-carousel-name="all-games-one"
                    data-carousel-reverse="true">
                    <div class="swiper-wrapper pb-15">
                        <!-- Card 1 -->
                        @foreach ($category->products as $product)
                        <div class="swiper-slide">
                            <div
                                class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                <div class="relative overflow-hidden rounded-12">
                                    <span
                                        class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                        <i class="ti ti-eye"></i>
                                        {{ formatCurrency($product->base_price) }}
                                    </span>
                                    <img src="{{$product->product_image}}"
                                        class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                        alt="img" />
                                </div>
                                <div class="mt-20p">
                                    <a href="{{route('front.show-product-detail', $product->slug)}}" class="heading-4 link-1 mb-2 line-clamp-2" style="height: 60px;">
                                        {{$product->title_seo}}
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                        {{$product->intro}}
                                    </p>
                                    <div class="flex-y gap-4 justify-between">
                                        <div class="flex-y gap-3">
                                            <img class="avatar size-60p shrink-0"
                                                src="{{$product->user_create->avatar}}" alt="user" />
                                            <div>
                                                <a href="javascript:void(0)" class="flex-y gap-2 mb-1">
                                                    <span
                                                        class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">{{$product->user_create->name}}</span>
                                                    <i
                                                        class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                                </a>
                                                <span class="text-s-medium text-w-neutral-3">
                                                    Leader
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{$product->origin_link}}" class="btn btn-md btn-primary rounded-12">
                                                <i class="fas fa-play"></i>
                                                Chơi ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div
                        class="swiper-pagination pagination-one all-games-one-carousel-pagination flex-c gap-2.5">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- home 3 all games section end -->
    <!-- Popular Games Two section start -->
    @foreach ($productCategories as $category)
    @if ($category->products->count() > 0)
    <section class="section-pt">
        <div class="container">
            <div class="flex items-center justify-between flex-wrap gap-24p">
                <h2 class="heading-2 text-w-neutral-1 text-split-left">
                    {{$category->name}}
                </h2>
                <a href="{{route('front.show-product-category', $category->slug)}}" class="btn btn-lg py-3 btn-neutral-2 shrink-0">
                    Xem tất cả
                </a>
            </div>
            <div class="mt-40p" data-aos="fade-up">
                <div class="swiper four-card-carousel" data-carousel-name="popular-games-one">
                    <div class="swiper-wrapper pb-15">
                        <!-- card 1 -->
                        @foreach ($category->products as $product)
                        <div class="swiper-slide">
                            <div class="w-full bg-b-neutral-3 rounded-12 group">
                                <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                        src="{{$product->product_image}}" alt="item" />
                                </div>
                                <div class="p-20p">
                                    <a href="{{route('front.show-product-detail', $product->slug)}}"
                                        class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                        {{$product->title_seo}}
                                    </a>
                                    <div class="flex-y flex-wrap gap-1">
                                        <a href="{{$product->origin_link}}" class="btn btn-xs btn-primary rounded-12">
                                            {{-- <i class="fas fa-play"></i> --}}
                                            Chơi ngay
                                        </a>
                                        <a href="{{$product->short_link}}" class="btn btn-xs rounded-12 btn-facebook">
                                            <i class="fab fa-facebook-f"></i>
                                            Fanpage
                                        </a>
                                        <a href="{{$product->aff_link}}" class="btn btn-xs rounded-12 btn-zalo">
                                            <i class="fas fa-comments"></i>
                                            Box Zalo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div
                        class="swiper-pagination pagination-one popular-games-one-carousel-pagination flex-c gap-2.5">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endforeach
    <!-- Popular Games Two section end -->
    <!-- Twitch Streaming section start -->
    {{-- <section class="section-pt">
        <div class="container">
            <div class="flex items-center justify-between flex-wrap gap-24p">
                <h2 class="heading-2 text-w-neutral-1 text-split-left">
                    Twitch Streaming
                </h2>
                <form class="select-1 shrink-0">
                    <select class="select w-full sm:py-3 py-2 px-24p rounded-full">
                        <option value="popular">Popular</option>
                        <option value="new-releases">New Releases</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="sports">Sports</option>
                    </select>
                </form>
            </div>
            <div class="mt-40p">
                <div class="grid 3xl:grid-cols-2 grid-cols-1 gap-30p">
                    <div>
                        <div class="swiper one-card-carousel rounded-32"
                            data-carousel-name="twitch-streaming" data-carousel-reverse="true">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="relative rounded-32 overflow-hidden w-full group">
                                        <img class="w-full xl:h-[630px] md:h-[580px] sm:h-[500px] h-[420px] object-cover rounded-32 group-hover:scale-110 transition-1"
                                            src="./assets/images/photos/heroBanner11.webp" alt="img" />
                                        <div
                                            class="overlay-6 p-40p flex flex-col items-start justify-between">
                                            <span class="badge badge-lg badge-primary">
                                                430 Viewers
                                            </span>
                                            <div
                                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                                <a href="./live-stream.html"
                                                    class="btn-c size-100p icon-40 bg-primary text-b-neutral-4">
                                                    <i class="ti ti-player-play-filled"></i>
                                                </a>
                                            </div>
                                            <div class="w-full">
                                                <h2
                                                    class="heading-2 text-w-neutral-1 line-clamp-1 p-1 mb-20p">
                                                    The Legend of Zelda: Breath of the Wild
                                                </h2>
                                                <div class="flex-y gap-3 text-sm text-w-neutral-1">
                                                    <span class="px-24p py-3">
                                                        English
                                                    </span>
                                                    <span class="px-24p py-3">
                                                        Strumming
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="relative rounded-32 overflow-hidden w-full group">
                                        <img class="w-full xl:h-[630px] md:h-[580px] sm:h-[500px] h-[420px] object-cover rounded-32 group-hover:scale-110 transition-1"
                                            src="./assets/images/photos/heroBanner4.webp" alt="img" />
                                        <div
                                            class="overlay-6 p-40p flex flex-col items-start justify-between">
                                            <span class="badge badge-lg badge-primary">
                                                270 Viewers
                                            </span>
                                            <div
                                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                                <a href="./live-stream.html"
                                                    class="btn-c size-100p icon-40 bg-primary text-b-neutral-4">
                                                    <i class="ti ti-player-play-filled"></i>
                                                </a>
                                            </div>
                                            <div class="w-full">
                                                <h2
                                                    class="heading-2 text-w-neutral-1 line-clamp-1 p-1 mb-20p">
                                                    Fortnite - Hints to beat them all!
                                                </h2>
                                                <div class="flex-y gap-3 text-sm text-w-neutral-1">
                                                    <span class="px-24p py-3">
                                                        English
                                                    </span>
                                                    <span class="px-24p py-3">
                                                        Strumming
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="relative rounded-32 overflow-hidden w-full group">
                                        <img class="w-full xl:h-[630px] md:h-[580px] sm:h-[500px] h-[420px] object-cover rounded-32 group-hover:scale-110 transition-1"
                                            src="./assets/images/photos/heroBanner5.webp" alt="img" />
                                        <div
                                            class="overlay-6 p-40p flex flex-col items-start justify-between">
                                            <span class="badge badge-lg badge-primary">
                                                340 Viewers
                                            </span>
                                            <div
                                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                                <a href="./live-stream.html"
                                                    class="btn-c size-100p icon-40 bg-primary text-b-neutral-4">
                                                    <i class="ti ti-player-play-filled"></i>
                                                </a>
                                            </div>
                                            <div class="w-full">
                                                <h2
                                                    class="heading-2 text-w-neutral-1 line-clamp-1 p-1 mb-20p">
                                                    The Legend of Zelda: Breath of the Wild
                                                </h2>
                                                <div class="flex-y gap-3 text-sm text-w-neutral-1">
                                                    <span class="px-24p py-3">
                                                        English
                                                    </span>
                                                    <span class="px-24p py-3">
                                                        Strumming
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="swiper-navigation swp-navigation-one absolute top-0 right-0 z-[3] p-40p">
                                <button type="button"
                                    class="navigation-btn-one twitch-streaming-carousel-prev">
                                    <i class="ti ti-chevron-left"></i>
                                </button>
                                <button type="button"
                                    class="navigation-btn-one twitch-streaming-carousel-next">
                                    <i class="ti ti-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid 3xl:grid-cols-1 md:grid-cols-2 grid-cols-1 gap-24p">
                        <div class="grid 3xl:grid-cols-2 grid-cols-1 gap-24p items-center p-20p bg-b-neutral-3 rounded-12 group"
                            data-aos="fade-up">
                            <div
                                class="w-full xl:h-[264px] sm:h-[240px] h-[220px] overflow-hidden rounded-12">
                                <img class="w-full xl:h-[264px] sm:h-[240px] h-[220px] group-hover:scale-110 object-cover rounded-12 transition-1"
                                    src="./assets/images/games/game50.png" alt="img" />
                            </div>
                            <div>
                                <a href="./live-stream.html"
                                    class="heading-3 text-w-neutral-1 link-1 line-clamp-2 text-split-left">
                                    Odyssey through the Prism Realm
                                </a>
                                <div class="flex items-normal gap-3 my-20p">
                                    <div class="shrink-0 relative h-[70px] w-fit">
                                        <img class="avatar size-[60px]"
                                            src="./assets/images/users/user30.png" alt="user" />
                                        <span
                                            class="absolute md:-bottom-2 -bottom-0 left-1/2 -translate-x-1/2 badge px-2 py-1 badge-danger">
                                            Live
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Online
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Action
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Shooter
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Strategy
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            PVP
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 *:btn-socal-accent-4 *:rounded-full">
                                    <a href="#">
                                        <i class="ti ti-brand-twitch"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti ti-brand-instagram"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti ti-brand-discord"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti ti-brand-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="grid 3xl:grid-cols-2 grid-cols-1 gap-24p p-20p bg-b-neutral-3 rounded-12 group"
                            data-aos="fade-up">
                            <div
                                class="w-full xl:h-[264px] sm:h-[240px] h-[220px] overflow-hidden rounded-12">
                                <img class="w-full xl:h-[264px] sm:h-[240px] h-[220px] group-hover:scale-110 object-cover rounded-12 transition-1"
                                    src="./assets/images/games/game49.png" alt="img" />
                            </div>
                            <div>
                                <a href="./live-stream.html"
                                    class="heading-3 text-w-neutral-1 link-1 line-clamp-2 text-split-left">
                                    Odyssey through the Prism Realm
                                </a>
                                <div class="flex items-normal gap-3 my-20p">
                                    <div class="shrink-0 relative h-[70px]">
                                        <img class="avatar size-[60px]"
                                            src="./assets/images/users/user30.png" alt="user" />
                                        <span
                                            class="absolute md:-bottom-2 -bottom-0 left-1/2 -translate-x-1/2 badge px-2 py-1 badge-danger">
                                            Live
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Online
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Action
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Shooter
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            Strategy
                                        </span>
                                        <span class="badge badge-smm badge-neutral-2 font-normal">
                                            PVP
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 *:btn-socal-accent-4 *:rounded-full">
                                    <a href="#">
                                        <i class="ti ti-brand-twitch"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti ti-brand-instagram"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti ti-brand-discord"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti ti-brand-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Twitch Streaming section end -->
    <!--Top Rated section start -->
    @foreach ($categorySpecialPost as $category)
    <section class="section-py">
        <div class="container">
            <div class="flex items-center justify-between flex-wrap gap-24p">
                <h2 class="heading-2 text-w-neutral-1 text-split-left">
                    {{$category->name}}
                </h2>
                <a href="{{route('front.list-blog', $category->slug)}}" class="btn btn-lg px-32p btn-neutral-2">
                    Xem tất cả
                </a>
            </div>
            <div class="mt-40p">
                <div class="swiper three-card-carousel" data-carousel-name="top-rated-stream">
                    <div class="swiper-wrapper pb-15">
                        <!-- card 1 -->
                        @foreach ($category->posts as $post)
                        <div class="swiper-slide">
                            <div class="relative rounded-12 overflow-hidden w-full group">
                                <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="{{$post->image ? $post->image->path : ''}}" alt="img" />
                                <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span
                                        class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                        <i class="ti ti-calendar-event icon-24 text-primary"></i>
                                        {{$post->created_at->format('d/m/Y')}}
                                    </span>
                                    <div class="w-full">
                                        <a href="{{route('front.detail-blog', $post->slug)}}"
                                            class="library-title heading-4 link-1 mb-2 line-clamp-2">
                                            {{$post->name}}
                                        </a>
                                        <span class="text-l-regular text-w-neutral-2 mb-20p line-clamp-2">{{$post->intro}}</span>
                                        <div class="flex-y justify-between gap-16p">
                                            <a href="{{route('front.detail-blog', $post->slug)}}"
                                                class="btn btn-md btn-danger rounded-12">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div
                        class="swiper-pagination pagination-one top-rated-stream-carousel-pagination flex-c gap-2.5">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- Top Rated section start -->
</main>
@endsection
@push('script')
@endpush
