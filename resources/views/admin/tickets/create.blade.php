<div class="modal fade" id="createModalTicket" tabindex="-1" role="dialog" aria-hidden="true" ng-controller="CreateTicket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="semi-bold"><% title_ticket %></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Tiêu đề</label>
                    <input class="form-control" type="text" name="title"
                        ng-class="{'is-invalid': errors && errors.title}" ng-model="form.title">
                    <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.title">
                            <strong><% errors.title[0] %></strong>
                        </span>
                </div>

                <div class="form-group custom-group">
                    <label class="form-label required-label">Danh sách IP</label>
                    <ui-select remove-selected="false" multiple ng-model="form.ip_ids">
                        <ui-select-match placeholder="Chọn IP">
                            <% $item.ip %>
                        </ui-select-match>
                        <ui-select-choices
                            repeat="item.id as item in (ip_products | filter: $select.search)">
                            <span ng-bind="item.ip"></span>
                        </ui-select-choices>
                    </ui-select>
                </div>

                <div class="form-group custom-group" ng-if="is_ticket_os">
                    <label class="form-label required-label">Hệ điều hành</label>
                    <select class="form-control" ng-model="form.os_id" ng-change="changeOs()">
                        <option value="">Chọn hệ điều hành</option>
                        <option value="<% item.id %>" ng-repeat="item in ip_products_os">
                            <% item.name %>
                        </option>
                    </select>
                </div>


                <div class="form-group custom-group">
                    <label class="form-label required-label">Nội dung</label>
                    <textarea class="form-control" name="message"
                        ng-class="{'is-invalid': errors && errors.message}" ng-model="form.message"></textarea>
                    <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.message">
                            <strong><% errors.message[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" ng-disabled="loading" ng-click="submit()">
                    <i class="fa fa-save"></i> Lưu
                    <i class="fa fa-spinner fa-spin" ng-show="loading"></i>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" ng-disabled="loading"><i
                        class="fa fa-remove"></i> Hủy
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    app.controller('CreateTicket', function ($scope, $http, $rootScope) {
        $scope.form = new Ticket({}, {scope: $scope});
        $scope.ip_products = @json(\App\Model\Admin\IpProduct::getForSelect());
        $scope.ip_products_os = [
            {
                id: 1,
                name: 'Windows 2k12',
            },
            {
                id: 2,
                name: 'Windows 2k22',
            },
            {
                id: 3,
                name: 'Linux ubuntu 20.4',
            },
            {
                id: 4,
                name: 'Linux Ubuntu 22.4',
            },
        ];
        $rootScope.$on("createTicket", function (event, data) {
            $scope.form.ip_ids = data;
            $scope.$applyAsync();
        });
        $rootScope.$on("is_ticket_os", function (event, data) {
            $scope.is_ticket_os = data;
            if($scope.is_ticket_os) {
                $scope.form.title = "Hỗ trợ OS";
                $scope.$applyAsync();
            }
        });
        $('#createModalTicket').on('shown.bs.modal', function () {
            $scope.$apply(function () {
                $scope.ip_products = $scope.ip_products;
            });
        });

        $scope.changeOs = function () {
            console.log($scope.form.os_id);

            if($scope.form.os_id) {
                let os = $scope.ip_products_os.find(item => item.id == $scope.form.os_id);
                $scope.form.message = "Hỗ trợ cài OS: " + os.name;
                $scope.$applyAsync();
            }
        }
        $scope.loading = false;
        // Submit Form tạo mới
        $scope.submit = function () {
            let url = "{!! route('Ticket.store') !!}";
            $scope.loading = true;
            // return 0;
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: $scope.form.submit_data,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#createModalTicket').modal('hide');
                        toastr.success(response.message);
                        datatable.ajax.reload();
                        $scope.errors = null;
                    } else {
                        $scope.errors = response.errors;
                        toastr.warning(response.message);
                        $scope.loading = false;
                    }
                },
                error: function () {
                    toastr.error('Đã có lỗi xảy ra');
                    $scope.loading = false;
                },
                complete: function () {
                    $scope.$applyAsync();
                },
            });
        }
    })
</script>