@extends('layouts.main')

@section('css')
@endsection

@section('page_title')
    Giỏ hàng
@endsection

@section('title')
    Trang giỏ hàng
@endsection

@section('buttons')
@endsection

@section('content')

<div ng-controller="Cart" ng-cloak>
    <div class="row">
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
                            <tr ng-repeat="(index, item) in form">
                                <td class="text-center"><% $index + 1 %></td>
                                <td class="text-center"><b><% item.name %></b><br>
                                    <% item.origin ? '(' + item.origin + ')' : '' %>
                                </td>
                                <td class="text-center">
                                    <% item.attributes.cpu %><% item.attributes.ram ? ' - ' + item.attributes.ram : '' %><% item.attributes.storage ? ' - ' + item.attributes.storage : '' %><% item.attributes.band_width ? ' - ' + item.attributes.band_width : '' %><% item.attributes.os ? ' - ' + item.attributes.os : '' %>
                                </td>
                                <td class="text-center"><% item.price | number %></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" ng-click="decreaseQty(item)"><i class="fa fa-minus"></i></button>
                                    <input type="number" style="width: 80px; height: 34px; border-radius: 5px; border: 1px solid #ccc; text-align: center;" ng-model="item.quantity" ng-change="updateItem(item)">
                                    <button class="btn btn-sm btn-primary" ng-click="increaseQty(item)"><i class="fa fa-plus"></i></button>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><% errors['product.' + index + '.quantity'][0] %></strong>
                                    </span>
                                </td>
                                <td class="text-right"><% (item.quantity * item.price) | number %></td>

                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><b>Tổng thành tiền: </b></td>
                                <td class="text-right"><b><% total_price | number %></b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">Ghi chú</label>
                                <textarea class="form-control" ng-model="note" placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-right">
        @if ($cartCollection->count() > 0)
            <button class="btn btn-success btn-cons" ng-click="submitOrder()" ng-disabled="loading">
                <i class="fa fa-shopping-cart"></i> Thanh toán
                <i class="fa fa-spinner fa-spin" ng-show="loading"></i>
            </button>
        @endif
        <a href="{{ route('orders.index') }}" class="btn btn-danger btn-cons">
            <i class="fa fa-remove"></i> Quay lại
        </a>
    </div>
</div>
@endsection

@section('script')
    <script>
        app.controller('Cart', function ($scope, $http, $interval, $rootScope, cartItemSync) {
            $scope.loading = false;
            $scope.form = @json($cartCollection);
            $scope.total_price = @json($total_price);
            $scope.total_qty = @json($total_qty);
            $scope.note = '';
            $scope.getStatus = function (status) {
                let obj = $scope.statuses.find(val => val.id == status);
                return obj.name;
            }
            $scope.decreaseQty = function (item) {
                item.quantity--;
                $scope.updateItem(item);
            }
            $scope.increaseQty = function (item) {
                item.quantity++;
                $scope.updateItem(item);
            }
            $scope.updateItem = function (item) {
                $.ajax({
                    type: 'POST',
                    url: "{{route('cart.update.item')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        product_id: item.id,
                        qty: item.quantity
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total_price = response.total;
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

            $scope.errors = {};
            $scope.submitOrder = function () {
                $scope.loading = true;
                let data = {};
                data.product = $scope.form;
                data.total_price = $scope.total_price;
                data.note = $scope.note;
                data.type = 0;
                $.ajax({
                    url: '{{route("orders.store.cart")}}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            window.location.href = '{{route("orders.checkout")}}?order_code=' + response.order_code;
                            // toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                            $scope.errors = response.errors;
                            $scope.loading = false;
                        }
                    },
                    error: function (error) {
                        toastr.error('Đã có lỗi xảy ra');
                        $scope.loading = false;
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endsection
