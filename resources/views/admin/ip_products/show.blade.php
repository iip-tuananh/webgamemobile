@extends('layouts.main')

@section('css')
<style>
    .table-general-info {
        font-size: 14px;
    }
    .table-general-info th {
        font-weight: 600;
        text-align: left;
        width: 25%;
    }
    .table-general-info td {
        font-weight: 400;
        text-align: left;
        width: 75%;
    }
    .table-payment-info th {
        font-weight: 600;
        text-align: left;
        width: 45%;
    }
    .table-payment-info td {
        font-weight: 400;
        text-align: left;
        width: 55%;
    }
</style>
@endsection

@section('page_title')
    Quản lý thông tin IP
@endsection

@section('title')
    Quản lý thông tin IP
@endsection

@section('buttons')
@endsection

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h6>Thông tin chung</h6>
			</div>
			<div class="card-body">
                <table class="table table-striped table-general-info">
                    <tbody>
                        <tr>
                            <th>VPS IPv4 & Port</th>
                            <td><span class="text-danger">{{ $data->ip }}</span> <button class="btn btn-cons btn-sm btn-warning ml-5" onclick="copyToClipboard('{{ $data->ip }}')"><i class="fa fa-copy"></i> Click to copy</button></td>
                        </tr>
                        <tr>
                            <th>Plan</th>
                            <td>{{ $data->product->name }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{!! !empty($data->status) ? getStatus($data->status, \App\Model\Admin\IpProduct::STATUES) : '' !!}</td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>{!! !empty($data->payment_status) ? getStatus($data->payment_status, \App\Model\Admin\IpProduct::PAYMENT_STATUSES) : '' !!}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ $data->product->origin }}</td>
                        </tr>
                        <tr>
                            <th>Specification</th>
                            <td>{{ $data->product->specification }}</td>
                        </tr>
                        <tr>
                            <th>OS</th>
                            <td>{{ $data->product->os }}</td>
                        </tr>
                        <tr>
                            <th>Default username</th>
                            <td>{{ $data->username }} <button class="btn btn-cons btn-sm btn-warning ml-5" onclick="copyToClipboard('{{ $data->username }}')"><i class="fa fa-copy"></i> Click to copy</button></td>
                        </tr>
                        <tr>
                            <th>Default password</th>
                            <td>{{ $data->password }} <button class="btn btn-cons btn-sm btn-warning ml-5" onclick="copyToClipboard('{{ $data->password }}')"><i class="fa fa-copy"></i> Click to copy</button></td>
                        </tr>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h6>Thông thanh toán</h6>
			</div>
			<div class="card-body">
                <table class="table table-striped table-payment-info">
                    <tbody>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $data->start_date ? formatDate($data->start_date) : '' }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ $data->end_date ? formatDate($data->end_date) : '' }}</td>
                        </tr>
                        <tr>
                            <th>Automatically renew</th>
                            <td class="text-danger">Disabled</td>
                        </tr>
                        <tr>
                            <th>Base Plan</th>
                            <td>{{ $data->product->name }} ({{ formatCurrency($data->product->sell_price) }}đ/month)</td>
                        </tr>
                        <tr>
                            <th>Total price</th>
                            <td>{{ formatCurrency($data->product->sell_price) }}đ/month</td>
                        </tr>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="text-right">
	<a href="{{ route('ip_products.index') }}" class="btn btn-danger btn-cons">
		<i class="fa fa-remove"></i> Quay lại
	</a>
</div>

@endsection

@section('script')
    <script>
        app.controller('IpProduct', function ($scope, $rootScope, $http) {
            $scope.loading = {};
            $scope.arrayInclude = arrayInclude;

            $('#table-list').on('click', '.edit', function () {
                $scope.data = datatable.row($(this).parents('tr')).data();

                $.ajax({
                    type: 'GET',
                    url: "/admin/ip-product/" + $scope.data.id + "/getDataForEdit",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: $scope.data.id,

                    success: function(response) {
                        if (response.success) {

                            $scope.booking = response.data;
                            console.log($scope.booking );

                            $rootScope.$emit("editIpProduct", $scope.booking);
                        } else {
                            toastr.warning(response.message);
                            $scope.errors = response.errors;
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.loading.submit = false;
                        $scope.$applyAsync();
                    }
                });
                $scope.errors = null;
                $scope.$apply();
                $('#edit-ip-product').modal('show');
            });
        })

        // function removeProductArr() {
        //     var product_remove_ids = [];
        //     var rows_selected = datatable.column(0).checkboxes.selected();

        //     $.each(rows_selected, function (index, rowId) {
        //         product_remove_ids.push(rowId);
        //     });

        //     if(product_remove_ids.length == 0) {
        //         toastr.warning("Chưa có sản phẩm nào được chọn");
        //         return;
        //     }

        //     var product_ids = product_remove_ids.join(',');
        //     swal({
        //         title: "Xác nhận xóa!",
        //         text: "Bạn chắc chắn muốn xóa "+product_remove_ids.length+" sản phẩm",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonClass: "btn-danger",
        //         confirmButtonText: "Xác nhận",
        //         cancelButtonText: "Hủy",
        //         closeOnConfirm: false
        //     }, function(isConfirm) {
        //         if (isConfirm) {
        //             window.location.href = "{{route('products.delete.multi')}}?product_ids="+product_ids;
        //         }
        //     })
        // }

        app.controller('ImportExcel', function ($scope) {
            $scope.sample = "/sample/ImportExcel_Danh_sach_ip.xlsx";
            $scope.note = "";
            $scope.loading = false;
            $scope.import = function() {
                var url = "{!! route('ip_products.importExcel') !!}";
                var data = new FormData(document.getElementById('import-excel-form'));
                $scope.loading = true;
                $scope.errors = null;
                $scope.import_details = null;
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $scope.import_details = response.details;
                            datatable.ajax.reload();
                            $scope.loading = false;
                            // $('#import-excel').modal('hide');
                        } else {
                            toastr.warning(response.message);
                            $scope.errors = response.errors;
                            $scope.loading = false;
                        }
                    },
                    error: function(error) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.loading = false;
                        $scope.$applyAsync();
                    }
                });
            }

            $('#import-excel').on('hidden.bs.modal', function (e) {
                document.getElementById('import-excel-form').reset();
                $scope.errors = null;
                $scope.import_details = null;
                $scope.$applyAsync();
            })
        });

        $(document).on('click', '.export-button', function (event) {
            event.preventDefault();
            let data = {};
            mergeSearch(data, datatable.context[0]);
            window.location.href = $(this).data('href') + "?" + $.param(data);
        })

    </script>
    @include('partial.confirm')
@endsection
