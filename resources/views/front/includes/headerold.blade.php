<body>
    <style>
        .nice-select.currency-manager {
            display: none !important;
        }
        #global-country.currency-manager {
            display: block !important;
        }
    </style>
    <header class="header">
        <div class="container">
            <div class="row v-center">
                <div class="header-item item-left">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <!-- <img src="{{ asset('uploads/settings/' . $footerData['settings']['Site.logo']) }}"> -->
                            @if(!empty($footerData['settings']['Site.logo']))
                                <img src="{{ asset('uploads/settings/' . $footerData['settings']['Site.logo']) }}" alt="Site Logo">
                            @else
                                <img src="{{ asset('uploads/settings/default-logo.png') }}" alt="Default Logo">
                            @endif
                        </a>
                    </div>
                </div>
                <!-- menu start here -->
                <div class="header-item item-center">
                    <div class="menu-overlay"></div>
                    <nav class="menu">
                        <div class="mobile-menu-head">
                            <div class="go-back"><i class="fa fa-angle-left"></i></div>
                            <div class="current-menu-title"></div>
                            <div class="mobile-menu-close">&times;</div>
                        </div>
                        <ul class="menu-main">
                            <li>
                            <a href="/">Home</a>
                            </li> 
                       
                            @foreach($all_categories as $all_categorie)
                                @php
                                    $subcategories = $all_categorie->subcategories;
                                    $showMegaMenu = $subcategories->count() > 4 && $subcategories->every(fn($sub) => $sub->subcategories->count() > 0);
                                @endphp

                                <li data-has-children="1" class="menu-item-has-children">
                                    {{-- CATEGORY CLICK --}}
                                    <a href="{{ getSmartCategoryUrl('category', $all_categorie) }}">
                                        {{ $all_categorie->name }}
                                        @if($subcategories->count() > 0)
                                            <i class="fa fa-angle-down"></i>
                                        @endif
                                    </a>

                                    @if($subcategories->count() > 0)
                                        @if($showMegaMenu)
                                            {{-- MEGA MENU --}}
                                            <div class="full-page-mega-menu">
                                                <div class="sub-menu mega-menu mega-menu-column-4">
                                                    @foreach($subcategories as $subcategory)
                                                        <div class="list-item {{ $subcategory->subcategories->count() > 0 ? 'has-children' : '' }}">
                                                            <h4 class="title">
                                                                <a href="{{ getSmartCategoryUrl('subcategory', $all_categorie, $subcategory) }}">
                                                                    <b>{{ $subcategory->name }}</b>
                                                                </a>
                                                            </h4>

                                                            @if($subcategory->subcategories->count() > 0)
                                                                <ul class="child-list">
                                                                    @foreach($subcategory->subcategories as $child)
                                                                        <li>
                                                                            <a href="{{ getSmartCategoryUrl('child', $all_categorie, $subcategory, $child) }}">
                                                                                {{ $child->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                         @else
                                            {{-- SIMPLE DROPDOWN --}}
                                            <ul class="sub-menu small-menu">
                                                @foreach($subcategories as $subcategory)
                                                    <li class="{{ $subcategory->subcategories->count() > 0 ? 'has-children' : '' }}"
                                                        @if($subcategory->subcategories->count() > 0) style="position: relative;" @endif
                                                    >
                                                        <a href="{{ getSmartCategoryUrl('subcategory', $all_categorie, $subcategory) }}">
                                                            {{ $subcategory->name }}
                                                        </a>

                                                        @if($subcategory->subcategories->count() > 0)
                                                            <ul class="child-list"
                                                                style="display: none; position: absolute; top: 0; left: 100%; background: #fff; padding: 0px 15px; box-shadow: 0 0 8px rgba(0,0,0,0.15); min-width: 180px; z-index: 99; border-radius: 4px;">
                                                                @foreach($subcategory->subcategories as $child)
                                                                    <li style="padding: 5px 0;">
                                                                        <a href="{{ getSmartCategoryUrl('child', $all_categorie, $subcategory, $child) }}"
                                                                        style="text-decoration: none; color: #333; font-size: 14px; display: block;">
                                                                            {{ $child->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            
                                        @endif
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </nav>
                </div>
                <!-- menu end here -->
                <div class="header-item item-right">
                    <div class="flex items-center">
                        <!-- <label for="global-country" class="text-gray-600">Select Country:</label> -->
                        <select id="global-country" class="currency-manager p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>Cur</option>
                            <option value="US">USD ($)</option>
                            <option value="IN">INR (₹)</option>
                            <option value="GB">GBR (£)</option>
                            <option value="AU">AUS (A$)</option>
                            <option value="CA">CAS (C$)</option>
                            
                        </select>
                    </div>
                    
                    @if(Auth::guard('customer')->check())
                        <a href="{{ route('front-user.logout') }}" class="login-btn">
                            <svg aria-hidden="true" fill="none" focusable="false" width="24" class="header__nav-icon icon icon-account" viewBox="0 0 24 24">
                                <path d="M16.125 8.75c-.184 2.478-2.063 4.5-4.125 4.5s-3.944-2.021-4.125-4.5c-.187-2.578 1.64-4.5 4.125-4.5 2.484 0 4.313 1.969 4.125 4.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M3.017 20.747C3.783 16.5 7.922 14.25 12 14.25s8.217 2.25 8.984 6.497" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></path>
                            </svg>
                            <p>Logout</p>
                            <img src="{{ asset('assets/front/img/header-icon/chevron_down.svg') }}">
                        </a>
                    @else
                        <a href="/front/login" class="login-btn">
                            <svg aria-hidden="true" fill="none" focusable="false" width="24" class="header__nav-icon icon icon-account" viewBox="0 0 24 24">
                                <path d="M16.125 8.75c-.184 2.478-2.063 4.5-4.125 4.5s-3.944-2.021-4.125-4.5c-.187-2.578 1.64-4.5 4.125-4.5 2.484 0 4.313 1.969 4.125 4.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M3.017 20.747C3.783 16.5 7.922 14.25 12 14.25s8.217 2.25 8.984 6.497" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></path>
                            </svg>
                            <p>Login</p>
                            <img src="{{ asset('assets/front/img/header-icon/chevron_down.svg') }}">
                        </a>
                    @endif
                    <a href="#" data-bs-toggle="modal" data-bs-target="#rightToLeftModal">
                        <svg aria-hidden="true" fill="none" focusable="false" width="24" class="header__nav-icon icon icon-search" viewBox="0 0 24 24">
                            <path d="M10.364 3a7.364 7.364 0 1 0 0 14.727 7.364 7.364 0 0 0 0-14.727Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></path>
                            <path d="M15.857 15.858 21 21.001" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"></path>
                        </svg>
                    </a>
                    <a href="#" class="heart-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="wlh-svg-Icon wlh-svg-icon-heart-empty" style="width:1em;font-size:22px;">
                            <path d="M29.728 10.656q0-1.472-0.384-2.56t-0.992-1.76-1.472-1.056-1.664-0.576-1.76-0.128-1.984 0.448-1.984 1.152-1.536 1.28-1.088 1.088q-0.32 0.416-0.864 0.416t-0.864-0.416q-0.448-0.48-1.088-1.088t-1.536-1.28-1.984-1.152-1.984-0.448-1.76 0.128-1.664 0.576-1.472 1.056-0.992 1.76-0.384 2.56q0 2.976 3.36 6.336l10.368 9.984 10.368-9.984q3.36-3.36 3.36-6.336zM32 10.656q0 3.936-4.096 8.032l-11.104 10.72q-0.32 0.32-0.8 0.32t-0.8-0.32l-11.136-10.752q-0.16-0.16-0.48-0.48t-0.992-1.184-1.216-1.728-0.96-2.144-0.416-2.464q0-3.936 2.272-6.144t6.272-2.24q1.088 0 2.24 0.384t2.144 1.056 1.728 1.216 1.344 1.216q0.64-0.64 1.344-1.216t1.728-1.216 2.144-1.056 2.24-0.384q4 0 6.272 2.24t2.272 6.144z"></path>
                        </svg>
                    </a>
                    <a href="#">
                        <svg aria-hidden="true" fill="none" focusable="false" width="24" class="header__nav-icon icon icon-cart" viewBox="0 0 24 24">
                            <path d="M4.75 8.25A.75.75 0 0 0 4 9L3 19.125c0 1.418 1.207 2.625 2.625 2.625h12.75c1.418 0 2.625-1.149 2.625-2.566L20 9a.75.75 0 0 0-.75-.75H4.75Zm2.75 0v-1.5a4.5 4.5 0 0 1 4.5-4.5v0a4.5 4.5 0 0 1 4.5 4.5v1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <!-- mobile menu trigger -->
                    <div class="mobile-menu-trigger">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <style>
        .menu-item-has-children > ul.sub-menu > li.has-children:hover > .child-list {
            display: block !important;
        }
    </style>