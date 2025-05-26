@extends('layouts.main')

@section('css')
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
          rel="stylesheet"/>
@endsection

@section('page_title')
    Quản lý IP
@endsection

@section('title')
    Quản lý IP
@endsection

@section('buttons')
    {{-- @if(Auth::user()->type == App\Model\Common\User::QUAN_TRI_VIEN || Auth::user()->type == App\Model\Common\User::SUPER_ADMIN)
        <a href="{{ route('Product.create') }}" class="btn btn-outline-success btn-sm" class="btn btn-info"><i
                class="fa fa-plus"></i> Thêm mới</a> --}}
        {{-- <a href="javascript:void(0)" target="_blank" data-href="{{ route('Product.exportExcel') }}" class="btn btn-info export-button btn-sm"><i class="fas fa-file-excel"></i> Xuất file excel</a>
        <a href="javascript:void(0)" target="_blank" data-href="{{ route('Product.exportPDF') }}" class="btn btn-warning export-button btn-sm"><i class="far fa-file-pdf"></i> Xuất file pdf</a> --}}
    {{-- @endif --}}
@endsection

@section('content')
    <div>
        <div class="row" ng-controller="IpProduct">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-list">
                        </table>
                    </div>
                </div>
            </div>


            {{-- <div class="modal fade" id="add-to-category-special" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="semi-bold">Thêm vào danh mục đặc biệt</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group custom-group" ng-cloak>
                                                <label class="form-label required-label">Danh mục đặc biệt</label>

                                                <ui-select remove-selected="false" multiple ng-model="product.category_special_ids">
                                                    <ui-select-match placeholder="Chọn danh mục đặc biệt">
                                                        <% $item.name %>
                                                    </ui-select-match>
                                                    <ui-select-choices
                                                        repeat="item.id as item in (categorieSpeicals | filter: $select.search)">
                                                        <span ng-bind="item.name"></span>
                                                    </ui-select-choices>
                                                </ui-select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-cons" ng-click="submit()"
                                    ng-disabled="loading.submit">
                                <i ng-if="!loading.submit" class="fa fa-save"></i>
                                <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
                                Lưu
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-window-close"></i> Hủy
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div> --}}

            @include('admin.ip_products.create')
            @include('admin.ip_products.edit')
            @include('partial.modal.importExcel')
            @include('admin.tickets.create')
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript"
            src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

    @include('admin.ip_products.IpProduct')
    @include('admin.tickets.Ticket')
    <script>
        let columns = [
            {data: 'id', orderable: false},
            {data: 'ip', title: 'IP', width: '10%'},
            {data: 'username', title: "Username"},
            {data: 'password', title: "Password"},
            {data: 'customer_name', title: 'Khách hàng'},
            {data: 'sell_price', title: 'Price'},
            {data: 'plan', title: 'Plan'},
            {data: 'location', title: "Location"},
            {data: 'start_date', title: "Ngày bắt đầu"},
            {data: 'end_date', title: "Ngày hết hạn"},
            {data: 'data_center', title: "Data center"},
            {data: 'status', title: "Trạng thái"},
            {data: 'payment_status', title: "Trạng thái thanh toán"},
            {data: 'note', title: "Ghi chú", width: '15%'},
            {data: 'action', orderable: false, title: "Hành động"}
        ];

        if ({{ Auth::user()->type }} == @json(\App\Model\Common\User::KHACH_HANG)) {
            columns.splice(4, 1);
            columns.splice(9, 1);
        }
        if ({{ Auth::user()->type }} != @json(\App\Model\Common\User::KHACH_HANG)) {
            columns.splice(2, 1);
            columns.splice(2, 1);
            columns.splice(5, 1);
        }
        let datatable = new DATATABLE('table-list', {
            ajax: {
                url: '/admin/ip-products/searchData',
                data: function (d, context) {
                    DATATABLE.mergeSearch(d, context);
                }
            },
            columnDefs: [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            select: {
                'style': 'multi'
            },
            columns: columns,
            search_columns: [
                {data: 'ip', search_type: "text", placeholder: "IP"},
                {data: 'plan', search_type: "text", placeholder: "Plan"},
                {data: 'location', search_type: "text", placeholder: "Location"},
                {
                    data: 'status', search_type: "select", placeholder: "Trạng thái",
                    column_data: @json(App\Model\Admin\IpProduct::STATUES)
                },
                {
                    data: 'payment_status', search_type: "select", placeholder: "Trạng thái thanh toán",
                    column_data: @json(App\Model\Admin\IpProduct::PAYMENT_STATUSES)
                },
                {
                    data: 'start_date', search_type: "date", placeholder: "Ngày bắt đầu",
                },
                {
                    data: 'end_date', search_type: "date", placeholder: "Ngày hết hạn",
                },
                @if(!Auth::user()->is_customer)
                {
                    data: 'customer_id', search_type: "select", placeholder: "Khách hàng",
                    column_data: @json(App\Model\Common\User::getForSelectUserClients())
                },
                @endif
            ],
            @if(Auth::user()->is_customer)
            create_ticket: true,
            renew: true,
            create_ticket_os: true,
            create_vps: "{{route('orders.create')}}",
            @endif
            @if(!Auth::user()->is_customer)
            create_modal: "create-ip-product",
            import_link_with_params: true,
            export_pdf_link: "{{route('ip_products.exportPDF')}}",
            @endif
        }).datatable;

        app.controller('IpProduct', function ($scope, $rootScope, $http, $compile) {
            $scope.loading = {};
            $scope.arrayInclude = arrayInclude;

            $('#table-list').on('click', '.edit', function () {
                $scope.data = datatable.row($(this).parents('tr')).data();

                $.ajax({
                    type: 'GET',
                    url: "/admin/ip-products/" + $scope.data.id + "/getDataForEdit",
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

            $('#table-list').on('click', '.create-ticket', function () {
                $scope.data = datatable.row($(this).parents('tr')).data();
                $scope.ip_ids = [$scope.data.id];
                $rootScope.$emit("createTicket", $scope.ip_ids);
                $('#createModalTicket').modal('show');
            });

            datatable.on('draw', function () {
                // Biên dịch lại các phần tử có chứa directive của Angular
                $('.act-create-ticket').each(function() {
                    $compile(this)($scope);
                });
                $('.act-create-ticket-os').each(function() {
                    $compile(this)($scope);
                });

                $scope.$applyAsync();
            });

            $scope.createTicketArr = function () {
                var product_renew_ids = [];
                var rows_selected = datatable.column(0).checkboxes.selected();
                $.each(rows_selected, function (index, rowId) {
                    product_renew_ids.push(Number(rowId));
                });

                if(product_renew_ids.length == 0) {
                    toastr.warning("Chưa có IP nào được chọn");
                    return;
                }
                $rootScope.$emit("createTicket", product_renew_ids);
                $rootScope.$emit("is_ticket_os", false);
                $scope.title_ticket = "Tạo ticket";
                $('#createModalTicket').modal('show');
            }
            $scope.createTicketOsArr = function () {
                var product_renew_ids = [];
                var rows_selected = datatable.column(0).checkboxes.selected();
                $.each(rows_selected, function (index, rowId) {
                    product_renew_ids.push(Number(rowId));
                });

                if(product_renew_ids.length == 0) {
                    toastr.warning("Chưa có IP nào được chọn");
                    return;
                }
                $rootScope.$emit("createTicket", product_renew_ids);
                $rootScope.$emit("is_ticket_os", true);
                $scope.title_ticket = "Tạo ticket hỗ trợ OS";
                $('#createModalTicket').modal('show');
            }
        })

        function renewArr() {
            var product_renew_ids = [];
            var rows_selected = datatable.column(0).checkboxes.selected();

            $.each(rows_selected, function (index, rowId) {
                product_renew_ids.push(rowId);
            });

            if(product_renew_ids.length == 0) {
                toastr.warning("Chưa có IP nào được chọn");
                return;
            }

            // var product_ids = product_renew_ids.join(',');
            swal({
                title: "Xác nhận gia hạn!",
                text: "Bạn chắc chắn muốn gia hạn "+product_renew_ids.length+" IP",
                type: "success",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Xác nhận",
                cancelButtonText: "Hủy",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    // window.location.href = "{{route('ip_products.renew.multi')}}?ip_product_ids="+product_ids;
                    $.ajax({
                        url: "{{route('ip_products.renew.multi')}}",
                        type: "GET",
                        data: {ip_product_ids: product_renew_ids},
                        success: function(response) {
                            if (response.success) {
                                window.location.href = '{{route("orders.checkout")}}?order_code=' + response.order_code;
                            } else {
                                toastr.warning(response.message);
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
            })
        }

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

        $(document).on('click', '.export-pdf-button', function (event) {
            event.preventDefault();
            var product_pdf_ids = [];
            var rows_selected = datatable.column(0).checkboxes.selected();

            $.each(rows_selected, function (index, rowId) {
                product_pdf_ids.push(rowId);
            });

            if(product_pdf_ids.length == 0) {
                toastr.warning("Chưa có IP nào được chọn");
                return;
            }
            let data = {};

            mergeSearch(data, datatable.context[0]);
            window.location.href = $(this).attr('href') + "?" + $.param(data) + "&product_pdf_ids=" + product_pdf_ids;
        })
    </script>
    @include('partial.confirm')
@endsection
