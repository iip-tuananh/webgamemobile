<footer class="relative section-pt overflow-hidden bg-b-neutral-3">
    <div class="container">
        <div class="relative z-10 lg:px-10">
            <div class="flex items-center justify-between gap-24p pb-60p">
                <div class="max-w-[530px]">
                    <h2 class="display-4 text-w-neutral-1 mb-32p text-split-left">Subscribe to our</h2>
                    <h2 class="display-lg mb-32p">
                        Newsletter
                    </h2>
                    <form class="flex items-center gap-24p pb-16p border-b-2 border-dashed border-shap">
                        <input type="email" name="subscribe" id="subscribe" required
                            placeholder="Enter your email address"
                            class="input w-full bg-transparent text-w-neutral-1 placeholder:text-w-neutral-4" />
                        <button type="submit" class="text-lg font-semibold font-poppins">Subscribe</button>
                    </form>
                </div>
            </div>
            <div
                class="grid 4xl:grid-cols-12 3xl:grid-cols-4 sm:grid-cols-2 grid-cols-1 4xl:gap-x-6 max-4xl:gap-40p border-y-2 border-dashed border-shap py-80p">
                <div class="4xl:col-start-1 4xl:col-end-4">
                    <img class="mb-16p" src="{{$config->image ? $config->image->path : ''}}" alt="logo" />
                    <p class="text-base text-w-neutral-3 mb-32p">
                        {{$config->web_des}}
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="{{$config->facebook}}" class="btn-socal-primary">
                            <i class="ti ti-brand-facebook"></i>
                        </a>
                        <a href="https://zalo.me/{{$config->zalo}}" class="btn-socal-primary">
                            <i class="ti ti-brand-twitch"></i>
                        </a>
                        <a href="{{$config->instagram}}" class="btn-socal-primary">
                            <i class="ti ti-brand-instagram"></i>
                        </a>
                        <a href="{{$config->tiktok}}" class="btn-socal-primary">
                            <i class="ti ti-brand-discord"></i>
                        </a>
                        <a href="{{$config->youtube}}" class="btn-socal-primary">
                            <i class="ti ti-brand-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="4xl:col-start-5 4xl:col-end-7">
                    <div class="flex items-center gap-24p mb-24p">
                        <h4 class="heading-4 text-w-neutral-1 whitespace-nowrap ">
                            Danh mục game
                        </h4>
                        <span class="w-full max-w-[110px] h-0.5 bg-w-neutral-1"></span>
                    </div>
                    <ul class="grid grid-cols-2 sm:gap-y-16p gap-y-2 gap-x-32p *:flex *:items-center">
                        @foreach ($allProductCategories as $productCategory)
                        <li
                            class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                            <i
                                class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                            <a href="{{route('front.show-product-category', $productCategory->slug)}}" class="text-m-regular text-w-neutral-3">
                                {{$productCategory->name}}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="4xl:col-start-8 4xl:col-end-10">
                    <div class="flex items-center gap-24p mb-24p">
                        <h4 class="heading-4 text-w-neutral-1 whitespace-nowrap ">
                            Hỗ trợ
                        </h4>
                        <span class="w-full max-w-[110px] h-0.5 bg-w-neutral-1"></span>
                    </div>
                    <ul class="grid grid-cols-2 sm:gap-y-16p gap-y-2 gap-x-32p *:flex *:items-center">
                        @foreach ($post_categories as $postCategory)
                        <li
                            class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                            <i
                                class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                            <a href="{{route('front.list-blog', $postCategory->slug)}}" class="text-m-regular text-w-neutral-3">
                                {{$postCategory->name}}
                            </a>
                        </li>
                        @endforeach
                        <li
                            class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                            <i
                                class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                            <a href="{{route('front.contact-us')}}" class="text-m-regular text-w-neutral-3">
                                Liên hệ
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="4xl:col-start-11 4xl:col-end-13">
                    <h4 class="heading-4 text-w-neutral-1 whitespace-nowrap  mb-3">
                        Email Us
                    </h4>
                    <a href="mailto:{{$config->email}}" class="text-base text-w-neutral-3 mb-32p">
                        {{$config->email}}
                    </a>
                    <h4 class="heading-5 whitespace-nowrap mb-3">
                        Contact Us
                    </h4>
                    <a href="tel:{{ str_replace(' ', '', $config->hotline)}}" class="text-base text-w-neutral-3">
                        {{$config->hotline}}
                    </a>
                </div>
            </div>
            <div class="flex items-center justify-between flex-wrap gap-24p py-30p">
                <div class="flex items-center flex-wrap">
                    <p class="text-base text-w-neutral-3">
                        Copyright ©
                        <span class="currentYear span"></span>
                    </p>
                    <div class="w-1px h-4 bg-shap mx-24p"></div>
                    <p class="text-base text-white">
                        Designed By <a href="#"
                            class="text-primary hover:underline a">{{$config->web_title}}</a>
                    </p>
                </div>
                <div class="flex items-center text-base gap-24p text-white">
                    @foreach ($policies as $policy)
                    <a href="{{route('front.show-policy', $policy->slug)}}" class="hover:text-primary transition-1 block">
                        {{$policy->title}}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="absolute right-0 top-0 xl:block hidden" data-aos="zoom-out-right" data-aos-duration="800">
            <img class="3xl:w-[580px] xxl:w-[500px] xl:w-[400px]" src="/site/images/footerIllustration.webp"
                alt="footer" />
        </div>
    </div>
</footer>
<!-- footer end -->
