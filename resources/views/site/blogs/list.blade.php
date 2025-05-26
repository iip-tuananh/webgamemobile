@extends('site.layouts.master')
@section('title')
    {{ $cate_title }}
@endsection
@section('description')
    {{ $cate_des ?? '' }}
@endsection

@section('css')
@endsection

@section('content')
    <main>
        <!--page-title-area start-->
        {{-- <div class="page-title-area pt-100 pb-md-60"
            data-background="/site/images/page-title-shadow-bg-1a.png">
            <img class="shape__p1" src="/site/images/ht-star-2b.svg" alt="Shape" loading="lazy">
            <img class="shape__p2" src="/site/images/ht-star-2b.svg" alt="Shape" loading="lazy">
            <img class="shape__p3" src="/site/images/ht-star-2b.svg" alt="Shape" loading="lazy">
            <div class="blur__p4"></div>
            <div class="blur__p5"></div>
            <div class="blur__p6"></div>
            <div class="blur__p7"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5">
                        <div class="page-title-wrapper text-lg-start text-center mb-40">
                            <h2 class="page-title mb-10">{{ $cate_title }}</h2>
                            <div class="page-title-border mt-1 mb-10"></div>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb list-none justify-content-center justify-content-md-start">
                                    <li><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li class="active" aria-current="page">{{ $cate_title }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="page__title__img__wrapper text-xl-end text-center mb-40">
                            <img class="main__1 img-fluid" src="/site/images/ilustration-2a.svg"
                                alt="ilustration" loading="lazy">
                            <img class="main__2" src="/site/images/ilustration-1a.svg" alt="ilustration" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--page-title-area end-->
        <!-- blog__grid__section start -->
        <div class="blog__grid__section pt-50 pb-50 pt-lg-60 pb-lg-80">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                        <div class="ht-blog-five mb-45">
                            <div class="ht-blog__thumb">
                                <img class="w-100" src="{{ $blog->image ? $blog->image->path : '' }}" alt="blog" loading="lazy">
                                <div class="ht-blog__date">
                                    {{ formatDate($blog->created_at) }}
                                </div>
                            </div>
                            <div class="ht-blog__content">
                                <h3 class="blog-title mb-3 pb-20 text-dark"><a href="{{ route('front.detail-blog', $blog->slug) }}">{{ $blog->name }}</a>
                                </h3>
                                <div class="ht-blog__meta pb-2 mb-10">
                                    <span><a href="#" class="text-dark"><img src="/site/images/icon-1a.svg" alt="icon" loading="lazy">
                                            Admin</a></span>
                                    <span><a href="#" class="text-dark"><img src="/site/images/icon-2a.svg" alt="icon" loading="lazy">
                                            {{ $blog->category->name }}</a></span>
                                </div>
                                <div class="ht-blog-btn mt-3 d-none">
                                    <a class="ht_black_btn" href="{{ route('front.detail-blog', $blog->slug) }}">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="page-navigation mt-15">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog__grid__section end -->
    </main>
@endsection

@push('script')
@endpush
