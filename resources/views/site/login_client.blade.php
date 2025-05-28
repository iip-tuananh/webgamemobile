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
        <!-- breadcrumb start -->
        <section class="pt-30p">
            <div class="section-pt">
                <div class="relative bg-cover bg-no-repeat rounded-24 overflow-hidden"
                    style="background-image: url('/site/images/breadcrumbImg.png');">
                    <div class="container">
                        <div class="grid grid-cols-12 gap-30p relative xl:py-[130px] md:py-30 sm:py-25 py-20 z-[2]">
                            <div class="lg:col-start-2 lg:col-end-12 col-span-12">
                                <h2 class="heading-2 text-w-neutral-1 mb-3">
                                    <% title %>
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
                                        <span class="breadcrumb-current"><% title %></span>
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
        <section class="section-py">
            <div class="container pt-30p">
                <div class="grid grid-cols-12 gap-30p">
                    <div class="xxl:col-start-3 xxl:col-end-11 col-span-12 ">
                        <div class="bg-b-neutral-3 rounded-12 p-40p" ng-if="formRegister">
                            <h4 class="heading-4 text-w-neutral-1 mb-60p">
                                <% title %>
                            </h4>
                            <form id="customer_register">
                                <div class="grid grid-cols-8 gap-30p">
                                    <div class="col-span-8">
                                        <label for="account_name" class="label label-lg mb-3">Họ và tên</label>
                                        <input type="text" name="account_name" id="account_name" class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['account_name']">
                                            <strong><% errors['account_name'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="col-span-8">
                                        <label for="email" class="label label-lg mb-3">Email</label>
                                        <input type="email" name="email" id="email" class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['email']">
                                            <strong><% errors['email'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="col-span-8">
                                        <label for="phone_number" class="label label-lg mb-3">Số điện thoại</label>
                                        <input type="text" name="phone_number" id="phone_number" class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['phone_number']">
                                            <strong><% errors['phone_number'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="sm:col-span-4 col-span-8">
                                        <label for="password" class="label label-lg mb-3">Mật khẩu</label>
                                        <input type="password" name="password" id="password" class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['password']">
                                            <strong><% errors['password'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="sm:col-span-4 col-span-8">
                                        <label for="password_confirmation" class="label label-lg mb-3">Nhập lại mật
                                            khẩu</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['password_confirmation']">
                                            <strong><% errors['password_confirmation'][0] %></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center md:justify-between justify-center">
                                    <a href="javascript:void(0)" class="text-m-regular text-w-neutral-1 hover:text-primary mt-60p"
                                        ng-click="showFormLogin()">
                                        Đăng nhập?
                                    </a>
                                    <button class="btn btn-md btn-primary rounded-12 mt-60p" ng-click="registerClient()">
                                        Đăng ký
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="bg-b-neutral-3 rounded-12 p-40p" ng-if="formLogin">
                            <h4 class="heading-4 text-w-neutral-1 mb-60p">
                                <% title %>
                            </h4>
                            <form id="login_client">
                                <div class="grid grid-cols-8 gap-30p">
                                    <div class="col-span-8">
                                        <label for="account_name" class="label label-lg mb-3">Họ và tên</label>
                                        <input type="text" name="account_name" id="account_name" class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['account_name']">
                                            <strong><% errors['account_name'][0] %></strong>
                                        </span>
                                    </div>
                                    <div class="col-span-8">
                                        <label for="password" class="label label-lg mb-3">Mật khẩu</label>
                                        <input type="password" name="password" id="password" class="box-input-3" />
                                        <span class="invalid-feedback d-block error" style="text-align: left;"
                                            role="alert" ng-if="errors && errors['password']">
                                            <strong><% errors['password'][0] %></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center md:justify-between justify-center">
                                    <a href="javascript:void(0)" class="text-m-regular text-w-neutral-1 hover:text-primary mt-60p"
                                        ng-click="showFormRegister()">
                                        Đăng ký tài khoản?
                                    </a>
                                    <button class="btn btn-md btn-primary rounded-12 mt-60p" ng-click="loginClient()">
                                        Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                            window.location.href = '{{ route('Product.index') }}';
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
