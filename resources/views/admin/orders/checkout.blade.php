@extends('layouts.main')

@section('css')
@endsection

@section('page_title')
    Trang thanh toán
@endsection

@section('title')
    Trang thanh toán
@endsection

@section('buttons')
@endsection

@section('content')

<div ng-controller="Checkout" ng-cloak>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Thông tin chung</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Mã đơn hàng: <br> <span style="font-weight: 600; font-size: 20px; color: #ff0000;"><% form.code %></span></label>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fa fa-calendar"></i> <% form.created_at | toDate | date:'dd/MM/yyyy HH:mm' %></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Tổng thanh toán: <br> <span style="font-weight: 600; font-size: 20px; color: #ff0000;"><% form.total_price | number %>đ</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-right" ng-show="!payment">
                                <div class="mb-2">
                                    @if ($order->canPay() && Auth::user()->is_customer)
                                    <button class="btn btn-success btn-cons" ng-click="createPaymentQrCode()" ng-disabled="loading">
                                        Chuyển khoản <i class="fa fa-arrow-right" ng-if="!loading"></i>
                                        <i class="fa fa-spinner fa-spin" ng-if="loading"></i>
                                    </button>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    @if ($order->canPay() && Auth::user()->is_customer_vip && $order->status == \App\Model\Admin\Order::DANG_TAO)
                                        <button class="btn btn-success btn-cons" ng-click="successPayment(10)">
                                            <i class="fa fa-check-circle" ng-if="!loading"></i> Hoàn tất (khách hàng VIP)
                                            <i class="fa fa-spinner fa-spin" ng-if="loading"></i>
                                        </button>
                                    @endif
                                </div>
                                <div>
                                    @if ($order->canCancel())
                                        <button class="btn btn-danger btn-cons" ng-click="cancelOrder(40)"><i class="fa fa-times"></i> Hủy bỏ</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px dashed #ccc; padding-top: 20px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pay to: </label>

                                <div><h5>{{$config->web_title}}</h5></div>
                                <div><i class="fa fa-globe"></i> <a class="text-dark" href="{{$config->web_url ?? ''}}" target="_blank"> {{$config->web_url ?? ''}}</a></div>
                                <div><i class="fa fa-phone"></i> <a class="text-dark" href="tel:{{$config->hotline ?? ''}}"> {{$config->hotline ?? ''}}</a></div>
                                <div><i class="fa fa-envelope"></i> <a class="text-dark" href="mailto:{{$config->email ?? ''}}"> {{$config->email ?? ''}}</a></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Invoiced to: </label>

                                <div><h5><% form.customer_name %></h5></div>
                                <div><i class="fa fa-phone"></i> <a class="text-dark" href="tel:<% form.customer_phone %>"> <% form.customer_phone %></a></div>
                                <div><i class="fa fa-envelope"></i> <a class="text-dark" href="mailto:<% form.customer_email %>"> <% form.customer_email %></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Chi tiết</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Plan</th>
                                <th>Phân loại</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="detail in form.details track by $index">
                                <td class="text-center"><% $index + 1 %></td>
                                <td class="text-center" ng-if="form.type == 0"><b><% detail.product.name %></b><br>
                                    <% detail.product.origin ? '(' + detail.product.origin + ')' : '' %>
                                </td>
                                <td class="text-center" ng-if="form.type == 1"><b><% detail.product.name %></b><br>
                                    <% detail.ip_product.ip ? '(' + detail.ip_product.ip + ')' : '' %>
                                </td>
                                <td class="text-center">
                                    <% detail.product.cpu %><% detail.product.ram ? ' - ' + detail.product.ram : '' %><% detail.product.storage ? ' - ' + detail.product.storage : '' %><% detail.product.stream ? ' - ' + detail.product.stream : '' %><% detail.product.band_width ? ' - ' + detail.product.band_width : '' %><% detail.product.os ? ' - ' + detail.product.os : '' %>
                                </td>
                                <td class="text-center"><% detail.price | number %></td>
                                <td class="text-center"><% detail.qty | number %></td>
                                <td class="text-right"><% (detail.qty * detail.price) | number %></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><b>Tổng thành tiền: </b></td>
                                <td class="text-right"><b><% form.total_before_discount | number %></b></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><b>VAT (%): </b></td>
                                <td class="text-right"><b><% (form.vat ? form.vat : 0) | number %></b></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><b>Thành tiền sau VAT: </b></td>
                                <td class="text-right"><b><% form.total_after_discount | number %></b></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        {{-- <div id="payos-checkout" ng-show="payment"></div> --}}
    </div>
    <hr>

    <div class="text-right">
        <a href="{{ route('orders.index') }}" class="btn btn-danger btn-cons">
            <i class="fa fa-remove"></i> Quay lại
        </a>
    </div>
</div>
@endsection

@section('script')
    {{-- <script src="https://cdn.payos.vn/payos-checkout/v1/stable/payos-initialize.js"></script> --}}
    @include('admin.orders.Order')
    <script>
        // payos.init({
        //     apiKey: '{{ config('payos.api_key') }}',
        //     clientId: '{{ config('payos.client_id') }}',
        //     checksumKey: '{{ config('payos.checksum_key') }}',
        // });
        app.controller('Checkout', function ($scope, $http) {
            $scope.form = new Order(@json($order), {scope: $scope});
            $scope.statuses = @json(\App\Model\Admin\Order::STATUSES);
            $scope.payment = false;
            $scope.loading = false;
            $scope.getStatus = function (status) {
                let obj = $scope.statuses.find(val => val.id == status);
                return obj.name;
            }

            $scope.createPaymentQrCode = function () {
                $scope.payment = true;
                $scope.loading = true;
                let data = {
                    order_id: $scope.form.id,
                    order_code: $scope.form.code,
                    total_price: $scope.form.total_price,
                    user_id: $scope.form.user_id,
                };
                $.ajax({
                    url: "{{ route('orders.payment.create') }}",
                    type: "POST",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = response.data.data.checkoutUrl;

                            // Cấu hình PayOS Checkout với URL mới từ API
                            // let payOSConfig = {
                            //     RETURN_URL: "{{ route('orders.payment.success') }}",
                            //     ELEMENT_ID: "payos-checkout",
                            //     CHECKOUT_URL: response.data.data.checkoutUrl, // Dùng URL từ API
                            //     embedded: true, // Nếu dùng giao diện nhúng
                            //     onSuccess: (event) => {
                            //         toastr.success('Thanh toán thành công!');
                            //     },
                            //     onCancel: (event) => {
                            //         toastr.warning('Bạn đã hủy thanh toán!');
                            //     },
                            //     onExit: (event) => {
                            //         toastr.info('Bạn đã đóng cửa sổ thanh toán!');
                            //     },
                            // };

                            // Khởi tạo PayOS Checkout
                            // const { open } = PayOSCheckout.usePayOS(payOSConfig);
                            // open(); // Mở popup thanh toán PayOS
                        } else {
                            toastr.warning(response.message);
                            $scope.payment = false;
                            $scope.loading = false;
                        }
                    },
                    error: function (response) {
                        toastr.error('Đã có lỗi xảy ra');
                        $scope.payment = false;
                        $scope.loading = false;
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                })
            }

            $scope.successPayment = function (status) {
                $scope.loading = true;
                let data = {
                    order_id: $scope.form.id,
                    order_code: $scope.form.code,
                    status: status,
                    type: 'no_payos_buy_vip'
                };
                $.ajax({
                    url: "{{ route('orders.payment.success') }}",
                    type: "GET",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = '{{ route('orders.index') }}';
                        } else {
                            toastr.warning(response.message);
                            $scope.loading = false;
                        }
                    },
                    error: function (response) {
                        toastr.error('Đã có lỗi xảy ra');
                        $scope.loading = false;
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                })
            }

            $scope.cancelOrder = function (status) {
                swal({
                    title: "Xác nhận hủy đơn hàng!",
                    text: "Bạn chắc chắn muốn hủy đơn hàng này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('orders.update.status') }}",
                            type: "POST",
                            data: {order_id: $scope.form.id, status: status},
                            headers: {
                                'X-CSRF-TOKEN': "{{csrf_token()}}"
                            },
                            success: function (response) {
                                if (response.success) {
                                    toastr.success(response.message);
                                    window.location.href = '/admin/orders';
                                } else {
                                    toastr.warning(response.message);
                                }
                            },
                            error: function (response) {
                                toastr.error('Đã có lỗi xảy ra');
                            }
                        })
                    }
                })
            }

        });
    </script>
@endsection
