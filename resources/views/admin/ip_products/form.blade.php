<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">IP</label>
                    <input class="form-control " type="text" ng-model="form.ip">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.ip[0] %></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Thuộc VPS</label>
                    <select select2 class="form-control" ng-model="form.product_id">
                        <option value="">Chọn VPS</option>
                        <option ng-repeat="p in products" ng-value="p.id" value="<% p.id %>" ng-selected="form.product_id == p.id"><% p.name %></option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.product_id[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Data center</label>
                    <input class="form-control " type="text" ng-model="form.data_center">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.data_center[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Username</label>
                    <input class="form-control " type="text" ng-model="form.username">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.username[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Password</label>
                    <input class="form-control " type="text" ng-model="form.password">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.password[0] %></strong>
                    </span>
                </div>
            </div>
            {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Trạng thái</label>
                    <select name="" id="" class="form-control custom-select" ng-model="form.status">
                        <option value="">Chọn trạng thái</option>
                        <option ng-repeat="s in statuses" ng-value="s.value" ng-selected="form.status == s.value"><% s.name %></option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.status[0] %></strong>
                    </span>
                </div>
            </div> --}}
        </div>
    </div>
</div>
