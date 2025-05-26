<!--footer-area start-->
<footer class="footer-area">
    <div class="footer-bg-one pt-80 pb-80">
        <img src="/site/images/s-pattern-8b.svg" alt="" class="foot-pattern  img-fluid">
        <img src="/site/images/s-pattern-9b.svg" alt="" class="foot-pattern-2 img-fluid">
        <div class="container">
            <div class="row mb-30">
                <div class="col-xxl-2 col-lg-3 col-md-6">
                    <div class="footer__widget mb-30">
                        <h4 class="widget-title">Danh mục dịch vụ</h4>
                        <ul>
                            @foreach ($product_categories as $category)
                                <li>
                                    <a href="{{ route('front.show-product-category', $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="footer__widget mb-30 ps-xxl-5">
                        <h4 class="widget-title">Thông tin liên hệ</h4>
                        <ul class="fot-list">
                            <li>
                                <a href="mailto:{{ $config->email }}"><span><i class="bi bi-envelope"></i></span>
                                    {{ $config->email }}</a>
                            </li>
                            <li>
                                <a href="tel:{{ str_replace(' ', '', $config->hotline) }}"><span><i class="bi bi-headset"></i></span>
                                    {{ $config->hotline }}</a>
                            </li>
                            <li>
                                <a href="https://maps.app.goo.gl/{{ $config->address_company }}"><span><i class="bi bi-geo-alt"></i></span>
                                    {{ $config->address_company }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-5 col-md-6">
                    <div class="footer__widget mb-30">
                        <h4 class="widget-title">Giới thiệu về chúng tôi</h4>
                        <p>{{ $config->web_des }}</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="footer__widget mb-30 ps-xxl-5">
                        <div class="footer-map">
                            {!! $config->location !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright__area heding-bg pt-25 pe-lg-5 ps-lg-5 pb-1">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-start">
                        <div class="copyright__text mb-20">
                            <p>
                                <a class="fw-bold"
                                    href="{{ route('front.home-page') }}">{{ $config->web_title }}</a>
                                © 2025, All Rights Reserved
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 text-center text-lg-end mb-20">
                        <div class="hosting__payment"><img class="img-fluid" src="/site/images/payment.svg"
                                alt="payment">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer-area end-->
<!--scrollToTopBtn end-->
<a id="scrollToTopBtn" class="progress-wrap">
    <i class="bi bi-arrow-up"></i>
</a>
