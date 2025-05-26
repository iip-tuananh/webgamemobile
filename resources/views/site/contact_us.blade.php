@extends('site.layouts.master')
@section('title')
    Liên hệ
@endsection

@section('css')
    <link href="{{ asset('site/css/style_page.scss.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('site/css/contact_style.scss.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('site/css/breadcrumb_style.scss.css') }}" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
    <main ng-controller="ContactUsController" ng-cloak>
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
                            <h2 class="page-title mb-10">Liên hệ</h2>
                            <div class="page-title-border mt-1 mb-10"></div>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb list-none justify-content-center justify-content-md-start">
                                    <li><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li class="active" aria-current="page">Liên hệ</li>
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
        <!--contact__section start-->
        <div class="contact__section pt-50 pb-50 pt-lg-60 pb-lg-60">
            <div class="container">
                <div class="contact-form mb-30">
                    <h3 class="section__title-main text-center mb-55">Gửi liên hệ đến chúng tôi</h3>
                    <form>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-box mb-40">
                                    <label class="label text-dark">Name</label>
                                    <input type="text" placeholder="Enter Name" ng-model="your_name">
                                    <div class="invalid-feedback d-block error" role="alert">
                                        <span ng-if="errors && errors.your_name">
                                            <% errors.your_name[0] %>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-box mb-40">
                                    <label class="label text-dark">Email</label>
                                    <input type="email" placeholder="Email Address" ng-model="your_email">
                                    <div class="invalid-feedback d-block error" role="alert">
                                        <span ng-if="errors && errors.your_email">
                                            <% errors.your_email[0] %>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-box mb-40">
                                    <label class="label text-dark">Phone Number</label>
                                    <input type="text" placeholder="Mobile Num" ng-model="your_phone">
                                    <div class="invalid-feedback d-block error" role="alert">
                                        <span ng-if="errors && errors.your_phone">
                                            <% errors.your_phone[0] %>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-box mb-40">
                                    <label class="label text-dark">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Write Your Messages" ng-model="your_message"></textarea>
                                    <div class="invalid-feedback d-block error" role="alert">
                                        <span ng-if="errors && errors.your_message">
                                            <% errors.your_message[0] %>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="ht_btn mt-10 border-0" type="submit" ng-click="submitContact()">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--contact__section end-->
        <!--contact__info__section end-->
        <div class="contact__info__section pt-45 pt-lg-30 pb-100">
            <div class="container">
                <div class="contact__info__wrapper white-bg pt-30">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="single__info__box mb-30">
                                <div class="icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <span class="mb-15">HOTLINE: <a href="tel:{{ str_replace(' ', '', $config->hotline) }}">{{ $config->hotline }}</a><br>
                                    <span class="mb-15">ZALO: <a href="https://zalo.me/{{ str_replace(' ', '', $config->zalo) }}">{{ $config->zalo }}</a></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single__info__box mb-30">
                                <div class="icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <span class="mb-15"><a href="mailto:{{ $config->email }}">{{ $config->email }}</a></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single__info__box mb-30">
                                <div class="icon">
                                    <i class="bi bi-facebook"></i>
                                </div>
                                <span class="mb-15"><a href="{{ $config->facebook }}" target="_blank">{{ $config->facebook }}</a></span>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-md-6">
                            <div class="single__info__box mb-30">
                                <div class="icon">
                                    <i class="bi bi-skype"></i>
                                </div>
                                <span class="mb-15"><a href="{{ $config->facebook }}" target="_blank">{{ $config->facebook }}</a></span>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--contact__info__section end-->
        <!--contact__map__section end-->
        <div class="contact__map__section">
            <div class="container-fluid px-0">
                <div class="row">
                    <div class="contact__map">
                        {!! $config->location !!}
                    </div>
                </div>
            </div>
        </div>
        <!--contact__map__section end-->
    </main>
@endsection

@push('script')
    <script>
        app.controller('ContactUsController', function($scope, $http) {
            $scope.loading = false;
            $scope.errors = {};
            $scope.submitContact = function() {
                $scope.loading = true;
                let data = {
                    your_name: $scope.your_name,
                    your_email: $scope.your_email,
                    your_phone: $scope.your_phone,
                    your_message: $scope.your_message
                };
                jQuery.ajax({
                    url: '{{ route('front.post-contact') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Thao tác thành công !')
                        } else {
                            $scope.errors = response.errors;
                            toastr.error('Thao tác thất bại !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                        $scope.loading = false;
                    }
                });
            };
        });
    </script>
@endpush
