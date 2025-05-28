@extends('site.layouts.master')
@section('title')
    Liên hệ
@endsection

@section('css')
@endsection

@section('content')
    <main ng-controller="ContactUsController" ng-cloak>
        <!-- breadcrumb start -->
        <section class="pt-30p">
            <div class="section-pt">
                <div
                    class="relative bg-cover bg-no-repeat rounded-24 overflow-hidden" style="background-image: url('/site/images/breadcrumbImg.png');">
                    <div class="container">
                        <div class="grid grid-cols-12 gap-30p relative xl:py-[130px] md:py-30 sm:py-25 py-20 z-[2]">
                            <div class="lg:col-start-2 lg:col-end-12 col-span-12">
                                <h2 class="heading-2 text-w-neutral-1 mb-3">
                                    Liên hệ
                                </h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front.home-page') }}" class="breadcrumb-link">
                                            Trang chủ
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-icon">
                                            <i class="ti ti-chevrons-right"></i>
                                        </span>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-current">Liên hệ với chúng tôi</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="overlay-11"></div>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->
        <!-- contact us section start -->
        <section class="section-py">
            <div class="container">
                <div class="grid grid-cols-12 gap-30p">
                    <div class="3xl:col-start-3 xxl:col-start-2 3xl:col-end-11 xxl:col-end-12 col-span-12">
                        <h2 class="heading-2 text-center text-w-neutral-1 mb-48p">
                            Hãy liên hệ với chúng tôi
                        </h2>
                        <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-30p mb-60p">
                            <div class="bg-b-neutral-3 rounded-4 flex-col-c text-center p-32p">
                                <span
                                    class="flex-c size-80p rounded-full border border-primary text-primary icon-40 mb-32p">
                                    <i class="ti ti-map-pin-filled"></i>
                                </span>
                                <h5 class="heading-5 text-w-neutral-1 mb-3">
                                    Địa chỉ
                                </h5>
                                <a href="#" class="text-m-regular text-body">
                                    {{ $config->address_company }}
                                </a>
                            </div>
                            <div class="bg-b-neutral-3 rounded-4 flex-col-c text-center p-32p">
                                <span
                                    class="flex-c size-80p rounded-full border border-primary text-primary icon-40 mb-32p">
                                    <i class="ti ti-mail-opened-filled"></i>
                                </span>
                                <h5 class="heading-5 text-w-neutral-1 mb-3">
                                    Địa chỉ Email
                                </h5>
                                <a href="mailto:{{ $config->email }}" class="text-m-regular text-body">
                                    {{ $config->email }}
                                </a>
                            </div>
                            <div class="bg-b-neutral-3 rounded-4 flex-col-c text-center p-32p">
                                <span
                                    class="flex-c size-80p rounded-full border border-primary text-primary icon-40 mb-32p">
                                    <i class="ti ti-phone-call"></i>
                                </span>
                                <h5 class="heading-5 text-w-neutral-1 mb-3">
                                    Hotline
                                </h5>
                                <a href="tel:{{ str_replace(' ', '', $config->hotline) }}" class="text-m-regular text-body">
                                    {{ $config->hotline }}
                                </a>
                            </div>
                        </div>
                        <div class="bg-b-neutral-3 rounded-4 p-40p">
                            <form>
                                <div class="grid grid-cols-8 gap-30p mb-48p">
                                    <div class="sm:col-span-4 col-span-8">
                                        <label for="name" class="label label-md font-normal text-white mb-3">
                                            Họ tên
                                        </label>
                                        <input class="box-input-4" type="text" name="name" id="name"
                                            ng-model="your_name" placeholder="Name" />
                                        <div class="invalid-feedback d-block error" role="alert">
                                            <span ng-if="errors && errors.your_email">
                                                <% errors.your_email[0] %>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-4 col-span-8">
                                        <label for="contactEmail" class="label label-md font-normal text-white mb-3">
                                            Email
                                        </label>
                                        <input class="box-input-4" type="text" name="contactEmail" id="contactEmail"
                                            ng-model="your_email" placeholder="Email" />
                                        <div class="invalid-feedback d-block error" role="alert">
                                            <span ng-if="errors && errors.your_email">
                                                <% errors.your_email[0] %>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-4 col-span-8">
                                        <label for="phone" class="label label-md font-normal text-white mb-3">
                                            Số điện thoại
                                        </label>
                                        <input class="box-input-4" type="number" name="phone" id="phone"
                                            ng-model="your_phone" placeholder="--- --- ---" />
                                        <div class="invalid-feedback d-block error" role="alert">
                                            <span ng-if="errors && errors.your_phone">
                                                <% errors.your_phone[0] %>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-span-8">
                                        <label for="subject" class="label label-md font-normal text-white mb-3">
                                            Nội dung
                                        </label>
                                        <textarea class="box-input-4 h-[156px]" name="message" id="message" placeholder="Nội dung" ng-model="your_message"></textarea>
                                        <div class="invalid-feedback d-block error" role="alert">
                                            <span ng-if="errors && errors.your_message">
                                                <% errors.your_message[0] %>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary rounded-12 w-full" ng-click="submitContact()">
                                    Gửi liên hệ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact us section end -->
    </main>
    <!-- main end -->
@endsection

@push('script')
    <script>
        app.controller('ContactUsController', function($scope, $http) {
            $scope.loading = false;
            $scope.errors = {};
            $scope.submitContact = function() {
                $scope.loading = true;
                let data = {
                    your_name: $scope.your_name,
                    your_email: $scope.your_email,
                    your_phone: $scope.your_phone,
                    your_message: $scope.your_message
                };
                jQuery.ajax({
                    url: '{{ route('front.post-contact') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Thao tác thành công !')
                        } else {
                            $scope.errors = response.errors;
                            toastr.error('Thao tác thất bại !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                        $scope.loading = false;
                    }
                });
            };
        });
    </script>
@endpush
