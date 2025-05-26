<!DOCTYPE html>
<html dir="ltr" lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon" />
      <title>GameCo - HTML Tailwind CSS</title>
      <script defer src="/js/app.js"></script>
      <link href="/css/app.css" rel="stylesheet">
   </head>
   <body>
      <!-- preloader start -->
      <div class="preloader">
         <div class="loader"></div>
      </div>
      <!-- preloader end -->
      <!-- scroll to top button start -->
      <button class="scroll-to-top show" id="scrollToTop">
      <i class="ti ti-arrow-up"></i>
      </button>
      <!-- scroll to top button end -->
      <!-- header start -->
      <header id="header" class="absolute w-full z-[999]">
         <div class="mx-auto relative">
            <div id="header-nav" class="w-full px-24p bg-b-neutral-3 relative">
               <div class="flex items-center justify-between gap-x-2 mx-auto py-20p">
                  <nav class="relative xl:grid xl:grid-cols-12 flex justify-between items-center gap-24p text-semibold w-full">
                     <div class="3xl:col-span-6 xl:col-span-5 flex items-center 3xl:gap-x-10 gap-x-5">
                        <a href="index.html" class="shrink-0">
                        <img class="xl:w-[170px] sm:w-36 w-30 h-auto shrink-0" src="./assets/images/icons/logo.png" alt="brand" />
                        </a>
                        <form
                           class="hidden lg:flex items-center sm:gap-3 gap-2 min-w-[300px] max-w-[670px] w-full px-20p py-16p bg-b-neutral-4 rounded-full">
                           <span class="flex-c icon-20 text-white">
                           <i class="ti ti-search"></i>
                           </span>
                           <input autocomplete="off" class="bg-transparent w-full" type="text" name="search" id="search"
                              placeholder="Search..." />
                        </form>
                     </div>
                     <div class="3xl:col-span-6 xl:col-span-7 flex items-center xl:justify-between justify-end w-full">
                        <a href="#"
                           class="hidden xl:inline-flex items-center gap-3 pl-1 py-1 pr-6  rounded-full bg-[rgba(242,150,32,0.10)] text-w-neutral-1 text-base">
                           <span class="size-48p flex-c text-b-neutral-4 bg-primary rounded-full icon-32">
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
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
                        <div class="flex items-center lg:gap-x-32p gap-x-2">
                           <div class="hidden lg:flex items-center gap-1 shrink-0">
                              <a href="./shopping-cart.html" class="btn-c btn-c-lg btn-c-dark-outline">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 17h-11v-14h-2" />
                                    <path d="M6 5l14 1l-1 7h-13" />
                                 </svg>
                              </a>
                              <div class="relative hidden lg:block">
                                 <a href="chat.html" class="btn-c btn-c-lg btn-c-dark-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                       stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                       class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path
                                          d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                       <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                                    </svg>
                                 </a>
                              </div>
                           </div>
                           <div x-data="dropdown" class="dropdown relative shrink-0 lg:block hidden">
                              <button @click="toggle()" class="dropdown-toggle gap-24p">
                                 <span class="flex items-center gap-3">
                                 <img class="size-48p rounded-full shrink-0" src="./assets/images/users/user1.png" alt="profile" />
                                 <span class="">
                                 <span class="text-m-medium text-w-neutral-1 mb-1">
                                 David Malan
                                 </span>
                                 <span class="text-sm text-w-neutral-4 block">
                                 270 Followars
                                 </span>
                                 </span>
                                 </span>
                                 <span :class="isOpen ? '-rotate-180' : ''"
                                    class="btn-c btn-c-lg text-w-neutral-4 icon-32 transition-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                       stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                       class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M6 9l6 6l6 -6" />
                                    </svg>
                                 </span>
                              </button>
                              <div x-show="isOpen" x-transition @click.away="close()" class="dropdown-content">
                                 <a href="./profile.html" class="dropdown-item">Profile</a>
                                 <a href="./user-settings.html" class="dropdown-item">Settings</a>
                                 <button type="button" @click="close()" class="dropdown-item">Logout</button>
                                 <a href="./contact-us.html" class="dropdown-item">Help</a>
                              </div>
                           </div>
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
                     <div class="container max-md:p-0 md:overflow-y-hidden overflow-y-scroll scrollbar-sm lg:max-h-screen">
                        <div class="p-40p">
                           <div class="flex justify-between items-center mb-10">
                              <a href="index.html">
                              <img class="w-[142px]" src="./assets/images/icons/logo.png" alt="GameCo" />
                              </a>
                              <button class="nav-close btn-c btn-c-md btn-c-primary">
                              <i class="ti ti-x"></i>
                              </button>
                           </div>
                           <div class="grid grid-cols-12 gap-x-24p gap-y-10 sm:p-y-48p">
                              <div class="xl:col-span-8 md:col-span-7 col-span-12">
                                 <div
                                    class="overflow-y-scroll overflow-x-hidden scrollbar scrollbar-sm xl:max-h-[532px] md:max-h-[400px] md:pr-4">
                                    <ul class="flex flex-col justify-center items-start gap-20p text-w-neutral-1">
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Home</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down "></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="index.html">
                                                - Home One
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="home-two.html">
                                                - Home Two
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="home-three.html">
                                                - Home Three
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="home-four.html">
                                                - Home Four
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="mobail-menu">
                                          <a href="trending.html">Trending</a>
                                       </li>
                                       <li class="mobail-menu">
                                          <a href="community.html">Community</a>
                                       </li>
                                       <li class="mobail-menu">
                                          <a href="saved.html">Saved</a>
                                       </li>
                                       <li class="mobail-menu">
                                          <a href="live-stream.html">Live Stream</a>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Library</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down"></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="library.html">
                                                - Library
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="library-details.html">
                                                - Library Details
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Games</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down"></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="games.html">
                                                - Games
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="game-details.html">
                                                - Game Details One
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="game-details-two.html">
                                                - Game Details Two
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Groups</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down"></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="groups-one.html">
                                                - Groups One
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="groups-two.html">
                                                - Group Two
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="group-home.html">
                                                - Group Home
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="group-related-groups.html">
                                                - Related Groups
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="group-forum.html">
                                                - Group Forum
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="group-members.html">
                                                - Group Members
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="group-media.html">
                                                - Group Media
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Teams</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down"></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="teams.html">
                                                - Teams
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="team-home.html">
                                                - Team Members
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="team-games.html">
                                                - Team Games
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="team-ranks.html">
                                                - Team Ranks
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="team-tournament.html">
                                                - Team Tournament
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Tournaments</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down"></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="tournaments.html">
                                                - Tournaments
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="tournament-overview.html">
                                                - Tournament Overview
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="tournament-prizes.html">
                                                - Tournament Prizes
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="tournament-participants.html">
                                                - Tournament Participants
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="tournament-matches.html">
                                                - Tournament Matches
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="tournament-brackets.html">
                                                - Tournament Brackets
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="mobail-menu">
                                          <a href="leaderboard.html">Leaderboard</a>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Marketplace</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down"></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="marketplace-one.html">
                                                - Marketplace One
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="marketplace-two.html">
                                                - Marketplace Two
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="marketplace-details.html">
                                                - Marketplace Details
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Profile</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down "></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="profile.html">
                                                - Post Item
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-game-stats.html">
                                                - Game Stats
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-about.html">
                                                - About
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-team.html">
                                                - My Team
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-groups.html">
                                                - My Group
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-forums.html">
                                                - Forums
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-videos.html">
                                                - Videos
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-achievements.html">
                                                - Achievements
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="chat.html">
                                                - Chat
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="user-settings.html">
                                                - Settings
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Shop</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down "></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="shop.html">
                                                - Shop
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="shop-details.html">
                                                - Shop Details
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="shopping-cart.html">
                                                - Shopping Cart
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="shipping.html">
                                                - Shipping
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="checkout.html">
                                                - checkout
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Blogs</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down "></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="blogs.html">
                                                - Blogs
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="blog-details.html">
                                                - Blog Details
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="sub-menu mobail-submenu">
                                          <span class="mobail-submenu-btn">
                                          <span class="submenu-btn">Pages</span>
                                          <span class="collapse-icon mobail-submenu-icon">
                                          <i class="ti ti-chevron-down "></i>
                                          </span>
                                          </span>
                                          <ul class="grid gap-y-2 px-16p">
                                             <li class="pt-2">
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="pricing-plan.html">
                                                - Pricing Plan
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="terms-conditions.html">
                                                - Terms Conditions
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="faqs.html">
                                                - Faq's
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1"
                                                   href="not-found.html">
                                                - Not Found
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="login.html">
                                                - Login
                                                </a>
                                             </li>
                                             <li>
                                                <a aria-label="item" class="text-base hover:text-primary transition-1" href="sign-up.html">
                                                - Sign Up
                                                </a>
                                             </li>
                                          </ul>
                                       </li>
                                       <li class="mobail-menu">
                                          <a href="contact-us.html">Contact Us</a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="xl:col-span-4 md:col-span-5 col-span-12">
                                 <div class="flex flex-col items-baseline justify-between h-full">
                                    <form
                                       class="w-full flex items-center justify-between px-16p py-2 pr-1 border border-w-neutral-4/60 rounded-full">
                                       <input class="placeholder:text-w-neutral-4 bg-transparent w-full" type="text" name="search-media"
                                          placeholder="Search Media" id="search-media" />
                                       <button type="submit" class="btn-c btn-c-md text-w-neutral-4">
                                       <i class="ti ti-search"></i>
                                       </button>
                                    </form>
                                    <div class="mt-40p">
                                       <img class="mb-16p" src="./assets/images/icons/logo.png" alt="logo" />
                                       <p class="text-base text-w-neutral-3 mb-32p">
                                          Become visionary behind a sprawling metropolis in Metropolis Tycoon Plan
                                          empire
                                          progress.
                                       </p>
                                       <div class="flex items-center flex-wrap gap-3">
                                          <a href="#" class="btn-socal-primary">
                                          <i class="ti ti-brand-facebook"></i>
                                          </a>
                                          <a href="#" class="btn-socal-primary">
                                          <i class="ti ti-brand-twitch"></i>
                                          </a>
                                          <a href="#" class="btn-socal-primary">
                                          <i class="ti ti-brand-instagram"></i>
                                          </a>
                                          <a href="#" class="btn-socal-primary">
                                          <i class="ti ti-brand-discord"></i>
                                          </a>
                                          <a href="#" class="btn-socal-primary">
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
      <div>
         <!-- left sidebar start-->
         <div class="fixed top-0 left-0 lg:translate-x-0 -translate-x-full h-screen z-10 pt-32 transition-1">
            <div class="overflow-y-auto scrollbar-0 max-h-svh px-[18px] w-full h-full">
               <div class="grid grid-cols-1 gap-20p divide-y divide-shap mb-40p">
                  <div class="small-nav">
                     <span class="text-s-medium text-w-neutral-1 mb-20p">
                     Navigate
                     </span>
                     <ul class="grid grid-cols-1 gap-y-3">
                        <li class="sub-menu mobail-submenu border-none pb-0">
                           <span
                              class="mobail-submenu-btn flex-y justify-between px-3 py-16p bg-primary text-l-regular rounded-12 w-full transition-1">
                              <span class="submenu-btn text-b-neutral-4 flex-y gap-3 ">
                                 <span class="icon-28">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                       viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                       stroke-linecap="round" stroke-linejoin="round"
                                       class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                       <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                       <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                 </span>
                                 Home
                              </span>
                              <span class="collapse-icon mobail-submenu-icon">
                              <i class="ti ti-chevron-down !text-b-neutral-4"></i>
                              </span>
                           </span>
                           <ul class="grid gap-y-2 px-16p">
                              <li class="pt-2">
                                 <a aria-label="item" class="text-base hover:text-primary transition-1"
                                    href="index.html">
                                 - Home One
                                 </a>
                              </li>
                              <li>
                                 <a aria-label="item" class="text-base hover:text-primary transition-1"
                                    href="home-two.html">
                                 - Home Two
                                 </a>
                              </li>
                              <li>
                                 <a aria-label="item" class="text-base hover:text-primary transition-1"
                                    href="home-three.html">
                                 - Home Three
                                 </a>
                              </li>
                              <li>
                                 <a aria-label="item" class="text-base hover:text-primary transition-1"
                                    href="home-four.html">
                                 - Home Four
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <a href="./tournaments.html"
                              class="flex-y gap-3 px-3 py-16p hover:bg-primary text-l-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                              <span class="icon-28">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-gamepad-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                       d="M12 5h3.5a5 5 0 0 1 0 10h-5.5l-4.015 4.227a2.3 2.3 0 0 1 -3.923 -2.035l1.634 -8.173a5 5 0 0 1 4.904 -4.019h3.4z" />
                                    <path d="M14 15l4.07 4.284a2.3 2.3 0 0 0 3.925 -2.023l-1.6 -8.232" />
                                    <path d="M8 9v2" />
                                    <path d="M7 10h2" />
                                    <path d="M14 10h2" />
                                 </svg>
                              </span>
                              Tournaments
                           </a>
                        </li>
                        <li>
                           <a href="./leaderboard.html"
                              class="flex-y gap-3 px-3 py-16p hover:bg-primary text-l-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                              <span class="icon-28">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trophy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 21l8 0" />
                                    <path d="M12 17l0 4" />
                                    <path d="M7 4l10 0" />
                                    <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                                    <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                 </svg>
                              </span>
                              Leaderboards
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="pt-20p">
                     <span class="text-s-medium text-w-neutral-1 mb-20p">
                     Navigate
                     </span>
                     <ul class="grid grid-cols-1 gap-y-3">
                        <li>
                           <a href="./user-achievements.html"
                              class="flex-y gap-3 px-3 py-16p hover:bg-primary text-l-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                              <span class="icon-28">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-flame">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                       d="M12 10.941c2.333 -3.308 .167 -7.823 -1 -8.941c0 3.395 -2.235 5.299 -3.667 6.706c-1.43 1.408 -2.333 3.621 -2.333 5.588c0 3.704 3.134 6.706 7 6.706s7 -3.002 7 -6.706c0 -1.712 -1.232 -4.403 -2.333 -5.588c-2.084 3.353 -3.257 3.353 -4.667 2.235" />
                                 </svg>
                              </span>
                              Rewards
                           </a>
                        </li>
                        <li>
                           <a href="./marketplace-two.html"
                              class="flex-y gap-3 px-3 py-16p hover:bg-primary text-l-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                              <span class="icon-28">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-diamond">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 5h12l3 5l-8.5 9.5a.7 .7 0 0 1 -1 0l-8.5 -9.5l3 -5" />
                                    <path d="M10 12l-2 -2.2l.6 -1" />
                                 </svg>
                              </span>
                              Marketplace
                           </a>
                        </li>
                        <li>
                           <a href="./library.html"
                              class="flex-y gap-3 px-3 py-16p hover:bg-primary text-l-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                              <span class="icon-28">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-bookmark">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 7v14l-6 -4l-6 4v-14a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4z" />
                                 </svg>
                              </span>
                              My Library
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="pt-20p">
                     <span class="text-s-medium text-w-neutral-1 mb-20p">
                     Get Help
                     </span>
                     <ul class="grid grid-cols-1 gap-y-3">
                        <li>
                           <a href="./contact-us.html"
                              class="flex-y gap-3 px-3 py-16p hover:bg-primary text-l-regular text-w-neutral-1 hover:text-b-neutral-4 rounded-12 justify-normal w-full transition-1">
                              <span class="icon-28">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
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
                              Get Help
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div>
                  <div class="rounded-24 overflow-hidden relative">
                     <button class="absolute top-3 right-3 btn-c size-8 btn-neutral-3 icon-16 z-[2]">
                     <i class="ti ti-x"></i>
                     </button>
                     <img class="w-full h-auto hover:scale-110 transition-1" src="./assets/images/seasons/session9.png"
                        alt="img" />
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
               </div>
            </div>
         </div>
         <!-- left sidebar end -->
         <!-- right sidebar start -->
         <div class="fixed top-0 right-0 lg:translate-x-0 translate-x-full h-screen z-10 pt-30 px-[27px] transition-1">
            <div class="flex flex-col items-center xxl:gap-[30px] xl:gap-6 lg:gap-5 gap-4">
               <div class="flex flex-col items-center gap-16p rounded-full w-fit p-2">
                  <div class="swiper infinity-slide-vertical messenger-carousel max-h-[288px] w-full">
                     <div class="swiper-wrapper">
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar1.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar2.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar3.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar4.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar1.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar2.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar3.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar4.png" alt="avatar">
                           </a>
                        </div>
                     </div>
                  </div>
                  <a href="#"
                     class="btn-c btn-c-xl bg-b-neutral-1 hover:bg-primary text-white hover:text-b-neutral-4 transition-1">
                  <i class="ti ti-plus"></i>
                  </a>
               </div>
               <div class="w-full h-1px bg-b-neutral-1"></div>
               <div class="flex flex-col items-center gap-16p rounded-full w-fit p-2">
                  <div class="swiper infinity-slide-vertical messenger-carousel max-h-[136px] w-full">
                     <div class="swiper-wrapper">
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar5.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar6.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar3.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar4.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar1.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar2.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar3.png" alt="avatar">
                           </a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#" class="avatar size-60p">
                           <img src="./assets/images/users/avatar4.png" alt="avatar">
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- right sidebar end -->
      </div>
      <!-- sidebar end -->
      <!-- app layout start -->
      <div class="min-h-screen lg:ml-[240px] lg:mr-[136px]">
         <!-- main start -->
         <main>
            <!-- hero section start -->
            <section class="section-pt overflow-visible">
               <div class="container relative pt-[30px]">
                  <div class="grid grid-cols-12 items-center gap-30p">
                     <div class="xxl:col-span-8 col-span-12">
                        <div class="relative">
                           <div class="swiper one-card-carousel rounded-12" data-carousel-name="home-two-hero">
                              <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                    <div class="w-full rounded-16 overflow-hidden relative">
                                       <img class="w-full lg:h-[506px] md:h-[440px] h-[380px] object-cover"
                                          src="./assets/images/photos/heroBanner7.webp" alt="product" />
                                       <div class="absolute inset-0 z-[2] p-30p">
                                          <div class="relative h-full">
                                             <div class="absolute top-0 flex items-center gap-3.5">
                                                <span
                                                   class="flex-c bg-secondary text-b-neutral-4 icon-24 size-40p rounded-full">
                                                <i class="ti ti-brand-windows"></i>
                                                </span>
                                                <span
                                                   class="flex-c bg-secondary text-b-neutral-4 icon-24 size-40p rounded-full">
                                                <i class="ti ti-brand-apple"></i>
                                                </span>
                                             </div>
                                             <div class="absolute bottom-0 w-full">
                                                <div class="text-center flex-c">
                                                   <h1 class="display-100 text-w-neutral-1 stroked-text-1 line-clamp-2 mb-30p"
                                                      data-text="Play. Win. Repeat">
                                                      Play. Win. Repeat
                                                   </h1>
                                                </div>
                                                <div
                                                   class=" flex items-center *:size-40p *:shrink-0 *:border *:border-white *:-ml-3 ml-3">
                                                   <img class="avatar"
                                                      src="./assets/images/users/user1.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user2.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user3.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user4.png" alt="user" />
                                                   <span
                                                      class="badge badge-ssm badge-primary border-none !whitespace-nowrap text-base !w-fit z-[2]">
                                                   + 75 Friends
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="overlay-1"></div>
                                    </div>
                                 </div>
                                 <div class="swiper-slide">
                                    <div class="w-full rounded-16 overflow-hidden relative">
                                       <img class="w-full lg:h-[506px] md:h-[440px] h-[380px] object-cover"
                                          src="./assets/images/photos/heroBanner8.webp" alt="product" />
                                       <div class="absolute inset-0 z-[2] p-30p">
                                          <div class="relative h-full">
                                             <div class="absolute top-0 flex items-center gap-3.5">
                                                <span
                                                   class="flex-c bg-secondary text-b-neutral-4 icon-24 size-40p rounded-full">
                                                <i class="ti ti-brand-windows"></i>
                                                </span>
                                                <span
                                                   class="flex-c bg-secondary text-b-neutral-4 icon-24 size-40p rounded-full">
                                                <i class="ti ti-brand-apple"></i>
                                                </span>
                                             </div>
                                             <div class="absolute bottom-0 w-full">
                                                <div class="text-center flex-c">
                                                   <h1 class="display-100 text-w-neutral-1 stroked-text-1 line-clamp-2 mb-30p"
                                                      data-text="Play. Win. Repeat">
                                                      Play. Win. Repeat
                                                   </h1>
                                                </div>
                                                <div
                                                   class=" flex items-center *:size-40p *:shrink-0 *:border *:border-white *:-ml-3 ml-3">
                                                   <img class="avatar"
                                                      src="./assets/images/users/user1.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user2.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user3.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user4.png" alt="user" />
                                                   <span
                                                      class="badge badge-ssm badge-primary border-none !whitespace-nowrap text-base !w-fit z-[2]">
                                                   + 75 Friends
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="overlay-1"></div>
                                    </div>
                                 </div>
                                 <div class="swiper-slide">
                                    <div class="w-full rounded-16 overflow-hidden relative">
                                       <img class="w-full lg:h-[506px] md:h-[440px] h-[380px] object-cover"
                                          src="./assets/images/photos/heroBanner9.webp" alt="product" />
                                       <div class="absolute inset-0 z-[2] p-30p">
                                          <div class="relative h-full">
                                             <div class="absolute top-0 flex items-center gap-3.5">
                                                <span
                                                   class="flex-c bg-secondary text-b-neutral-4 icon-24 size-40p rounded-full">
                                                <i class="ti ti-brand-windows"></i>
                                                </span>
                                                <span
                                                   class="flex-c bg-secondary text-b-neutral-4 icon-24 size-40p rounded-full">
                                                <i class="ti ti-brand-apple"></i>
                                                </span>
                                             </div>
                                             <div class="absolute bottom-0 w-full">
                                                <div class="text-center flex-c">
                                                   <h1 class="display-100 text-w-neutral-1 stroked-text-1 line-clamp-2 mb-30p"
                                                      data-text="Play. Win. Repeat">
                                                      Play. Win. Repeat
                                                   </h1>
                                                </div>
                                                <div
                                                   class=" flex items-center *:size-40p *:shrink-0 *:border *:border-white *:-ml-3 ml-3">
                                                   <img class="avatar"
                                                      src="./assets/images/users/user1.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user2.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user3.png" alt="user" />
                                                   <img class="avatar"
                                                      src="./assets/images/users/user4.png" alt="user" />
                                                   <span
                                                      class="badge badge-ssm badge-primary border-none !whitespace-nowrap text-base !w-fit z-[2]">
                                                   + 75 Friends
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="overlay-1"></div>
                                    </div>
                                 </div>
                              </div>
                              <div>
                                 <div
                                    class="swiper-pagination pagination-two home-two-hero-carousel-pagination items-center gap-2.5  pb-40p px-40p sm:flex justify-end hidden">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="xxl:col-span-4  col-span-12">
                        <div id="gallery-container" class="grid grid-cols-4 gap-24p">
                           <div class="col-span-4">
                              <div class="gallery-items relative rounded-32 overflow-hidden group">
                                 <img class="w-full xl:h-[312px] md:h-[280px] h-[220px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/photos/heroBanner4.webp" alt="Gallery Image 1" />
                                 <div class="overlay-3"></div>
                              </div>
                           </div>
                           <div class="col-span-2">
                              <div class="gallery-items relative rounded-32 overflow-hidden group">
                                 <img class="w-full md:h-[170px] h-[140px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/photos/heroBanner10.webp" alt="Gallery Image 2" />
                                 <div class="overlay-3"></div>
                              </div>
                           </div>
                           <div class="col-span-2">
                              <div class="gallery-items relative rounded-32 overflow-hidden group">
                                 <img class="w-full md:h-[170px] h-[140px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/photos/heroBanner11.webp" alt="Gallery Image 5" />
                                 <div class="overlay-3"></div>
                                 <div class="photo-counter">
                                    <h4>+270</h4>
                                    <h4>Photos</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- hero section end -->
            <!-- home 3 all games section start -->
            <section class="section-pt">
               <div class="container">
                  <div class="flex items-center justify-between flex-wrap gap-24p">
                     <h2 class="heading-2">
                        All Games
                     </h2>
                     <form class="select-1 shrink-0">
                        <select class="select w-full sm:py-3 py-2 px-24p rounded-full">
                           <option value="popular">Popular</option>
                           <option value="new-releases">New Releases</option>
                           <option value="action">Action</option>
                           <option value="adventure">Adventure</option>
                           <option value="sports">Sports</option>
                        </select>
                     </form>
                  </div>
                  <div class="mt-40p" data-aos="fade-up">
                     <div class="swiper four-card-carousel" data-carousel-name="all-games-one"
                        data-carousel-reverse="true">
                        <div class="swiper-wrapper pb-15">
                           <!-- Card 1 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game42.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    Mystic Puzzles Secrets of the Enchanted Labyrinth
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Gridiron Glory
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user27.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">David
                                          Smith</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 2 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game43.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    Secrets of the Enchanted Labyrinth
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Battle of Legends
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user28.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">Mamun
                                          Don</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 3 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game44.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    CosmicOdyssey Exploring Infinite Realms
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Navigate treacherous
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user29.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">Aderso
                                          Miller</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 4 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game45.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    CyberSoul: Awakening of the Machines
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Dive into a cyberpunk
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user20.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">Maxwall
                                          Miller</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 1 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game42.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    Mystic Puzzles Secrets of the Enchanted Labyrinth
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Gridiron Glory
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user27.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">David
                                          Smith</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 2 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game43.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    Secrets of the Enchanted Labyrinth
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Battle of Legends
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user28.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">Mamun
                                          Don</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 3 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game44.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    CosmicOdyssey Exploring Infinite Realms
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Navigate treacherous
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user29.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">Aderso
                                          Miller</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Card 4 -->
                           <div class="swiper-slide">
                              <div
                                 class="relative bg-b-neutral-3 rounded-24 group overflow-hidden w-full p-20p pb-24p pt-20p">
                                 <div class="relative overflow-hidden rounded-12">
                                    <span class="absolute top-3 right-3 badge badge-xs badge-danger gap-1 z-10">
                                    <i class="ti ti-wifi-2 icon-24"></i>
                                    Live
                                    </span>
                                    <img src="./assets/images/games/game45.png"
                                       class="w-full lg:h-[228px] md:h-[200px] h-[180px] object-cover object-top group-hover:scale-110 transition-1"
                                       alt="img" />
                                 </div>
                                 <div class="mt-20p">
                                    <a href="./live-stream.html" class="heading-4 link-1 mb-2 line-clamp-2">
                                    CyberSoul: Awakening of the Machines
                                    </a>
                                    <p class="text-l-regular text-w-neutral-2 mb-20p">
                                       Dive into a cyberpunk
                                    </p>
                                    <div class="flex-y gap-3">
                                       <img class="avatar size-60p shrink-0"
                                          src="./assets/images/users/user20.png" alt="user" />
                                       <div>
                                          <a href="./profile.html" class="flex-y gap-2 mb-1">
                                          <span
                                             class="span text-l-medium text-w-neutral-1 link-1 line-clamp-1 whitespace-nowrap">Maxwall
                                          Miller</span>
                                          <i class="ti ti-circle-check-filled text-secondary icon-24"></i>
                                          </a>
                                          <span class="text-s-medium text-w-neutral-3">
                                          Leader
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div
                           class="swiper-pagination pagination-one all-games-one-carousel-pagination flex-c gap-2.5">
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- home 3 all games section end -->
            <!-- Popular Games Two section start -->
            <section class="section-pt">
               <div class="container">
                  <div class="flex items-center justify-between flex-wrap gap-24p">
                     <h2 class="heading-2 text-w-neutral-1 text-split-left">
                        Popular Games
                     </h2>
                     <a href="./games.html" class="btn btn-lg py-3 btn-neutral-2 shrink-0">
                     View All
                     </a>
                  </div>
                  <div class="mt-40p" data-aos="fade-up">
                     <div class="swiper four-card-carousel" data-carousel-name="popular-games-one">
                        <div class="swiper-wrapper pb-15">
                           <!-- card 1 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game46.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Adrenaline Speedway
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 2 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game47.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Dawn of Civilization
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 3 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game48.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Journey to the Unknown
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 4 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game20.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Journey to the Unknown
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 1 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game46.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Adrenaline Speedway
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 2 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game47.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Dawn of Civilization
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 3 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game48.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Journey to the Unknown
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 4 -->
                           <div class="swiper-slide">
                              <div class="w-full bg-b-neutral-3 rounded-12 group">
                                 <div class="overflow-hidden rounded-t-12">
                                    <img class="w-full 4xl:h-[320px] xl:h-[280px] lg:h-[260px] sm:h-[220px] h-[200px] group-hover:scale-110 object-cover transition-1"
                                       src="./assets/images/games/game20.png" alt="game" />
                                 </div>
                                 <div class="p-20p">
                                    <a href="./game-details.html"
                                       class="heading-4 text-w-neutral-1 link-1 line-clamp-1 mb-20p">
                                    Journey to the Unknown
                                    </a>
                                    <div class="flex-y flex-wrap gap-20p">
                                       <span class="badge badge-md badge-primary text-base">
                                       20% OFF
                                       </span>
                                       <div class="badge badge-md badge-neutral-2">
                                          <span class="text-sm text-w-neutral-4 line-through">
                                          $75.09
                                          </span>
                                          <span class="text-l-medium text-w-neutral-1">
                                          $60.98
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div
                           class="swiper-pagination pagination-one popular-games-one-carousel-pagination flex-c gap-2.5">
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- Popular Games Two section end -->
            <!-- Twitch Streaming section start -->
            <section class="section-pt">
               <div class="container">
                  <div class="flex items-center justify-between flex-wrap gap-24p">
                     <h2 class="heading-2 text-w-neutral-1 text-split-left">
                        Twitch Streaming
                     </h2>
                     <form class="select-1 shrink-0">
                        <select class="select w-full sm:py-3 py-2 px-24p rounded-full">
                           <option value="popular">Popular</option>
                           <option value="new-releases">New Releases</option>
                           <option value="action">Action</option>
                           <option value="adventure">Adventure</option>
                           <option value="sports">Sports</option>
                        </select>
                     </form>
                  </div>
                  <div class="mt-40p">
                     <div class="grid 3xl:grid-cols-2 grid-cols-1 gap-30p">
                        <div>
                           <div class="swiper one-card-carousel rounded-32" data-carousel-name="twitch-streaming"
                              data-carousel-reverse="true">
                              <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                    <div class="relative rounded-32 overflow-hidden w-full group">
                                       <img class="w-full xl:h-[630px] md:h-[580px] sm:h-[500px] h-[420px] object-cover rounded-32 group-hover:scale-110 transition-1"
                                          src="./assets/images/photos/heroBanner11.webp" alt="img" />
                                       <div class="overlay-6 p-40p flex flex-col items-start justify-between">
                                          <span class="badge badge-lg badge-primary">
                                          430 Viewers
                                          </span>
                                          <div
                                             class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                             <a href="./live-stream.html"
                                                class="btn-c size-100p icon-40 bg-primary text-b-neutral-4">
                                             <i class="ti ti-player-play-filled"></i>
                                             </a>
                                          </div>
                                          <div class="w-full">
                                             <h2 class="heading-2 text-w-neutral-1 line-clamp-1 p-1 mb-20p">
                                                The Legend of Zelda: Breath of the Wild
                                             </h2>
                                             <div class="flex-y gap-3 text-sm text-w-neutral-1">
                                                <span class="px-24p py-3">
                                                English
                                                </span>
                                                <span class="px-24p py-3">
                                                Strumming
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="swiper-slide">
                                    <div class="relative rounded-32 overflow-hidden w-full group">
                                       <img class="w-full xl:h-[630px] md:h-[580px] sm:h-[500px] h-[420px] object-cover rounded-32 group-hover:scale-110 transition-1"
                                          src="./assets/images/photos/heroBanner4.webp" alt="img" />
                                       <div class="overlay-6 p-40p flex flex-col items-start justify-between">
                                          <span class="badge badge-lg badge-primary">
                                          270 Viewers
                                          </span>
                                          <div
                                             class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                             <a href="./live-stream.html"
                                                class="btn-c size-100p icon-40 bg-primary text-b-neutral-4">
                                             <i class="ti ti-player-play-filled"></i>
                                             </a>
                                          </div>
                                          <div class="w-full">
                                             <h2 class="heading-2 text-w-neutral-1 line-clamp-1 p-1 mb-20p">
                                                Fortnite - Hints to beat them all!
                                             </h2>
                                             <div class="flex-y gap-3 text-sm text-w-neutral-1">
                                                <span class="px-24p py-3">
                                                English
                                                </span>
                                                <span class="px-24p py-3">
                                                Strumming
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="swiper-slide">
                                    <div class="relative rounded-32 overflow-hidden w-full group">
                                       <img class="w-full xl:h-[630px] md:h-[580px] sm:h-[500px] h-[420px] object-cover rounded-32 group-hover:scale-110 transition-1"
                                          src="./assets/images/photos/heroBanner5.webp" alt="img" />
                                       <div class="overlay-6 p-40p flex flex-col items-start justify-between">
                                          <span class="badge badge-lg badge-primary">
                                          340 Viewers
                                          </span>
                                          <div
                                             class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                             <a href="./live-stream.html"
                                                class="btn-c size-100p icon-40 bg-primary text-b-neutral-4">
                                             <i class="ti ti-player-play-filled"></i>
                                             </a>
                                          </div>
                                          <div class="w-full">
                                             <h2 class="heading-2 text-w-neutral-1 line-clamp-1 p-1 mb-20p">
                                                The Legend of Zelda: Breath of the Wild
                                             </h2>
                                             <div class="flex-y gap-3 text-sm text-w-neutral-1">
                                                <span class="px-24p py-3">
                                                English
                                                </span>
                                                <span class="px-24p py-3">
                                                Strumming
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div
                                 class="swiper-navigation swp-navigation-one absolute top-0 right-0 z-[3] p-40p">
                                 <button type="button" class="navigation-btn-one twitch-streaming-carousel-prev">
                                 <i class="ti ti-chevron-left"></i>
                                 </button>
                                 <button type="button" class="navigation-btn-one twitch-streaming-carousel-next">
                                 <i class="ti ti-chevron-right"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="grid 3xl:grid-cols-1 md:grid-cols-2 grid-cols-1 gap-24p">
                           <div class="grid 3xl:grid-cols-2 grid-cols-1 gap-24p items-center p-20p bg-b-neutral-3 rounded-12 group"
                              data-aos="fade-up">
                              <div class="w-full xl:h-[264px] sm:h-[240px] h-[220px] overflow-hidden rounded-12">
                                 <img class="w-full xl:h-[264px] sm:h-[240px] h-[220px] group-hover:scale-110 object-cover rounded-12 transition-1"
                                    src="./assets/images/games/game50.png" alt="img" />
                              </div>
                              <div>
                                 <a href="./live-stream.html"
                                    class="heading-3 text-w-neutral-1 link-1 line-clamp-2 text-split-left">
                                 Odyssey through the Prism Realm
                                 </a>
                                 <div class="flex items-normal gap-3 my-20p">
                                    <div class="shrink-0 relative h-[70px] w-fit">
                                       <img class="avatar size-[60px]" src="./assets/images/users/user30.png"
                                          alt="user" />
                                       <span
                                          class="absolute md:-bottom-2 -bottom-0 left-1/2 -translate-x-1/2 badge px-2 py-1 badge-danger">
                                       Live
                                       </span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2">
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Online
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Action
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Shooter
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Strategy
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       PVP
                                       </span>
                                    </div>
                                 </div>
                                 <div class="flex items-center gap-3 *:btn-socal-accent-4 *:rounded-full">
                                    <a href="#">
                                    <i class="ti ti-brand-twitch"></i>
                                    </a>
                                    <a href="#">
                                    <i class="ti ti-brand-instagram"></i>
                                    </a>
                                    <a href="#">
                                    <i class="ti ti-brand-discord"></i>
                                    </a>
                                    <a href="#">
                                    <i class="ti ti-brand-youtube"></i>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="grid 3xl:grid-cols-2 grid-cols-1 gap-24p p-20p bg-b-neutral-3 rounded-12 group"
                              data-aos="fade-up">
                              <div class="w-full xl:h-[264px] sm:h-[240px] h-[220px] overflow-hidden rounded-12">
                                 <img class="w-full xl:h-[264px] sm:h-[240px] h-[220px] group-hover:scale-110 object-cover rounded-12 transition-1"
                                    src="./assets/images/games/game49.png" alt="img" />
                              </div>
                              <div>
                                 <a href="./live-stream.html"
                                    class="heading-3 text-w-neutral-1 link-1 line-clamp-2 text-split-left">
                                 Odyssey through the Prism Realm
                                 </a>
                                 <div class="flex items-normal gap-3 my-20p">
                                    <div class="shrink-0 relative h-[70px]">
                                       <img class="avatar size-[60px]" src="./assets/images/users/user30.png"
                                          alt="user" />
                                       <span
                                          class="absolute md:-bottom-2 -bottom-0 left-1/2 -translate-x-1/2 badge px-2 py-1 badge-danger">
                                       Live
                                       </span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2">
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Online
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Action
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Shooter
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       Strategy
                                       </span>
                                       <span class="badge badge-smm badge-neutral-2 font-normal">
                                       PVP
                                       </span>
                                    </div>
                                 </div>
                                 <div class="flex items-center gap-3 *:btn-socal-accent-4 *:rounded-full">
                                    <a href="#">
                                    <i class="ti ti-brand-twitch"></i>
                                    </a>
                                    <a href="#">
                                    <i class="ti ti-brand-instagram"></i>
                                    </a>
                                    <a href="#">
                                    <i class="ti ti-brand-discord"></i>
                                    </a>
                                    <a href="#">
                                    <i class="ti ti-brand-youtube"></i>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- Twitch Streaming section end -->
            <!--Top Rated section start -->
            <section class="section-py">
               <div class="container">
                  <div class="flex items-center justify-between flex-wrap gap-24p">
                     <h2 class="heading-2 text-w-neutral-1 text-split-left">
                        Top Rated
                     </h2>
                     <a href="./trending.html" class="btn btn-lg px-32p btn-neutral-2">
                     View All
                     </a>
                  </div>
                  <div class="mt-40p">
                     <div class="swiper three-card-carousel" data-carousel-name="top-rated-stream">
                        <div class="swiper-wrapper pb-15">
                           <!-- card 1 -->
                           <div class="swiper-slide">
                              <div class="relative rounded-12 overflow-hidden w-full group">
                                 <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/library/library1.png" alt="img" />
                                 <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                    <i class="ti ti-star icon-24 text-primary"></i>
                                    5.4
                                    </span>
                                    <div class="w-full">
                                       <a href="./live-stream.html"
                                          class="library-title heading-4 link-1 mb-2">
                                       Simulation Tycoon Urban Empire
                                       </a>
                                       <span class="text-l-regular text-w-neutral-2 mb-20p">17 Jan 2023</span>
                                       <div class="flex-y justify-between gap-16p">
                                          <a href="./live-stream.html"
                                             class="btn btn-md btn-danger rounded-12">
                                          Watch Now
                                          </a>
                                          <button class="btn-c btn-c-lg btn-primary">
                                          <i class="ti ti-plus"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 2 -->
                           <div class="swiper-slide">
                              <div class="relative rounded-12 overflow-hidden w-full group">
                                 <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/library/library7.png" alt="img" />
                                 <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                    <i class="ti ti-star icon-24 text-primary"></i>
                                    5.4
                                    </span>
                                    <div class="w-full">
                                       <a href="./live-stream.html"
                                          class="library-title heading-4 link-1 mb-2">
                                       Enchanted Puzzle Adventures
                                       </a>
                                       <span class="text-l-regular text-w-neutral-2 mb-20p">17 Jan 2023</span>
                                       <div class="flex-y justify-between gap-16p">
                                          <a href="./live-stream.html"
                                             class="btn btn-md btn-danger rounded-12">
                                          Watch Now
                                          </a>
                                          <button class="btn-c btn-c-lg btn-primary">
                                          <i class="ti ti-plus"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 3 -->
                           <div class="swiper-slide">
                              <div class="relative rounded-12 overflow-hidden w-full group">
                                 <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/library/library8.png" alt="img" />
                                 <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                    <i class="ti ti-star icon-24 text-primary"></i>
                                    5.4
                                    </span>
                                    <div class="w-full">
                                       <a href="./live-stream.html"
                                          class="library-title heading-4 link-1 mb-2">
                                       Whispering Shadows Haunting Nightmares
                                       </a>
                                       <span class="text-l-regular text-w-neutral-2 mb-20p">17 Jan 2023</span>
                                       <div class="flex-y justify-between gap-16p">
                                          <a href="./live-stream.html"
                                             class="btn btn-md btn-danger rounded-12">
                                          Watch Now
                                          </a>
                                          <button class="btn-c btn-c-lg btn-primary">
                                          <i class="ti ti-plus"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 1 -->
                           <div class="swiper-slide">
                              <div class="relative rounded-12 overflow-hidden w-full group">
                                 <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/library/library1.png" alt="img" />
                                 <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                    <i class="ti ti-star icon-24 text-primary"></i>
                                    5.4
                                    </span>
                                    <div class="w-full">
                                       <a href="./live-stream.html"
                                          class="library-title heading-4 link-1 mb-2">
                                       Simulation Tycoon Urban Empire
                                       </a>
                                       <span class="text-l-regular text-w-neutral-2 mb-20p">17 Jan 2023</span>
                                       <div class="flex-y justify-between gap-16p">
                                          <a href="./live-stream.html"
                                             class="btn btn-md btn-danger rounded-12">
                                          Watch Now
                                          </a>
                                          <button class="btn-c btn-c-lg btn-primary">
                                          <i class="ti ti-plus"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 2 -->
                           <div class="swiper-slide">
                              <div class="relative rounded-12 overflow-hidden w-full group">
                                 <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/library/library7.png" alt="img" />
                                 <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                    <i class="ti ti-star icon-24 text-primary"></i>
                                    5.4
                                    </span>
                                    <div class="w-full">
                                       <a href="./live-stream.html"
                                          class="library-title heading-4 link-1 mb-2">
                                       Enchanted Puzzle Adventures
                                       </a>
                                       <span class="text-l-regular text-w-neutral-2 mb-20p">17 Jan 2023</span>
                                       <div class="flex-y justify-between gap-16p">
                                          <a href="./live-stream.html"
                                             class="btn btn-md btn-danger rounded-12">
                                          Watch Now
                                          </a>
                                          <button class="btn-c btn-c-lg btn-primary">
                                          <i class="ti ti-plus"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- card 3 -->
                           <div class="swiper-slide">
                              <div class="relative rounded-12 overflow-hidden w-full group">
                                 <img class="w-full h-[300px] group-hover:scale-110 object-cover transition-1"
                                    src="./assets/images/library/library8.png" alt="img" />
                                 <div class="overlay-6 p-20p flex flex-col items-start justify-between">
                                    <span class="badge badge-compact badge-glass flex-y gap-1 text-w-neutral-1">
                                    <i class="ti ti-star icon-24 text-primary"></i>
                                    5.4
                                    </span>
                                    <div class="w-full">
                                       <a href="./live-stream.html"
                                          class="library-title heading-4 link-1 mb-2">
                                       Whispering Shadows Haunting Nightmares
                                       </a>
                                       <span class="text-l-regular text-w-neutral-2 mb-20p">17 Jan 2023</span>
                                       <div class="flex-y justify-between gap-16p">
                                          <a href="./live-stream.html"
                                             class="btn btn-md btn-danger rounded-12">
                                          Watch Now
                                          </a>
                                          <button class="btn-c btn-c-lg btn-primary">
                                          <i class="ti ti-plus"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div
                           class="swiper-pagination pagination-one top-rated-stream-carousel-pagination flex-c gap-2.5">
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- Top Rated section start -->
         </main>
         <!-- main end -->
         <!-- video popup modal start -->
         <!-- Modal -->
         <div id="modal" class="fixed inset-0 items-center justify-center z-[999] hidden">
            <!-- Modal Backdrop -->
            <div id="modal-backdrop" class="video-modal-backdrop"></div>
            <!-- Modal Content -->
            <div class="relative z-[999] rounded-lg w-full lg:max-w-screen-md max-w-screen-sm h-auto sm:mx-6 mx-5">
               <!-- Modal Body -->
               <div class="modal-body relative">
                  <!-- Close Button -->
                  <button id="modal-close-btn"
                     class="absolute -top-5 -right-5 text-b-neutral-4 sm:size-9 size-7 flex justify-center items-center rounded-full bg-primary transition-1">
                  <i class="ti ti-x icon-24"></i>
                  </button>
                  <iframe class="w-full lg:h-[420px] sm:h-[320px] xsm:h-[260px] h-[220px] border-none"
                     title="YouTube video player"
                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                     referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                  </iframe>
               </div>
            </div>
         </div>
         <!-- video popup modal end -->
         <!-- footer start -->
         <footer class="section-pt overflow-hidden bg-b-neutral-3">
            <div class="container relative">
               <div class="relative z-10 lg:mx-60p">
                  <div class="grid grid-cols-12 gap-24p">
                     <div class="xl:col-span-5 col-span-12">
                        <div class="max-w-[364px]">
                           <a href="./index.html" class="heading-4 text-w-neutral-1 inline-flex gap-20p mb-24p">
                           <img src="./assets/images/icons/brand.svg" alt="logo" />
                           Get In Touch
                           </a>
                           <h2 class="display-4 text-w-neutral-1 mb-16p">
                              Subscribe Now.
                           </h2>
                           <p class="text-base text-w-neutral-3">
                              Become visionary behind a sprawling. metropolis Metropolis Tycoon.
                           </p>
                        </div>
                     </div>
                     <div class="xl:col-span-7 col-span-12 flex items-end">
                        <form class="w-full flex items-end gap-24p">
                           <div class="w-full">
                              <label for="subscribeEmail" class="heading-4 text-w-neutral-1 mb-24p">
                              Email address
                              </label>
                              <input type="email" placeholder="Enter your email" name="subscribeEmail" id="subscribeEmail"
                                 required
                                 class="w-full bg-transparent border-b border-shap pb-16p text-base text-w-neutral-1 placeholder:text-w-neutral-3" />
                           </div>
                           <button type="submit"
                              class="shrink-0 xl:size-[140px] md:size-30 size-28 rounded-full sm:flex-c hidden text-m-medium btn-primary">
                           <span>
                           Now
                           <i class="ti ti-arrow-up-right icon-24"></i>
                           Subscribe
                           </span>
                           </button>
                        </form>
                     </div>
                  </div>
                  <div
                     class="grid xl:grid-cols-4 xsm:grid-cols-2 grid-cols-1 gap-x-30p gap-y-40p border-b-2 border-dashed border-shap py-60p">
                     <div>
                        <h4 class="heading-4 text-w-neutral-1 mb-32p">
                           Quick Link
                        </h4>
                        <ul
                           class="grid grid-cols-1 sm:gap-y-16p gap-y-2 gap-x-32p *:flex *:items-center text-base font-poppins">
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./library.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              My Library
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./leaderboard.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Leaderboards
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./trending.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Trending
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./shop.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Shop
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./marketplace-two.html"
                                 class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Marketplace
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div>
                        <h4 class="heading-4 text-w-neutral-1 mb-32p">
                           EXPLORE
                        </h4>
                        <ul
                           class="grid grid-cols-1 sm:gap-y-16p gap-y-2 gap-x-32p *:flex *:items-center text-base font-poppins">
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./trending.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Trending
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./chat.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Chat
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./shop.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Shop
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./news.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              News
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div>
                        <h4 class="heading-4 text-w-neutral-1 mb-32p">
                           Follow Us
                        </h4>
                        <ul
                           class="grid grid-cols-1 sm:gap-y-16p gap-y-2 gap-x-32p *:flex *:items-center text-base font-poppins">
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./tournaments.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Tournaments
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="community.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Community
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="#" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Notifications
                              </a>
                           </li>
                           <li
                              class="group hover:translate-x-0 -translate-x-5 inline-flex items-center gap-1 hover:text-primary transition-1 max-w-fit">
                              <i
                                 class="ti ti-chevron-right  group-hover:visible invisible text-primary group-hover:opacity-100 opacity-0 transition-1"></i>
                              <a href="./contact-us.html" class="text-w-neutral-3 group-hover:text-primary transition-1">
                              Contact
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div>
                        <h4 class="heading-4 text-w-neutral-1 mb-32p">
                           Follow Us
                        </h4>
                        <p class="text-base text-w-neutral-3 mb-3 max-w-[230px] w-full">
                           4517 Washington Ave. Manchester, Kentucky 39495
                        </p>
                        <span class="text-m-medium text-primary mb-60p">
                        #London
                        </span>
                        <div class="flex items-center gap-3">
                           <a href="#" class="btn-socal-primary">
                           <i class="ti ti-brand-facebook"></i>
                           </a>
                           <a href="#" class="btn-socal-primary">
                           <i class="ti ti-brand-twitch"></i>
                           </a>
                           <a href="#" class="btn-socal-primary">
                           <i class="ti ti-brand-instagram"></i>
                           </a>
                           <a href="#" class="btn-socal-primary">
                           <i class="ti ti-brand-discord"></i>
                           </a>
                           <a href="#" class="btn-socal-primary">
                           <i class="ti ti-brand-youtube"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="flex items-center justify-center text-center flex-wrap gap-y-3 py-30p">
                     <p class="text-base text-w-neutral-3">
                        Copyright ©
                        <span class="currentYear span"></span>
                     </p>
                     <div class="w-1px h-4 bg-shap mx-3"></div>
                     <p class="text-base text-w-neutral-3">
                        Designed By
                        <a href="https://themeforest.net/user/uiaxis/portfolio" class="text-primary hover:underline a">
                        UIAXIS</a>
                     </p>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer end -->
      </div>
      <!-- app layout end -->
   </body>
</html>