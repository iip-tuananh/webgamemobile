@extends('layouts.main')
@section('css')

@endsection
@section('page_title')
    Danh sách ticket
@endsection
@section('title')
    Danh sách ticket
@endsection

@section('content')
    <div ng-controller="Ticket" ng-cloak>
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="card-block">
                        <table id="table-list">

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-status" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="semi-bold">Đổi trạng thái</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group custom-group">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-control" ng-model="form.status">
                                                <option value="">Chọn trạng thái</option>
                                                <option ng-repeat="s in statues" ng-value="s.id" ng-selected="s.id == form.status">
                                                    <% s.name %>
                                                </option>
                                            </select>
                                            <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.status">
                                                <strong><% errors.status[0] %></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-cons" ng-click="changeStatus()" ng-disabled="loading.submit">
                            <i ng-if="!loading.submit" class="fa fa-save"></i>
                            <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
                            Lưu
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Hủy</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @include('admin.tickets.create')
    </div>
@endsection

@section('script')
    @include('partial.confirm')
    @include('admin.tickets.Ticket')
    <script>
        let columns = [
            {data: 'DT_RowIndex', orderable: false, title: "STT", className: "text-center"},
            {data: 'title', title: "Tiêu đề", className: "text-center"},
            {data: 'status_text', title: "Trạng thái", className: "text-center"},
            {data: 'customer', title: "Khách hàng", className: "text-center"},
            {data: 'action', orderable: false, title: "Hành động", className: "text-center"}
        ];
        if ({{ Auth::user()->type }} == {{ \App\Model\Common\User::KHACH_HANG }}) {
            columns.splice(3, 1);
        }
        var datatable = new DATATABLE('table-list', {
            ajax: {
                url: '{!! route('Ticket.searchData') !!}',
                data: function (d, context) {
                    DATATABLE.mergeSearch(d, context);
                }
            },
            columns: columns,
            search_columns: [
                {data: 'title', search_type: "text", placeholder: "Tiêu đề"},
            ],
            create_modal: "createModalTicket",
        }).datatable;

        app.controller('Ticket', function ($scope, $http) {
            $scope.form = {
                status: ''
            };
            $scope.loading = {
                submit: false
            };
            $scope.errors = {};
            $scope.statues = @json(\App\Model\Admin\Ticket::STATUSES);

            $('#table-list').on('click', '.change-status', function () {
                event.preventDefault();
                $scope.data = datatable.row($(this).parents('tr')).data();
                $scope.form.status = $scope.data.status;
                $scope.$apply();
                $('#update-status').modal('show');
            });

            $scope.changeStatus = function () {
                $scope.loading.submit = true;
                $.ajax({
                    type: 'POST',
                    url: "{{route('Ticket.update.status')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        ticket_id: $scope.data.id,
                        status:  $scope.form.status
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#update-status').modal('hide');
                        } else {
                            toastr.warning(response.message);
                            $scope.loading.submit = false;
                            $scope.errors = response.errors;
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                        $scope.loading.submit = false;
                    },
                    complete: function() {
                        datatable.ajax.reload();
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endsection
