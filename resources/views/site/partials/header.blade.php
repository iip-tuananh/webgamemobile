    <!-- header start -->
    <header id="header" class="absolute w-full z-[999]" ng-cloak>
        <div class="mx-auto relative">
            <div id="header-nav" class="w-full px-24p bg-b-neutral-3 relative">
                <div class="flex items-center justify-between gap-x-2 mx-auto py-20p">
                    <nav
                        class="relative xl:grid xl:grid-cols-12 flex justify-between items-center gap-24p text-semibold w-full">
                        <div class="3xl:col-span-6 xl:col-span-5 flex items-center 3xl:gap-x-10 gap-x-5">
                            <a href="{{ route('front.home-page') }}" class="shrink-0">
                                <img class="xl:w-[170px] sm:w-36 w-30 h-auto shrink-0" src="{{ $config->image->path }}"
                                    alt="brand" />
                            </a>
                            <form action="{{ route('front.search') }}" method="get"
                                class="hidden lg:flex items-center sm:gap-3 gap-2 min-w-[300px] max-w-[670px] w-full px-20p py-16p bg-b-neutral-4 rounded-full">
                                <span class="flex-c icon-20 text-white">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input autocomplete="off" class="bg-transparent w-full" type="text" name="keyword"
                                    id="search" placeholder="Tìm kiếm ..." />
                            </form>
                        </div>
                        <div
                            class="3xl:col-span-6 xl:col-span-7 flex items-center xl:justify-between justify-end w-full">
                            <a href="#"
                                class="hidden xl:inline-flex items-center gap-3 pl-1 py-1 pr-6  rounded-full bg-[rgba(242,150,32,0.10)] text-w-neutral-1 text-base">
                                <span class="size-48p flex-c text-b-neutral-4 bg-primary rounded-full icon-32">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-speakerphone">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 8a3 3 0 0 1 0 6" />
                                        <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
                                        <path
                                            d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
                                    </svg>
                                </span>
                                News For You
                            </a>
                            <div class="flex items-center lg:gap-x-16p gap-x-2">
                                <div class="hidden lg:flex items-center gap-1 shrink-0">
                                    {{-- <a href="./shopping-cart.html" class="btn-c btn-c-lg btn-c-dark-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M17 17h-11v-14h-2" />
                                        <path d="M6 5l14 1l-1 7h-13" />
                                    </svg>
                                </a> --}}
                                    <div class="relative hidden lg:block">
                                        <a href="javascript:void(0)" class="btn-c btn-c-lg btn-c-dark-outline">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                                <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @if (Auth::check())
                                    <div x-data="dropdown" class="dropdown relative shrink-0 lg:block hidden">
                                        <button @click="toggle()" class="dropdown-toggle gap-24p">
                                            <span class="flex items-center gap-3">
                                                <img class="size-48p rounded-full shrink-0"
                                                    src="{{ Auth::user()->avatar }}" alt="profile" />
                                                <span class="">
                                                    <span class="text-sm text-w-neutral-4 block">
                                                        Xin chào
                                                    </span>
                                                    <span class="text-m-medium text-w-neutral-1 mb-1">
                                                        {{ Auth::user()->name }}
                                                    </span>
                                                </span>
                                            </span>
                                            <span :class="isOpen ? '-rotate-180' : ''"
                                                class="btn-c btn-c-lg text-w-neutral-4 icon-32 transition-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 9l6 6l6 -6" />
                                                </svg>
                                            </span>
                                        </button>
                                        <div x-show="isOpen" x-transition @click.away="close()"
                                            class="dropdown-content">
                                            <a href="{{ route('index') }}" class="dropdown-item">Trang quản lý</a>
                                            {{-- <a href="./user-settings.html" class="dropdown-item">Settings</a> --}}
                                            <a href="{{ route('logout') }}" class="dropdown-item">Đăng
                                                xuất</a>
                                            {{-- <a href="./contact-us.html" class="dropdown-item">Help</a> --}}
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('front.login-client') }}" class="btn btn-primary lg:block hidden">
                                        <i class="ti ti-login"></i> Đăng nhập
                                    </a>
                                    <a href="{{ route('front.login-client') }}?register=true" class="btn btn-primary lg:block hidden">
                                        <i class="ti ti-user-plus"></i> Đăng ký
                                    </a>
                                @endif
                                <button class="lg:hidden btn-c btn-c-lg btn-c-dark-outline nav-toggole shrink-0">
                                    <i class="ti ti-menu-2"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <nav class="w-full flex justify-between items-center">
                <div
                    class="small-nav fixed top-0 left-0 h-screen w-full shadow-lg z-[999] transform transition-transform ease-in-out invisible md:translate-y-full max-md:-translate-x-full duration-500">
                    <div class="absolute z-[5] inset-0 bg-b-neutral-3 flex-col-c min-h-screen max-md:max-w-[400px]">
                        <div
                            class="container max-md:p-0 md:overflow-y-hidden overflow-y-scroll scrollbar-sm lg:max-h-screen">
                            <div class="p-40p">
                                <div class="flex justify-between items-center mb-10">
                                    <a href="{{ route('front.home-page') }}">
                                        <img class="w-[142px]" src="{{ $config->image->path }}" alt="logo" />
                                    </a>
                                    <button class="nav-close btn-c btn-c-md btn-c-primary">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </div>
                                <div class="grid grid-cols-12 gap-x-24p gap-y-10 sm:p-y-48p">
                                    <div class="xl:col-span-8 md:col-span-7 col-span-12">
                                        <div
                                            class="overflow-y-scroll overflow-x-hidden scrollbar scrollbar-sm xl:max-h-[532px] md:max-h-[400px] md:pr-4">
                                            <ul
                                                class="flex flex-col justify-center items-start gap-20p text-w-neutral-1">
                                                <li class="mobail-menu">
                                                    <a href="{{ route('front.home-page') }}">Trang chủ</a>
                                                </li>
                                                @foreach ($specialCategories as $category)
                                                <li class="mobail-menu">
                                                    <a href="{{route('front.show-product-category', $category->slug)}}">{{$category->name}}</a>
                                                </li>
                                                @endforeach
                                                @foreach ($productCategories as $category)
                                                <li class="sub-menu mobail-submenu">
                                                    <span class="mobail-submenu-btn">
                                                        <span class="submenu-btn">{{$category->name}}</span>
                                                        @if ($category->childs->count() > 0)
                                                        <span class="collapse-icon mobail-submenu-icon">
                                                            <i class="ti ti-chevron-down"></i>
                                                            </span>
                                                        @endif
                                                    </span>
                                                    @if ($category->childs->count() > 0)
                                                    <ul class="grid gap-y-2 px-16p">
                                                        @foreach ($category->childs as $child)
                                                        <li class="pt-2">
                                                            <a aria-label="item"
                                                                class="text-base hover:text-primary transition-1"
                                                                href="{{route('front.show-product-category', $child->slug)}}">
                                                                - {{$child->name}}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                                @foreach ($postCategories as $category)
                                                <li class="mobail-menu">
                                                    <a href="{{route('front.list-blog', $category->slug)}}">{{$category->name}}</a>
                                                </li>
                                                @endforeach
                                                <li class="mobail-menu">
                                                    <a href="{{route('front.contact-us')}}">Liên hệ</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="xl:col-span-4 md:col-span-5 col-span-12">
                                        <div class="flex flex-col items-baseline justify-between h-full">
                                            <form action="{{ route('front.search') }}" method="get"
                                                class="w-full flex items-center justify-between px-16p py-2 pr-1 border border-w-neutral-4/60 rounded-full">
                                                <input class="placeholder:text-w-neutral-4 bg-transparent w-full"
                                                    type="text" name="keyword" placeholder="Tìm kiếm ..."
                                                    id="search-media" />
                                                <button type="submit" class="btn-c btn-c-md text-w-neutral-4">
                                                    <i class="ti ti-search"></i>
                                                </button>
                                            </form>
                                            <div class="mt-40p">
                                                <img class="mb-16p" src="{{ $config->image->path }}"
                                                    alt="logo" />
                                                <p class="text-base text-w-neutral-3 mb-32p">
                                                    {{ $config->web_des }}
                                                </p>
                                                <div class="flex items-center flex-wrap gap-3">
                                                    <a href="{{ $config->facebook }}" class="btn-socal-primary">
                                                        <i class="ti ti-brand-facebook"></i>
                                                    </a>
                                                    <a href="https://zalo.me/{{ $config->zalo }}" class="btn-socal-primary">
                                                        <i class="ti ti-brand-twitch"></i>
                                                    </a>
                                                    <a href="{{ $config->instagram }}" class="btn-socal-primary">
                                                        <i class="ti ti-brand-instagram"></i>
                                                    </a>
                                                    <a href="{{ $config->tiktok }}" class="btn-socal-primary">
                                                        <i class="ti ti-brand-discord"></i>
                                                    </a>
                                                    <a href="{{ $config->youtube }}" class="btn-socal-primary">
                                                        <i class="ti ti-brand-youtube"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-close min-h-[200vh] navbar-overly"></div>
                </div>
            </nav>
        </div>
    </header>
    <!-- header end -->
    <!-- sidebar start -->
    <div ng-cloak>
        <!-- left sidebar start-->
        <div class="fixed top-0 left-0 lg:translate-x-0 -translate-x-full h-screen z-10 pt-32 transition-1" style="background: #0e1012">
            <div class="overflow-y-auto scrollbar-0 max-h-svh px-[8px] w-full h-full">
                <div class="grid grid-cols-1 gap-20p divide-y divide-shap mb-40p">
                    <div class="small-nav">
                        <span class="text-s-medium text-w-neutral-1 mb-20p">
                            Navigate
                        </span>
                        <ul class="grid grid-cols-1 gap-y-3">
                            <li class="sub-menu mobail-submenu border-none pb-0">
                                <span
                                    class="mobail-submenu-btn flex-y justify-between px-2 py-16p bg-primary text-m-regular rounded-12 w-full transition-1"
                                    ng-click="goToHomePage()">
                                    <span class="submenu-btn text-b-neutral-4 flex-y gap-3 ">
                                        <span class="icon-28">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                            </svg>
                                        </span>
                                        Trang chủ
                                    </span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-20p">
                        <span class="text-s-medium text-w-neutral-1 mb-20p">
                            Navigate
                        </span>
                        <ul class="grid grid-cols-1 gap-y-3">
                            @foreach ($specialCategories as $category)
                                <li>
                                    <a href="{{ route('front.show-product-category', $category->slug) }}"
                                        class="flex-y gap-3 px-2 py-16p hover:bg-primary text-m-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                                        <span class="icon-28">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-flame">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 10.941c2.333 -3.308 .167 -7.823 -1 -8.941c0 3.395 -2.235 5.299 -3.667 6.706c-1.43 1.408 -2.333 3.621 -2.333 5.588c0 3.704 3.134 6.706 7 6.706s7 -3.002 7 -6.706c0 -1.712 -1.232 -4.403 -2.333 -5.588c-2.084 3.353 -3.257 3.353 -4.667 2.235" />
                                            </svg>
                                        </span>
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                            @foreach ($productCategories as $category)
                                <li class="sub-menu mobail-submenu border-none pb-0">
                                    <span
                                        class="mobail-submenu-btn flex-y justify-between px-2 py-16p text-m-regular rounded-12 w-full transition-1">
                                        <span class="submenu-btn flex-y gap-3 ">
                                            <a href="{{ route('front.show-product-category', $category->slug) }}">
                                                <span class="icon-28">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                        height="28" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-gamepad-2">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M12 5h3.5a5 5 0 0 1 0 10h-5.5l-4.015 4.227a2.3 2.3 0 0 1 -3.923 -2.035l1.634 -8.173a5 5 0 0 1 4.904 -4.019h3.4z" />
                                                        <path
                                                            d="M14 15l4.07 4.284a2.3 2.3 0 0 0 3.925 -2.023l-1.6 -8.232" />
                                                        <path d="M8 9v2" />
                                                        <path d="M7 10h2" />
                                                        <path d="M14 10h2" />
                                                    </svg>
                                                </span>
                                            </a>
                                            {{ $category->name }}
                                        </span>
                                        @if ($category->childs->count() > 0)
                                            <span class="collapse-icon mobail-submenu-icon">
                                                <i class="ti ti-chevron-down"></i>
                                            </span>
                                        @endif
                                    </span>
                                    @if ($category->childs->count() > 0)
                                        <ul class="grid gap-y-2 px-16p">
                                            @foreach ($category->childs as $child)
                                                <li class="pt-2">
                                                    <a aria-label="item"
                                                        class="text-base hover:text-primary transition-1"
                                                        href="{{ route('front.show-product-category', $child->slug) }}">
                                                        - {{ $child->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="pt-20p">
                        <span class="text-s-medium text-w-neutral-1 mb-20p">
                            Get Help
                        </span>
                        <ul class="grid grid-cols-1 gap-y-3">
                            <li>
                                <a href="{{ route('front.contact-us') }}"
                                    class="flex-y gap-3 px-2 py-16p hover:bg-primary text-m-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                                    <span class="icon-28">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-headset">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 14v-3a8 8 0 1 1 16 0v3" />
                                            <path d="M18 19c0 1.657 -2.686 3 -6 3" />
                                            <path
                                                d="M4 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3z" />
                                            <path
                                                d="M15 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3z" />
                                        </svg>
                                    </span>
                                    Liên hệ
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div>
                    <div class="rounded-24 overflow-hidden relative">
                        <button class="absolute top-3 right-3 btn-c size-8 btn-neutral-3 icon-16 z-[2]">
                            <i class="ti ti-x"></i>
                        </button>
                        <img class="w-full h-auto hover:scale-110 transition-1"
                            src="./assets/images/seasons/session9.png" alt="img" />
                        <div class="p-24p absolute left-0 right-0 bottom-0 z-[2]">
                            <h4 class="heading-4 text-w-neutral-1 line-clamp-2 mb-2">
                                Join The GameCO Now
                            </h4>
                            <p class="text-s-medium text-w-neutral-1 line-clamp-2 mb-24p">
                                Discover the best live streams anywhere.
                            </p>
                            <a href="#" class="btn btn-xl py-3 btn-primary rounded-12">
                                Join Now
                            </a>
                        </div>
                        <div class="overlay-2"></div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- left sidebar end -->
        <!-- right sidebar start -->
        <div class="fixed top-0 right-0 lg:translate-x-0 translate-x-full h-screen z-10 pt-30 px-[27px] transition-1" style="background: #0e1012">
            <div class="flex flex-col items-center xxl:gap-[30px] xl:gap-6 lg:gap-5 gap-4">
                <div class="flex flex-col items-center gap-16p rounded-full w-fit p-2" style="min-height: 500px;">
                    <div class="swiper infinity-slide-vertical messenger-carousel max-h-[588px] w-full">
                        <div class="swiper-wrapper">
                            @foreach ($users as $user)
                                <div class="swiper-slide">
                                    <a href="#" class="avatar size-60p">
                                        <img src="{{ $user->avatar ?? '' }}" alt="avatar"
                                            style="height: 100%; width: 100%; border-radius: 50%;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-full h-1px bg-b-neutral-1"></div>
                {{-- <div class="flex flex-col items-center gap-16p rounded-full w-fit p-2">
                    <div class="swiper infinity-slide-vertical messenger-carousel max-h-[136px] w-full">
                        <div class="swiper-wrapper">
                            @foreach ($users as $user)
                            <div class="swiper-slide">
                                <a href="#" class="avatar size-60p">
                                    <img src="{{$user->avatar ?? ''}}" alt="avatar" style="height: 100%; width: 100%; border-radius: 50%;">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- right sidebar end -->
    </div>
    <!-- sidebar end -->
