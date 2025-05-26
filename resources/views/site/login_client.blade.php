@extends('site.layouts.master')
@section('title')
    {{ $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
@endsection
@section('css')
@endsection
@section('content')
    <main ng-controller="LoginClientController" ng-cloak>
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
                        <h2 class="page-title mb-10"><% title %></h2>
                        <div class="page-title-border mt-1 mb-10"></div>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb list-none justify-content-center justify-content-md-start">
                                <li><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                                <li><a href="#">Pages</a></li>
                                <li class="active" aria-current="page"><% title %></li>
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
        <!--login__section start-->
        <div class="login__section" ng-if="formLogin">
            <div class="container">
                <div class="form__wrapper__bg">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="signup-form text-center mb-30"
                                style="background-color: #cccc; padding: 20px; border-radius: 10px; box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.12);">
                                <h3 class="section__title-main mb-30">Đăng nhập tài khoản</h3>
                                <form id="login_client">
                                    <div class="mb-20">
                                        <div class="input-box mail">
                                            <span><img src="/site/images/message-bold.svg" alt="icon"
                                                    loading="lazy"></span>
                                            <input type="text" placeholder="Username or Email" name="account_name">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['account_name']">
                                            <strong><% errors['account_name'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="mb-20">
                                        <div class="input-box pass">
                                            <span><img src="/site/images/lock-bold.svg" alt="icon"
                                                    loading="lazy"></span>
                                            <input type="text" placeholder="Password" name="password">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['password']">
                                            <strong><% errors['password'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <button class="ht_btn" ng-click="loginClient()">Đăng nhập</button>
                                    </div>
                                </form>
                                <p class="text-dark mt-40">Bạn chưa có tài khoản? <a href="javascript:void(0)"
                                        ng-click="showFormRegister()"
                                        style="
                                            background: linear-gradient(93.42deg, #ff6737 0%, #ff4f13 53.12%, #ff3131 100%);
                                            -webkit-background-clip: text;
                                            -webkit-text-fill-color: transparent;
                                            font-weight: bold;
                                        "><b>Đăng
                                            ký
                                            ngay</b></a>
                                </p>
                                <h5 class="text-dark">Quên mật khẩu</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="signup__right__content mb-30">
                                <img class="w-100" src="/site/images/login-ilus-2.svg" alt="ilustration" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--login__section end-->
        <div class="signup__section" ng-if="formRegister">
            <div class="container">
                <div class="form__wrapper__bg">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="signup-form mb-30"
                                style="background-color: #cccc; padding: 20px; border-radius: 10px; box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.12);">
                                <h3 class="section__title-main mb-30">Tạo tài khoản</h3>
                                <form id="customer_register">
                                    <div class="mb-20">
                                        <div class="input-box">
                                            <span><img src="/site/images/profile.svg" alt="icon" loading="lazy"></span>
                                            <input type="text" placeholder="Username" name="account_name">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['account_name']">
                                            <strong><% errors['account_name'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="mb-20">
                                        <div class="input-box mail">
                                            <span><img src="/site/images/message-bold.svg" alt="icon"
                                                    loading="lazy"></span>
                                            <input type="email" placeholder="Email Name" name="email">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['email']">
                                            <strong><% errors['email'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="mb-20">
                                        <div class="input-box phone">
                                            <span><img src="/site/images/call-bold.svg" alt="icon"
                                                    loading="lazy"></span>
                                            <input type="text" placeholder="Phone Number" name="phone_number">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['phone_number']">
                                            <strong><% errors['phone_number'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="mb-20">
                                        <div class="input-box pass">
                                            <span><img src="/site/images/lock-bold.svg" alt="icon"
                                                    loading="lazy"></span>
                                            <input type="text" placeholder="Password" name="password">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['password']">
                                            <strong><% errors['password'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="mb-20">
                                        <div class="input-box pass">
                                            <span><img src="/site/images/lock-bold.svg" alt="icon"
                                                    loading="lazy"></span>
                                            <input type="text" placeholder="Confirm Password"
                                                name="password_confirmation">
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['password_confirmation']">
                                            <strong><% errors['password_confirmation'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="mb-20">
                                        <div class="input-check">
                                            <input type="checkbox" name="agree">
                                            <span class="text-dark">Tôi đã đọc và đồng ý với điều khoản và điều kiện</span>
                                        </div>
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['agree']">
                                            <strong><% errors['agree'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <button class="ht_btn" ng-click="registerClient()">Đăng ký</button>
                                    </div>
                                </form>
                                <p class="text-dark mt-40">Bạn đã có tài khoản? <a href="javascript:void(0)"
                                        ng-click="showFormLogin()"
                                        style="
                                            background: linear-gradient(93.42deg, #ff6737 0%, #ff4f13 53.12%, #ff3131 100%);
                                            -webkit-background-clip: text;
                                            -webkit-text-fill-color: transparent;
                                            font-weight: bold;
                                        "><b>Đăng
                                            nhập ngay</b></a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="signup__right__content mb-30">
                                <img class="w-100" src="/site/images/signup-ilus-1.svg" alt="ilustration"
                                    loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--signup__section end-->
    </main>
@endsection
@push('script')
    <script type="text/javascript">
        app.controller('LoginClientController', function($scope) {
            $scope.formLogin = true;
            $scope.formRegister = false;
            $scope.formRecoverPassword = false;
            $scope.title = 'Đăng nhập tài khoản';

            $scope.showFormLogin = function() {
                $scope.formLogin = true;
                $scope.formRegister = false;
                $scope.formRecoverPassword = false;
                $scope.title = 'Đăng nhập tài khoản';
            }
            $scope.showFormRegister = function() {
                $scope.formLogin = false;
                $scope.formRegister = true;
                $scope.formRecoverPassword = false;
                $scope.title = 'Đăng ký tài khoản';
            }

            if (window.location.href.includes('register')) {
                $scope.showFormRegister();
            }
            // if (DEFAULT_CLIENT_USER) {
            //     window.location.href = '{{ route('index') }}';
            // } else {
            //     let invite_code = '{{ request()->invite_code }}';
            //     if (invite_code) {
            //         $scope.showFormRegister();
            //         $scope.invite_code = invite_code;
            //     }
            // }

            $scope.errors = {};

            $scope.registerClient = function() {
                let data = $('#customer_register').serialize();
                $.ajax({
                    url: '{{ route('front.register-client-submit') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $scope.account_name = response.data.account_name;
                            $scope.password = response.data.password;
                            $scope.showFormLogin();
                        } else {
                            toastr.error(response.message);
                            $scope.errors = response.errors;
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                })
            }

            $scope.errors = {};
            $scope.loginClient = function() {
                let data = $('#login_client').serialize();
                console.log(data);

                $.ajax({
                    url: '{{ route('front.login-client-submit') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = '{{ route('ip_products.index') }}';
                        } else {
                            toastr.error(response.message);
                            $scope.errors = response.errors;
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                })
            }

            $scope.recoverPassword = function() {
                $.ajax({
                    url: '{{ route('front.recover-password-submit') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        recover_email: $scope.recover_email
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('.h_recover').hide();
                        } else {
                            $scope.errors = response.errors;
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                })
            }

            // function showRecoverPasswordForm() {
            //     document.getElementById('recover-password').style.display = 'block';
            //     document.getElementById('login').style.display = 'none';
            // }

            // function hideRecoverPasswordForm() {
            //     document.getElementById('recover-password').style.display = 'none';
            //     document.getElementById('login').style.display = 'block';
            // }
        })
    </script>
@endpush
