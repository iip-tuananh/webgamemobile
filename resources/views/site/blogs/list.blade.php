@extends('site.layouts.master')
@section('title')
    {{ $cate_title }}
@endsection
@section('description')
    {{ $cate_des ?? '' }}
@endsection

@section('css')
@endsection

@section('content')
    <main>
        <!-- breadcrumb start -->
        <section class="pt-30p">
            <div class="section-pt">
                <div
                    class="relative bg-cover bg-no-repeat rounded-24 overflow-hidden" style="background-image: url('/site/images/breadcrumbImg.png');">
                    <div class="container">
                        <div class="grid grid-cols-12 gap-30p relative xl:py-[130px] md:py-30 sm:py-25 py-20 z-[2]">
                            <div class="lg:col-start-2 lg:col-end-12 col-span-12">
                                <h2 class="heading-2 text-w-neutral-1 mb-3">
                                    {{$cate_title}}
                                </h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('front.home-page')}}" class="breadcrumb-link">
                                            Trang chủ
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-icon">
                                            <i class="ti ti-chevrons-right"></i>
                                        </span>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="breadcrumb-current">{{$cate_title}}</span>
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
        <!-- all blogs section start -->
        <section class="section-pb pt-60p ">
            <div class="container">
                <div class="grid 3xl:grid-cols-4 xl:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-30p">
                    @foreach ($blogs as $blog)
                    <div class="bg-b-neutral-3 py-24p px-30p rounded-12 group" data-aos="zoom-in">
                        <div class="overflow-hidden rounded-12">
                            <img class="w-full h-[202px] object-cover group-hover:scale-110 transition-1"
                                src="{{$blog->image ? $blog->image->path : ''}}" alt="{{$blog->name}}" />
                        </div>
                        <div class="flex-y justify-between flex-wrap gap-20px py-3">
                            <div class="flex-y gap-3">
                                <div class="flex-y gap-1">
                                    <i class="ti ti-calendar-event icon-20 text-danger"></i>
                                    <span class="text-sm text-w-neutral-1">
                                        {{$blog->created_at->format('d/m/Y')}}
                                    </span>
                                </div>
                                <div class="flex-y gap-1">
                                    <i class="ti ti-user icon-20 text-primary"></i>
                                    <span class="text-sm text-w-neutral-1">
                                        {{$blog->user_create->name}}
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="flex-y gap-1">
                                <i class="ti ti-share-3 icon-20 text-w-neutral-4"></i>
                                <span>
                                    8
                                </span>
                            </div> --}}
                        </div>
                        <div class="flex-y flex-wrap gap-3 mb-1">
                            <span class="text-m-medium text-w-neutral-1">
                                {{$blog->category->name}}
                            </span>
                            {{-- <p class="text-sm text-w-neutral-2">
                                {{$blog->created_at->format('d/m/Y')}}
                            </p> --}}
                        </div>
                        <a href="{{route('front.detail-blog', $blog->slug)}}" class="heading-5 text-w-neutral-1 leading-[130%] line-clamp-2 link-1">
                            {{$blog->name}}
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="flex-c mt-48p">
                    {{$blogs->links()}}
                </div>
            </div>
        </section>
        <!-- all blogs section end -->
    </main>
    <!-- main end -->
@endsection

@push('script')
@endpush
