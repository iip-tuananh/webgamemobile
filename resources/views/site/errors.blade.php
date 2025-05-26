@extends('site.layouts.master')
@section('title')
    <title>{{ 'Không tìm thấy trang - ' . ucfirst($_SERVER['HTTP_HOST']) }}</title>
@endsection
@section('css')
@endsection

@section('content')
    <main>
        <!--page-title-area start-->
        <div class="page-title-area pt-100 pb-md-60"
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
                            <h2 class="page-title mb-10">Error</h2>
                            <div class="page-title-border mt-1 mb-10"></div>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb list-none justify-content-center justify-content-md-start">
                                    <li><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li class="active" aria-current="page">Không tìm thấy trang</li>
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
        </div>
        <!--page-title-area end-->
        <!-- error__section start -->
        <div class="error__section pt-150 pt-lg-120 pb-150 pb-lg-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="error__img__wrapper text-center">
                            <img class="w-100" src="/site/images/error-1.svg" alt="ilustration" loading="lazy">
                            <a class="ht_btn mt-60" href="{{route('front.home-page')}}">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- error__section end -->
    </main>
@endsection
@push('scripts')
@endpush
