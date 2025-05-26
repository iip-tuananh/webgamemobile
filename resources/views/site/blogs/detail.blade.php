@extends('site.layouts.master')
@section('title')
    {{ $blog_title }}
@endsection
@section('description')
    {{ $blog_description }}
@endsection

@section('css')
@endsection

@section('content')
    <main>
        <!-- blog__details__section start -->
        <section class="blog__details__section pt-50 pt-lg-60 pb-50 pb-lg-60">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="blog__details__wrapper">
                            <div class="ht-blog">
                                <div class="blog__thumb mb-20">
                                    <img class="w-100" src="{{ $blog->image ? $blog->image->path : '' }}" alt="blog" loading="lazy">
                                </div>
                                <div class="ht-blog__meta">
                                    <span><a href="#" class="text-dark"><img src="/site/images/icon-1a.svg" alt="icon" loading="lazy">
                                            Admin</a></span>
                                    <span><a href="#" class="text-dark"><img src="/site/images/icon-2a.svg" alt="icon" loading="lazy">
                                            {{ $blog->category->name }}</a></span>
                                </div>
                            </div>
                            <h3 class="blog__title__big mb-20"><a href="blog-details.html">{{ $blog->name }}</a>
                            </h3>
                            {!! $blog->body !!}
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 order-lg-first">
                        @include('site.blogs.nav-blog')
                    </div>
                </div>
            </div>
        </section>
        <!-- blog__details__section end -->
    </main>
@endsection

@push('script')
@endpush
