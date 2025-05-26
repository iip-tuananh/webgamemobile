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
                            <h2 class="page-title mb-10">{{ $title }}</h2>
                            <div class="page-title-border mt-1 mb-10"></div>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb list-none justify-content-center justify-content-md-start">
                                    <li><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li class="active" aria-current="page">{{ $title }}</li>
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

        <!-- services__area-two start -->
        <section class="services__area-two pt-50 pb-50 pt-lg-60 pb-lg-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="section__title text-center mb-50">
                            <h4 class="section__title-sub-two mb-20">Services</h4>
                            <h2 class="section__title-main">{{ $title }}</h2>
                            <div>{!! $short_des !!}</div>
                        </div>
                    </div>
                </div>
                @foreach ($products as $product)
                    <div class="row ht-services-three text-center text-md-start mb-30" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="col-lg-12 mb-lg-0 mb-3">
                            <div class="d-md-flex align-items-center justify-content-between">
                                <div class=" number">{{ $product->name }}</div>
                                <div>vCPU <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ $product->cpu }}</span> </div>
                                <div>RAM <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ $product->ram }}</span> </div>
                                <div>Disk space <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ $product->storage }}</span> </div>
                                <div>Traffic <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ $product->band_width }}</span> </div>
                                <div>IP-VPS <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ $product->stream }}</span> </div>
                                {{-- <div>Location <br> {{ $product->origin }} </div> --}}
                                @if ($product->os)
                                    <div>OS <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ $product->os }}</span> </div>
                                @endif
                                <div>Price <br> <span class="text-dark" style="font-weight: 600; font-size: 20px">{{ formatCurrency($product->sell_price) }}đ/tháng </span> </div>
                                <div class="services-bottom-content">
                                    <a class="ht_btn" href="javascript:void(0)" ng-click="addToCart({{$product->id}})">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- services__area-two end -->
        <!--feature__section start-->
        {{-- <div class="feature__section pt-150 pt-lg-100 pb-50 pb-lg-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="ht__feature__two text-center mb-30 mt-35"
                            data-background="/site/images/feature-bg-shape-1a.png">
                            <div class="ht__feature-icon">
                                <img src="/site/images/seo.svg" alt="chose" loading="lazy">
                            </div>
                            <h4 class="ht-feature-title mb-20">Hiệu suất mạnh mẽ</h4>
                            <p class="text-dark">Chúng tôi sử dụng CPU Intel Xeon dòng E3 và E5 trên các máy chủ của mình, cùng với ổ SSD trong RAID để mang đến cho bạn những máy ảo nhanh vượt trội</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="ht__feature__two text-center mb-30 mt-35"
                            data-background="/site/images/feature-bg-shape-1a.png">
                            <div class="ht__feature-icon">
                                <img src="/site/images/seo.svg" alt="chose" loading="lazy">
                            </div>
                            <h4 class="ht-feature-title mb-20">Hệ điều hành đa dạng</h4>
                            <p class="text-dark">Chúng tôi hỗ trợ nhiều hệ điều hành khác nhau bao gồm Windows Server, Windows Desktop và Linux</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="ht__feature__two text-center mb-30 mt-35"
                            data-background="/site/images/feature-bg-shape-1a.png">
                            <div class="ht__feature-icon">
                                <img src="/site/images/discount-label.svg" alt="chose" loading="lazy">
                            </div>
                            <h4 class="ht-feature-title mb-20">An toàn thông tin</h4>
                            <p class="text-dark">Kiểm soát, ngăn chặn xâm nhập, hạn chế rủi ro hệ thống. Bảo đảm dữ liệu bảo mật và an toàn</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="ht__feature__two text-center mb-30 mt-35"
                            data-background="/site/images/feature-bg-shape-1a.png">
                            <div class="ht__feature-icon">
                                <img src="/site/images/monitor.svg" alt="chose" loading="lazy">
                            </div>
                            <h4 class="ht-feature-title mb-20">Hỗ trợ 24/7</h4>
                            <p class="text-dark">Đội ngũ IT, Chăm sóc khách hàng chuyên nghiệp, sẵn sàng cho mọi tình huống, hỗ trợ nhanh chóng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--feature__section end-->
        <div class="feature__section pt-150 pt-lg-100 pb-120 pb-lg-30">
            <div class="container">
            <div class="row justify-content-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="section__title text-center mb-50">
                    <h4 class="section__title-sub-two">What We Are</h4>
                    <h2 class="section__title-main">Lý do nên chọn {{ $title }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="ht__feature__three text-center mb-30 pt-70 mt-70">
                        <div class="ht__feature-icon mb-30">
                        <img src="/site/images/speed_icon.png" alt="chose" loading="lazy" width="100" height="100">
                        </div>
                        <h4 class="ht-feature-title mb-20">Hiệu suất mạnh mẽ</h4>
                        <p class="text-dark">Chúng tôi sử dụng CPU Intel Xeon dòng E3 và E5 trên các máy chủ của mình, cùng với ổ SSD trong RAID để mang đến cho bạn những máy ảo nhanh vượt trội</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="150">
                    <div class="ht__feature__three text-center mb-30 pt-70 mt-70">
                        <div class="ht__feature-icon mb-30">
                        <img src="/site/images/mac_os_window_icon.png" alt="chose" loading="lazy" width="80" height="80">
                        </div>
                        <h4 class="ht-feature-title mb-20">Hệ điều hành đa dạng</h4>
                        <p class="text-dark">Chúng tôi hỗ trợ nhiều hệ điều hành khác nhau bao gồm Windows Server, Windows Desktop và Linux</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="ht__feature__three text-center mb-30 pt-70 mt-70">
                        <div class="ht__feature-icon mb-30">
                        <img src="/site/images/cloud_icon.png" alt="chose" loading="lazy" width="80" height="80">
                        </div>
                        <h4 class="ht-feature-title mb-20">An toàn thông tin</h4>
                        <p class="text-dark">Kiểm soát, ngăn chặn xâm nhập, hạn chế rủi ro hệ thống. Bảo đảm dữ liệu bảo mật và an toàn</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="250">
                    <div class="ht__feature__three text-center mb-30 pt-70 mt-70">
                        <div class="ht__feature-icon mb-30">
                        <img src="/site/images/support_time_icon.png" alt="chose" loading="lazy" width="80" height="80">
                        </div>
                        <h4 class="ht-feature-title mb-20">Hỗ trợ 24/7</h4>
                        <p class="text-dark">Đội ngũ IT, Chăm sóc khách hàng chuyên nghiệp, sẵn sàng cho mọi tình huống, hỗ trợ nhanh chóng</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
@endpush
