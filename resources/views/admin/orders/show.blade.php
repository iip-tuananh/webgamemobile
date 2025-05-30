@extends('layouts.main')

@section('css')
@endsection

@section('page_title')
    Chi tiết đơn hàng
@endsection

@section('title')
    Chi tiết đơn hàng
@endsection

@section('buttons')
@endsection

@section('content')

<div ng-controller="Order" ng-cloak>
    <div class="row">
        @if (!Auth::user()->is_customer)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Thông tin chung</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Khách hàng: <% form.customer_name %> </label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email: <% form.customer_email %></label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">SĐT: <% form.customer_phone %></label>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Địa chỉ: <% form.customer_address %> </label>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tổng tiền: <span class="text-danger" style="font-weight: 600; font-size: 18px;"><% form.total_price | number %>đ</span></label>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phương thức thanh toán: <% form.payment_method_name %></label>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Trạng thái: <span class="badge badge-<% getStatus(form.status).type %>"><% getStatus(form.status).name %></span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Yêu cầu: </label>
                                    <textarea id="my-textarea" class="form-control" rows="3"><% form.customer_required %></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                                <th>Tên hàng hóa</th>
                                <th>Phân loại</th>
                                <th>Giá tiền</th>
                                <th>Số lượng đặt mua</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="detail in form.details track by $index">
                                <td class="text-center"><% $index + 1 %></td>
                                <td class="text-center"><% detail.product.name %></td>
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
    </div>
    <hr>
    <div class="text-right">
        @if ($order->canPay() && Auth::user()->is_customer)
            <a href="{{ route('orders.checkout').'?order_code='.$order->code }}" class="btn btn-success btn-cons">
                <i class="fa fa-money"></i> Thanh toán
            </a>
        @endif
        <a href="{{ route('orders.index') }}" class="btn btn-danger btn-cons">
            <i class="fa fa-remove"></i> Quay lại
        </a>
    </div>
</div>
@endsection

@section('script')
    @include('admin.orders.Order')

    <script>
        app.controller('Order', function ($scope, $http) {
            $scope.form = new Order(@json($order), {scope: $scope});
            $scope.statuses = @json(\App\Model\Admin\Order::STATUSES);
            $scope.$applyAsync();

            $scope.getStatus = function (status) {
                let obj = $scope.statuses.find(val => val.id == status);
                return obj;
            }

        });
    </script>
@endsection
