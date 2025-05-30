<style>
    .gallery-item {
        padding: 5px;
        padding-bottom: 0;
        border-radius: 2px;
        border: 1px solid #bbb;
        min-height: 100px;
        height: 100%;
        position: relative;
    }

    .gallery-item .remove {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .gallery-item .drag-handle {
        position: absolute;
        top: 5px;
        left: 5px;
        cursor: move;
    }

    .gallery-item:hover {
        background-color: #eee;
    }

    .gallery-item .image-chooser img {
        max-height: 150px;
    }

    .gallery-item .image-chooser:hover {
        border: 1px dashed green;
    }
</style>
<div class="row">
    <div class="col-sm-8">
        {{-- <div class="form-group mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input class="cursor-pointer" type="radio" ng-model="form.type" value="0" id="type_0"> <label for="type_0" class="cursor-pointer">Sản phẩm thông thường</label>
                </div>
                <div class="col-md-6">
                    <input class="cursor-pointer" type="radio" ng-model="form.type" value="1" id="type_1"> <label for="type_1" class="cursor-pointer">Sản phẩm affiliate</label>
                </div>
            </div>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.type[0] %>
                </strong>
            </span>
        </div> --}}
        <div class="form-group custom-group mb-4">
            <label class="form-label" ng-class="{'required-label': form.type == 0}">Danh mục sản phẩm</label>
            <ui-select class="" remove-selected="true" ng-model="form.cate_id" theme="select2" ng-change="changeCategory(form.cate_id)">
                <ui-select-match placeholder="Chọn danh mục">
                    <% $select.selected.name %>
                </ui-select-match>
                <ui-select-choices repeat="t.id as t in (form.all_categories | filter: $select.search)">
                    <span ng-bind="t.name"></span>
                </ui-select-choices>
            </ui-select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.cate_id[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Tên sản phẩm</label>
            <input class="form-control " type="text" ng-model="form.name">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.name[0] %>
                </strong>
            </span>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Tiêu đề sản phẩm</label>
            <input class="form-control " type="text" ng-model="form.title_seo">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.title_seo[0] %>
                </strong>
            </span>
        </div>
        {{-- <div class="form-group">
            <label class="form-label">Cấu hình Plan</label>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group custom-group">
                        <label class="form-label">CPU</label>
                        <input class="form-control" ng-model="form.cpu" type="text" ng-change="form.updateRevenuePrice()">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors.cpu[0] %>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group custom-group">
                        <label class="form-label">RAM</label>
                        <input class="form-control" ng-model="form.ram" type="text">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors.ram[0] %>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group custom-group">
                        <label class="form-label">Bandwidth</label>
                        <input class="form-control" ng-model="form.band_width" type="text">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors.band_width[0] %>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group custom-group">
                        <label class="form-label">Storage</label>
                        <input class="form-control" ng-model="form.storage" type="text">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors.storage[0] %>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group custom-group">
                        <label class="form-label">IPv4</label>
                        <input class="form-control" ng-model="form.stream" type="text">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors.stream[0] %>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group custom-group">
                        <label class="form-label">OS</label>
                        <input class="form-control" ng-model="form.os" type="text">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors.os[0] %>
                            </strong>
                        </span>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="form-group custom-group mb-4">
            <label class="form-label">Mô tả ngắn</label>
            <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.intro"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.intro[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Chi tiết sản phẩm</label>
            <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.body"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.body[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label" ng-class="{'required-label': form.type == 1}">Link game</label>
            <input class="form-control " type="text" ng-model="form.origin_link">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.origin_link[0] %>
                </strong>
            </span>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label" ng-class="{'required-label': form.type == 1}">Zalo</label>
            <input class="form-control " type="text" ng-model="form.aff_link">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.aff_link[0] %>
                </strong>
            </span>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label" ng-class="{'required-label': form.type == 1}">Fanpage</label>
            <input class="form-control " type="text" ng-model="form.short_link">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.short_link[0] %>
                </strong>
            </span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group custom-group mb-4">
            <label class="form-label">Nền tảng</label>
            <input class="form-control " type="text" ng-model="form.origin">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.origin[0] %>
                </strong>
            </span>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label">Lượt xem</label>
            <input class="form-control " type="text" ng-model="form.base_price" disabled>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.base_price[0] %>
                </strong>
            </span>
        </div>
        {{-- <div class="form-group custom-group mb-4">
            <label class="form-label">Giá thường</label>
            <input class="form-control " type="text" ng-model="form.price" ng-change="form.updateRevenuePrice()">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.price[0] %>
                </strong>
            </span>
        </div> --}}

        <div class="form-group custom-group mb-4">
            <label class="form-label">Chọn tags</label>
            <ui-select remove-selected="false" multiple ng-model="form.tag_ids">
                <ui-select-match placeholder="Chọn tag">
                    <% $item.name %>
                </ui-select-match>
                <ui-select-choices
                    repeat="item.id as item in (tags | filter: $select.search)">
                    <span ng-bind="item.name"></span>
                </ui-select-choices>
            </ui-select>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Trạng thái</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.status">
                <option value="">Chọn trạng thái</option>
                <option value="0">Lưu nháp</option>
                <option value="1">Xuất bản</option>
            </select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.status[0] %>
                </strong>
            </span>
        </div>

        {{-- <div class="form-group custom-group mb-4">
            <label class="form-label">Tình trạng</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.state">
                <option value="">Chọn tình trạng hàng hóa</option>
                <option value="1">Còn hàng</option>
                <option value="2">Hết hàng</option>
            </select>
        </div> --}}

{{--        <div class="form-group custom-group mb-4">--}}
{{--            <label class="form-label">Ghim sản phẩm</label>--}}
{{--            <select id="my-select" class="form-control custom-select" ng-model="form.is_pin">--}}
{{--                <option value="2">Không ghim</option>--}}
{{--                <option value="1">Ghim</option>--}}
{{--            </select>--}}
{{--        </div>--}}

        <div class="form-group text-center">
            <div class="main-img-preview">
                <p class="help-block-img">* Ảnh định dạng: jpg, png không quá 2MB.</p>
                <img class="thumbnail img-preview" ng-src="<% form.image.path %>">
            </div>
            <div class="input-group" style="width: 100%; text-align: center">
                <div class="input-group-btn" style="margin: 0 auto">
                    <div class="fileUpload fake-shadow cursor-pointer">
                        <label class="mb-0" for="<% form.image.element_id %>">
                            <i class="glyphicon glyphicon-upload"></i> Chọn ảnh
                        </label>
                        <input class="d-none" id="<% form.image.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
            </div>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.image[0] %>
                </strong>
            </span>
        </div>
        <hr>
        <div class="form-group text-center">
            <label for="">Gallery ảnh</label>
            <div class="row gallery-area border">
                <div class="col-md-4 p-2" ng-repeat="g in form.galleries">
                    <div class="gallery-item">
                        <button class="btn btn-sm btn-danger remove" ng-click="form.removeGallery($index)">
                            <i class="fa fa-times mr-0"></i>
                        </button>
                        <div class="form-group">
                            <div class="img-chooser" title="Chọn ảnh">
                                <label for="<% g.image.element_id %>">
                                    <img ng-src="<% g.image.path %>">
                                    <input class="d-none" type="file" accept=".jpg,.png,.jpeg" id="<% g.image.element_id %>">
                                </label>
                            </div>
                            <span class="invalid-feedback d-block" role="alert" ng-if="!errors['galleries.' + $index + '.image_obj']">
                                <strong>
                                    <% errors['galleries.' + $index + '.image' ][0] %>
                                </strong>
                            </span>
                            <span class="invalid-feedback">
                                <strong>
                                    <% errors['galleries.' + $index + '.image_obj' ][0] %>
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-2">
                    <label class="gallery-item d-flex align-items-center justify-content-center cursor-pointer" for="gallery-chooser">
                        <i class="fa fa-plus fa-2x text-secondary"></i>
                    </label>
                    <input class="d-none" type="file" accept=".jpg,.png,.jpeg" id="gallery-chooser" multiple>
                </div>
            </div>
            <span class="invalid-feedback">
                <strong>
                    <% errors.galleries[0] %>
                </strong>
            </span>
        </div>

{{--        <div class="col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <label>File đính kèm: </label>--}}
{{--                <div class="d-flex">--}}
{{--                    <div class="document-item" ng-repeat="d in form.documents" style="margin-right: 20px">--}}
{{--                        <a href="javascript:void(0)" class="remove" ng-click="deleteFile(d)">--}}
{{--                            <i class="fa fa-times"></i>--}}
{{--                        </a>--}}
{{--                        <a href="<% d %>" target="_blank" class="fa fa-file-pdf-o fa-3x"></a>--}}
{{--                        <a href="<% d %>" target="_blank" class="mt-1 text-ellipsis" title="<% getFileName(d) %>"><% getFileName(d) %></a>--}}
{{--                    </div>--}}
{{--                    <div class="document-item" ng-repeat="d in addition_attachments" style="margin-right: 20px"--}}
{{--                         title="<% d.name ? d.name : 'Chọn file' %>"--}}
{{--                         ng-class="{'error': errors && errors['attachments.' + $index]}">--}}
{{--                        <a href="javascript:void(0)" class="remove" ng-click="removeFile($index)"><i--}}
{{--                                class="fa fa-times"></i></a>--}}
{{--                        <label class="fa fa-file-o fa-3x mb-0 text-secondary cursor-pointer"--}}
{{--                               for="document<% $index %>" ng-if="!d.name"></label>--}}
{{--                        <label class="fa fa-file-pdf-o fa-3x mb-0 text-secondary cursor-pointer"--}}
{{--                               for="document<% $index %>" ng-if="d.name"></label>--}}
{{--                        <label class="mt-1 mb-0 text-secondary file-name cursor-pointer"--}}
{{--                               for="document<% $index %>"><% d.name ? d.name : 'Chọn file' %></label>--}}
{{--                        <input class="d-none attachments" data-index="<% $index %>" type="file"--}}
{{--                               id="document<% $index %>" name="attachments[]">--}}
{{--                    </div>--}}
{{--                    <div class="document-item">--}}
{{--                        <a href="javascript:void(0)" class="fa fa-plus fa-2x text-secondary"--}}
{{--                           ng-click="addFile()"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors['attachments']">--}}
{{--                                <strong><% errors['attachments'][0] %></strong>--}}
{{--                            </span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group text-center">--}}
{{--            <label for="">Video, link</label>--}}
{{--            <div ng-if="!form.videos || !form.videos.length">Chưa có videos</div>--}}

{{--            <div ng-repeat="video in form.videos track by $index">--}}
{{--                <div class="mb-2 d-flex align-items-center">--}}
{{--                    <u>Video <% $index + 1 %></u>--}}
{{--                    <button class="btn btn-link text-danger ml-auto" ng-click="form.removeVideo($index)"><i class="fa fa-times"></i></button>--}}
{{--                </div>--}}
{{--                <div class="form-group custom-group mb-4">--}}
{{--                    <label class="form-label required-label">Link youtube</label>--}}
{{--                    <input class="form-control " type="text" ng-model="video.link">--}}

{{--                    <span class="invalid-feedback d-block" role="alert">--}}
{{--                        <strong>--}}
{{--                            <% errors['videos.' + $index + '.link' ][0] %>--}}
{{--                        </strong>--}}
{{--                    </span>--}}
{{--                </div>--}}

{{--                <div class="form-group custom-group mb-4">--}}
{{--                    <label class="form-label required-label">Video</label>--}}
{{--                    <input class="form-control " type="text" ng-model="video.video">--}}
{{--                    <span class="invalid-feedback d-block" role="alert">--}}
{{--                        <strong>--}}
{{--                            <% errors['videos.' + $index + '.video' ][0] %>--}}
{{--                        </strong>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <button class="btn btn-info btn-sm mt-1" ng-click="form.addVideo()">--}}
{{--                <i class="fa fa-plus"></i> Thêm video--}}
{{--            </button>--}}
{{--        </div>--}}

    </div>
</div>
<hr>
<div class="text-right">
    <button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
        <i ng-if="!loading.submit" class="fa fa-save"></i>
        <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
        Lưu
    </button>
    <a href="{{ route('Category.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
