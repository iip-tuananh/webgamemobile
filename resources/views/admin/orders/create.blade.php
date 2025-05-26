@extends('layouts.main')

@section('css')
<style>
    .service-item {
        /* border: 1px solid #ccc; */
        border-radius: 1.5rem;
        padding: 15px;
        margin-bottom: 10px;
        cursor: pointer;
        box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.12);
    }
    .service-item:hover {
        border: 2px solid #007bff;
    }
    .service-item.active {
        border: 2px solid #007bff;
    }
    .service-item-header {
        text-align: center;
    }
    .service-item-header img {
        display: inline-block;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ccc;
        padding: 5px;
    }
    .service-item-body {
        border-top: 1px solid #ccc;
        padding: 10px;
    }
    .sticky-top {
        position: sticky;
        top: 80px;
    }
    .plan-item {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px 10px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
    }
    .plan-item:hover {
        border: 2px solid #007bff;
    }
    .plan-item.active {
        border: 2px solid #007bff;
    }
</style>
@endsection

@section('page_title')
    Tạo đơn hàng mới
@endsection

@section('title')
    Tạo đơn hàng mới
@endsection

@section('buttons')
@endsection

@section('content')

<div ng-controller="Order" ng-cloak>
    <div class="row">
        <div class="col-md-9">
            <h2>1. Chọn VPS</h2>
            <div class="row">
                <div class="col-md-3" ng-repeat="category in categories">
                    <div class="service-item" ng-class="{'active': selectedCategory == category}" ng-click="selectCategory(category)">
                        <div class="service-item-header">
                            <img ng-src="<% category.image.path %>" alt="<% category.name %>">
                            <div class="mt-2 text-bold"><% category.name %></div>
                        </div>
                        {{-- <div class="service-item-body"> --}}
                            {{-- <p><% category.short_des %></p> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            <h2 class="mt-3" ng-show="selectedCategory">2. Chọn Plan</h2>
            <div class="row">
                <div class="col-md-12" ng-repeat="product in products">
                    <div class="d-md-flex align-items-center justify-content-between plan-item" ng-class="{'active': selectedProduct == product}" ng-click="selectProduct(product)">
                        <div class="text-bold"><h4><% product.name %></h4></div>
                        <div><span class="text-bold">vCPU</span> <br> <span style="font-size: 18px;"><% product.cpu %></span> </div>
                        <div><span class="text-bold">RAM</span> <br> <span style="font-size: 18px;"><% product.ram %></span> </div>
                        <div><span class="text-bold">Disk space</span> <br> <span style="font-size: 18px;"><% product.storage %></span> </div>
                        <div><span class="text-bold">Traffic</span> <br> <span style="font-size: 18px;"><% product.band_width %></span> </div>
                        <div><span class="text-bold">IP-VPS</span> <br> <span style="font-size: 18px;"><% product.stream %></span> </div>
                        <div><span class="text-bold">Location</span> <br> <span style="font-size: 18px;"><% product.origin %></span> </div>
                        <div ng-if="product.os"><span class="text-bold">OS</span> <br> <span style="font-size: 18px;"><% product.os %></span> </div>
                        <div><span class="text-bold">Price</span> <br> <span style="font-size: 18px;"><% product.sell_price | number %>đ/tháng </span> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card sticky-top">
                <div class="card-header">
                    <h5>Chi tiết đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" ng-show="selectedProduct">
                                <tbody>
                                    <tr>
                                        <td>Plan</td>
                                        <td class="text-bold"><% selectedProduct.name %></td>
                                    </tr>
                                    <tr>
                                        <td>vCPU</td>
                                        <td><% selectedProduct.cpu %></td>
                                    </tr>
                                    <tr>
                                        <td>RAM</td>
                                        <td><% selectedProduct.ram %></td>
                                    </tr>
                                    <tr>
                                        <td>Disk space</td>
                                        <td><% selectedProduct.storage %></td>
                                    </tr>
                                    <tr>
                                        <td>Traffic</td>
                                        <td><% selectedProduct.band_width %></td>
                                    </tr>
                                    <tr>
                                        <td>IP-VPS</td>
                                        <td><% selectedProduct.stream %></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td><% selectedProduct.origin %></td>
                                    </tr>
                                    <tr ng-if="selectedProduct.os">
                                        <td>OS</td>
                                        <td><% selectedProduct.os %></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td class="text-danger"><% selectedProduct.sell_price | number %>đ/tháng</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3 pt-4" style="border-top: 1px dashed #ccc;">
                        <div class="col-md-6">
                            <div class="quantity-input form-group custom-group" ng-show="selectedProduct">
                                <label class="form-label required-label" for="quantity">Quantity</label>
                                <input type="number" class="form-control" ng-model="form.quantity" min="1" step="1" placeholder="Quantity">
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><% errors.quantity[0] %></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="quantity-input form-group custom-group" ng-show="selectedProduct">
                                <label class="form-label required-label" for="month">Months</label>
                                <input type="number" class="form-control" ng-model="form.month" min="1" step="1" placeholder="Month" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="quantity-input form-group" ng-show="selectedProduct">
                                <label for="note">Note</label>
                                <textarea class="form-control" ng-model="form.note" placeholder="Note"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center pt-3" style="border-top: 1px dashed #ccc;" ng-show="selectedProduct">
                                <button class="btn btn-success btn-cons" ng-click="submitOrder()" ng-disabled="loading">
                                    Thanh toán
                                    <i class="fa fa-spinner fa-spin" ng-show="loading"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="text-right">
        <a href="{{ route('orders.index') }}" class="btn btn-danger btn-cons">
            <i class="fa fa-remove"></i> Quay lại
        </a>
    </div>
    {{-- @include('admin.orders.checkout') --}}
</div>
@endsection

@section('script')
    <script>
        app.controller('Order', function ($scope, $http) {
            $scope.loading = false;
            $scope.categories = @json($categories);
            $scope.form = {
                quantity: 1,
                month: 1,
                product: null,
                note: '',
            }

            $scope.selectedCategory = null;
            $scope.selectCategory = function (category) {
                $scope.selectedCategory = category;
                $scope.form.product = null;
                $scope.getProducts();
            }

            $scope.products = [];
            $scope.getProducts = function () {
                $.ajax({
                    url: '/admin/products/get-list-products',
                    type: 'GET',
                    data: {
                        cate_id: $scope.selectedCategory.id
                    },
                    success: function (response) {
                        $scope.products = response;
                    },
                    error: function (error) {
                        console.log(error);
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.selectedProduct = null;
            $scope.selectProduct = function (product) {
                $scope.selectedProduct = product;
                $scope.form.product = product;
            }

            $scope.errors = {};
            $scope.submitOrder = function () {
                $scope.loading = true;
                let data = $scope.form;
                data.type = 0;
                $.ajax({
                    url: '{{route("orders.store")}}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            window.location.href = '{{route("orders.checkout")}}?order_code=' + response.order_code;
                            toastr.success(response.message);
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
