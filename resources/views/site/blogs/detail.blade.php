@extends('site.layouts.master')
@section('title')
    {{ $blog_title }}
@endsection
@section('description')
    {{ $blog_description }}
@endsection

@section('css')
@endsection

@section('content')
    <!-- main start -->
    <main>
        <!-- breadcrumb start -->
        <section class="pt-30p">
            <div class="section-pt">
                <div
                    class="relative bg-cover bg-no-repeat rounded-24 overflow-hidden" style="background-image: url('/site/images/breadcrumbImg.png');">
                    <div class="container">
                        <div class="grid grid-cols-12 gap-30p relative xl:py-[130px] md:py-30 sm:py-25 py-20 z-[2]">
                            <div class="lg:col-start-2 lg:col-end-12 col-span-12">
                                <h2 class="heading-2 text-w-neutral-1 mb-3">
                                    {{$blog_title}}
                                </h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('front.home-page')}}" class="breadcrumb-link">
                                            Trang chủ
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-icon">
                                            <i class="ti ti-chevrons-right"></i>
                                        </span>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-current">{{$blog_title}}</span>
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
        <!-- saved details start -->
        <section class="section-pb relative overflow-visible pt-60p">
            <div class="container">
                <div class="grid grid-cols-12 gap-x-30p gap-y-10">
                    <div class="4xl:col-span-9 xxl:col-span-8 col-span-12">
                        <div>
                            <div class="glitch-effect rounded-24 overflow-hidden" data-aos="fade-up">
                                <div class="glitch-thumb">
                                    <img class="w-full xxl:h-[510px] lg:h-[400px] md:h-[360px] sm:h-[300px] h-[280px] object-cover"
                                        src="{{$blog->image ? $blog->image->path : ''}}" alt="{{$blog->name}}">
                                </div>
                                <div class="glitch-thumb">
                                    <img class="w-full xxl:h-[510px] lg:h-[400px] md:h-[360px] sm:h-[300px] h-[280px] object-cover"
                                        src="{{$blog->image ? $blog->image->path : ''}}" alt="{{$blog->name}}">
                                </div>
                            </div>
                            <div class="flex-y flex-wrap gap-24p justify-between py-20p text-base text-w-neutral-1"
                                data-aos="fade-up">
                                <div class="flex-y gap-32p shrink-0 *:flex-y *:gap-2">
                                    <span>
                                        <i class="ti ti-calendar-event icon-24 text-w-neutral-4"></i>
                                        {{$blog->created_at->format('d/m/Y')}}
                                    </span>
                                    <span>
                                        <i class="ti ti-user icon-24 text-w-neutral-4"></i>
                                        {{$blog->user_create->name}}
                                    </span>
                                </div>
                            </div>
                            <div data-aos="fade-up">
                                <h2 class="heading-2 mb-3">
                                    {{$blog->name}}
                                </h2>
                                {!! $blog->body !!}
                            </div>
                            <div class="flex-y flex-wrap justify-between gap-20p py-16p border-y border-shap/70 mb-30p"
                                data-aos="fade-up">
                                <h3 class="heading-3">
                                    Chia sẻ
                                </h3>
                                <div class="flex items-center gap-3">
                                    <a href="#" class="btn-socal-primary">
                                        <i class="ti ti-brand-facebook"></i>
                                    </a>
                                    <a href="#" class="btn-socal-primary">
                                        <i class="ti ti-brand-twitch"></i>
                                    </a>
                                    <a href="#" class="btn-socal-primary">
                                        <i class="ti ti-brand-instagram"></i>
                                    </a>
                                    <a href="#" class="btn-socal-primary">
                                        <i class="ti ti-brand-discord"></i>
                                    </a>
                                    <a href="#" class="btn-socal-primary">
                                        <i class="ti ti-brand-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="4xl:col-span-3 xxl:col-span-4 col-span-12">
                        <div class="xxl:sticky xxl:top-24">
                            <div class="grid grid-cols-1 gap-30p *:bg-b-neutral-3 *:rounded-12 *:px-32p *:py-24p">
                                <div data-aos="fade-up">
                                    <h4 class="heading-4 text-w-neutral-1 mb-20p">
                                        Tìm kiếm
                                    </h4>
                                    <form
                                        class="bg-b-neutral-4 px-16p py-3 flex items-center justify-between sm:gap-3 gap-2 rounded-12">
                                        <input autocomplete="off" class="bg-transparent text-w-neutral-1 w-full"
                                            type="text" name="search" id="search" placeholder="Tìm kiếm...">
                                        <span class="flex-c icon-24 text-w-neutral-4">
                                            <i class="ti ti-search"></i>
                                        </span>
                                    </form>
                                </div>
                                <div data-aos="fade-up">
                                    <h4 class="heading-4 text-w-neutral-1 mb-20p">
                                        Bài viết gần đây
                                    </h4>
                                    <div class="grid grid-cols-1 gap-20p">
                                        @foreach ($other_blogs as $newBlog)
                                        <div class="flex-y gap-2.5">
                                            <img class="w-28 h-[90px] rounded-10"
                                                src="{{$newBlog->image ? $newBlog->image->path : ''}}" alt="{{$newBlog->name}}" />
                                            <div>
                                                <div class="flex items-center gap-2 mb-2.5">
                                                    <i class="ti ti-calendar-time text-primary icon-24"></i>
                                                    <span class="span text-sm text-w-neutral-4">
                                                        {{$newBlog->created_at->format('d/m/Y')}}
                                                    </span>
                                                </div>
                                                <a href="{{route('front.detail-blog', $newBlog->slug)}}" class="text-base text-w-neutral-1 line-clamp-2 link-1">
                                                    {{$newBlog->name}}
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div data-aos="fade-up">
                                    <h4 class="heading-4 text-w-neutral-1 mb-20p">
                                        Category
                                    </h4>
                                    <ul
                                        class="grid grid-cols-1 gap-16p *:flex-y *:justify-between text-m-regular text-w-neutral-1">
                                        <li>
                                            <a href="#" class="hover:text-secondary transition-1">
                                                Gaming
                                            </a>
                                            <span class="text-w-neutral-4">
                                                (12)
                                            </span>
                                        </li>
                                        <li>
                                            <a href="#" class="hover:text-secondary transition-1">
                                                Live
                                            </a>
                                            <span class="text-w-neutral-4">
                                                (12)
                                            </span>
                                        </li>
                                        <li>
                                            <a href="#" class="hover:text-secondary transition-1">
                                                Electronic
                                            </a>
                                            <span class="text-w-neutral-4">
                                                (13)
                                            </span>
                                        </li>
                                        <li>
                                            <a href="#" class="hover:text-secondary transition-1">
                                                Online
                                            </a>
                                            <span class="text-w-neutral-4">
                                                (07)
                                            </span>
                                        </li>
                                        <li>
                                            <a href="#" class="hover:text-secondary transition-1">
                                                Contraoller
                                            </a>
                                            <span class="text-w-neutral-4">
                                                (02)
                                            </span>
                                        </li>
                                    </ul>
                                </div> --}}
                                <div data-aos="fade-up">
                                    <h4 class="heading-4 text-w-neutral-1 mb-20p">
                                        Tags
                                    </h4>
                                    <div class="tag">
                                        @foreach ($tag_search_all as $tag)
                                        <a href="#" class="tag-item tag-neutral-4">
                                            {{$tag->name}}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- saved details end -->
    </main>
    <!-- main end -->
@endsection

@push('script')
@endpush
