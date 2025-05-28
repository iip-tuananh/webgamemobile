<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('site.partials.head')
    <script defer src="/site/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="/site/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('css')

    <!-- Angular Js -->
    <script src="{{ asset('libs/angularjs/angular.js?v=222222') }}"></script>
    <script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
    <script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
    <script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
    <script src="{{ asset('libs/angularjs/select.js') }}"></script>
    <script src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @stack('script')
    <script>
        app.controller('AppController', function($rootScope, $scope, cartItemSync, $interval, $compile){
            $scope.currentUser = @json(Auth::user());
            $scope.isAdminClient = @json(Auth::check());

            const currentUrl = window.location.href;

            // Biên dịch lại nội dung bên trong container
            var container = angular.element(document.getElementsByClassName('item_product_main'));
            $compile(container.contents())($scope);

            var popup = angular.element(document.getElementById('popup-cart-mobile'));
            $compile(popup.contents())($scope);

            var quickView = angular.element(document.getElementById('quick-view-product'));
            $compile(quickView.contents())($scope);

            // Đặt mua hàng
            $scope.hasItemInCart = false;
            $scope.cart = cartItemSync;
            $scope.item_qty = 1;

            $scope.addToCart = function (productId, quantity = 1) {
                if (!DEFAULT_CLIENT_USER) {
                    // toastr.warning('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
                    $('#modal-login-notify').modal('show');
                    return;
                }
                url = "{{route('cart.add.item', ['productId' => 'productId'])}}";
                url = url.replace('productId', productId);
                let item_qty = quantity;

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        'qty': parseInt(item_qty)
                    },
                    success: function (response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function () {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Thao tác thành công !')
                            $scope.$applyAsync();
                        }
                    },
                    error: function () {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.changeQty = function (qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function (product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function (product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{route('cart.update.item')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function(){
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            // xóa item trong giỏ
            $scope.removeItem = function (product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{route('cart.remove.item')}}",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.cart.items = response.items;
                            $scope.cart.count = Object.keys($scope.cart.items).length;
                            $scope.cart.totalCost = response.total;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function(){
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            if ($scope.cart.count == 0) {
                                $scope.hasItemInCart = false;
                            }
                            $scope.$applyAsync();
                        }
                    },
                    error: function (e) {
                        jQuery.toast.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            // Xem nhanh
            $scope.quickViewProduct = {};
            $scope.showQuickView = function (productId) {
                $.ajax({
                    url: "{{route('front.get-product-quick-view')}}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        product_id: productId
                    },
                    success: function (response) {
                        $('#quick-view-product .quick-view-product').html(response.html);
                        var quickView = angular.element(document.getElementById('quick-view-product'));
                        $compile(quickView.contents())($scope);
                        $scope.$applyAsync();
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            // Search product
            jQuery('#live-search').keyup(function() {
                var keyword = jQuery(this).val();
                jQuery.ajax({
                    type: 'post',
                    url: '{{route("front.auto-search-complete")}}',
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    data: {keyword: keyword},
                    success: function(data) {
                        jQuery('.live-search-results').html(data.html);
                    }
                })
            });

            $scope.form_vps_dat_hang = {
                your_name: '',
                your_email: '',
                your_phone: '',
                your_message: ''
            };
            $scope.errors = {};
            $scope.isLoadingFormVpsDatHang = false;

            $scope.sendFormVpsDatHang = function() {
                $scope.isLoadingFormVpsDatHang = true;
                let data = $scope.form_vps_dat_hang;
                jQuery.ajax({
                    url: '{{route("front.post-contact")}}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: data,
                    success: function(response) {
                        if(response.success) {
                            toastr.success('Gửi thông tin đặt hàng thành công');
                            $('#modal-vps-dat-hang').modal('hide');
                            $scope.form_vps_dat_hang = {
                                your_name: '',
                                your_email: '',
                                your_phone: '',
                                your_message: ''
                            };
                        } else {
                            toastr.error('Gửi thông tin đặt hàng thất bại');
                            $scope.errors = response.errors;
                            $scope.isLoadingFormVpsDatHang = false;
                        }
                    },
                    error: function(response) {
                        toastr.error('Gửi thông tin đặt hàng thất bại');
                        $scope.errors = response.errors;
                        $scope.isLoadingFormVpsDatHang = false;
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.goToHomePage = function() {
                window.location.href = '{{ route('front.home-page') }}';
            }

        })

        app.factory('cartItemSync', function ($interval) {
            var cart = {items: null, total: null};

            cart.items = @json($cartItems);
            cart.count = {{$cartItems->sum('quantity')}};
            cart.total = {{$totalPriceCart}};

            return cart;
        });

        @if(Session::has('token'))
        localStorage.setItem('{{ env("prefix") }}-token', "{{Session::get('token')}}")
        @endif
        @if(Session::has('logout'))
        localStorage.removeItem('{{ env("prefix") }}-token');
        @endif
        var CSRF_TOKEN = "{{ csrf_token() }}";
        @if (Auth::check())
        const DEFAULT_CLIENT_USER = {
            id: "{{ Auth::user()->id }}",
            fullname: "{{ Auth::user()->name }}"
        };
        @else
        const DEFAULT_CLIENT_USER = null;
        @endif
    </script>
</head>

<body ng-app="App" ng-controller="AppController" ng-cloak style="background: #030304 url('{{Route::currentRouteName() == 'front.home-page' ? $config->background_website->path : ''}}') no-repeat center center fixed; background-size: cover;">
    @if(Route::currentRouteName() == 'front.home-page')
    <div class="background-overlay"></div>
    <style>
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }
    </style>
    @endif

    <!-- preloader start -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader end -->
    <!-- scroll to top button start -->
    <button class="scroll-to-top show" id="scrollToTop">
        <i class="ti ti-arrow-up"></i>
    </button>
    <!-- scroll to top button end -->
    @include('site.partials.header')
    <!-- app layout start -->
    <div class="min-h-screen lg:ml-[240px] lg:mr-[136px] px-[10px]">
        <!-- main start -->
        @yield('content')
        <!-- main end -->
        <!-- video popup modal start -->
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 items-center justify-center z-[999] hidden">
            <!-- Modal Backdrop -->
            <div id="modal-backdrop" class="video-modal-backdrop"></div>
            <!-- Modal Content -->
            <div class="relative z-[999] rounded-lg w-full lg:max-w-screen-md max-w-screen-sm h-auto sm:mx-6 mx-5">
                <!-- Modal Body -->
                <div class="modal-body relative">
                    <!-- Close Button -->
                    <button id="modal-close-btn"
                        class="absolute -top-5 -right-5 text-b-neutral-4 sm:size-9 size-7 flex justify-center items-center rounded-full bg-primary transition-1">
                        <i class="ti ti-x icon-24"></i>
                    </button>
                    <iframe class="w-full lg:h-[420px] sm:h-[320px] xsm:h-[260px] h-[220px] border-none"
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
        <!-- video popup modal end -->
        @include('site.partials.footer')
    </div>
    <!-- app layout end -->
</body>

</html>
