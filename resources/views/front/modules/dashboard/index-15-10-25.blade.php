@extends('front.layouts.app')
@section('content')
    <section class="banner-section">
        <div class="banner-inner">
            <div class="shape1"><img src="{{ asset('assets/front/img/breadcumb-shape1_1.png') }}" alt="shape" /></div>
            <div class="shape2"><img src="{{ asset('assets/front/img/breadcumb-shape1_2.png') }}" alt="shape" /></div>
            <div class="shape3"><img src="{{ asset('assets/front/img/breadcumb-shape1_3.png') }}" alt="shape" /></div>
            <div class="shape4"><img src="{{ asset('assets/front/img/breadcumb-shape1_4.png') }}" alt="shape" /></div>
            <div class="container">
                <div class="banner-text">
                    <h1>My Account</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- page main wrapper start -->
    <section class="my-account section-space">
        <div class="container">

            <div class="my-account-tabs">
                <div class="tab_left_list">
                    <div class="myaccout-box-item">
                        <div class="myaccout-box-wrap">
                            <div class="user-intro myaccout-box-body">
                                @php
                                    $avlWallet = Auth::guard('customer')->user()->wallet_avl_balance;
                                @endphp
                                <div class="user-icon"> <img
                                        src="{{ $user->image ? $user->image : 'https://via.placeholder.com/150' }}"
                                        alt=""> </div>
                                <div class="user-info">
                                    <small>Hello,</small>
                                    <p>{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="myaccout-box-body">
                                <h4 class="mb-0"><strong>Wallet Balance Rs {{ $avlWallet }}.</strong></h4>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs coustom-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ request()->page != 'wishlist' ? 'active' : '' }}" id="tab001"
                                data-bs-toggle="tab" data-bs-target="#tab01" type="button" role="tab"
                                aria-controls="home-tab-pane" aria-selected="true">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"
                                        viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="60.411" x2="451.592" y1="535.378"
                                                y2="144.197" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)"
                                                d="M511.982 467.632A255.486 255.486 0 0 0 386.2 258.42a16 16 0 0 0-18.332 1.438 175.795 175.795 0 0 1-223.735 0 16 16 0 0 0-18.332-1.438A255.482 255.482 0 0 0 .018 467.632a16 16 0 0 0 12.227 16.262C89.456 502.543 171.468 512 256 512s166.544-9.456 243.755-28.105a16 16 0 0 0 12.227-16.263zM256 480c-77.194 0-152.16-8.113-223.044-24.127a223.441 223.441 0 0 1 99.968-164.2 207.813 207.813 0 0 0 246.155 0 223.445 223.445 0 0 1 99.965 164.194C408.16 471.886 333.194 480 256 480zm0-231.451a124.274 124.274 0 1 0-124.271-124.274A124.414 124.414 0 0 0 256 248.548zM256 32a92.274 92.274 0 1 1-92.274 92.274A92.378 92.378 0 0 1 256 32z"
                                                opacity="1" data-original="url(#a)" class=""></path>
                                        </g>
                                    </svg>
                                </i>
                                Profile <img class="arrow-indi" src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab002" data-bs-toggle="tab" data-bs-target="#tab02"
                                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"
                                        viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="46.051" x2="465.949" y1="459.395"
                                                y2="39.497" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)"
                                                d="M500.247 76.751 223.573.574a15.993 15.993 0 0 0-13.029 2.051L7.218 136.141A16 16 0 0 0 0 149.515v257.201a16 16 0 0 0 11.217 15.269l285.011 89.284a16.004 16.004 0 0 0 14.399-2.481l194.989-146.623A15.998 15.998 0 0 0 512 349.377v-257.2a16 16 0 0 0-11.753-15.426zm-278.19-43.403 238.302 65.611-65.043 48.91L155.32 77.171zm75.902 187.728-244.938-76.73L120.25 100.2l243.189 71.639zM32 171.294l253.012 79.26v223.668L32 394.961zm285.012 292.655V246.787L480 124.228V341.39z"
                                                opacity="1" data-original="url(#a)" class=""></path>
                                        </g>
                                    </svg>
                                </i>
                                Orders<img class="arrow-indi" src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  {{ request()->page == 'wishlist' ? 'active' : '' }}" id="tab003"
                                data-bs-toggle="tab" data-bs-target="#tab03" type="button" role="tab"
                                aria-controls="contact-tab-pane" aria-selected="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0"
                                        y="0" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="92.286" x2="419.713" y1="353.808"
                                                y2="26.38" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)"
                                                d="M489.864 101.097c-14.441-22.827-35.245-40.424-60.161-50.887-28.112-11.806-59.688-13.925-91.31-6.127-28.98 7.146-57.207 22.644-82.394 45.129-25.189-22.487-53.418-37.986-82.4-45.131-31.623-7.795-63.197-5.674-91.312 6.134-24.917 10.466-45.72 28.066-60.16 50.897C7.107 124.859-.534 153.734.03 184.615 2.534 321.896 207.036 446.737 248.006 470.37c2.474 1.427 5.233 2.141 7.994 2.141s5.521-.713 7.995-2.141c40.974-23.636 245.494-148.495 247.976-285.779.558-30.879-7.086-59.751-22.107-83.494zm-9.887 82.916c-.803 44.389-30.39 96.139-85.563 149.656-51.095 49.56-109.215 86.914-138.414 104.295-29.196-17.377-87.31-54.727-138.405-104.287-55.171-53.512-84.761-105.259-85.57-149.646-.885-48.467 22.538-87.462 62.655-104.313 13.188-5.539 27.188-8.238 41.512-8.238 36.795 0 75.717 17.812 108.401 51.046a15.996 15.996 0 0 0 22.815 0c45.406-46.17 102.85-62.573 149.905-42.812 40.114 16.846 63.54 55.835 62.664 104.299z"
                                                opacity="1" data-original="url(#a)" class=""></path>
                                        </g>
                                    </svg>
                                </i>
                                Wishlist <img class="arrow-indi" src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ctab004" data-bs-toggle="tab" data-bs-target="#tab04"
                                type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0"
                                        y="0" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="48.07" x2="484.811" y1="474.37"
                                                y2="37.63" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)"
                                                d="M440.553 0H107.034a51.645 51.645 0 0 0-51.586 51.586v408.828A51.645 51.645 0 0 0 107.033 512h333.52a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16zm-16 408.829H162.529V32h262.024zM107.034 32h23.495v376.829h-23.5a51.3 51.3 0 0 0-19.582 3.871V51.586A19.608 19.608 0 0 1 107.034 32zm0 448a19.586 19.586 0 1 1 0-39.171h317.52V480zM209.9 220.415a16 16 0 0 1 16-16h135.277a16 16 0 0 1 0 32H225.9a16 16 0 0 1-16-16zm167.273 90.752a16 16 0 0 1-16 16H225.9a16 16 0 1 1 0-32h135.277a16 16 0 0 1 16 16zM209.9 129.661a16 16 0 0 1 16-16h135.277a16 16 0 0 1 0 32H225.9a16 16 0 0 1-16-16z"
                                                opacity="1" data-original="url(#a)" class=""></path>
                                        </g>
                                    </svg>
                                </i>
                                Address Book <img class="arrow-indi"
                                    src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                        <!--<li class="nav-item" role="presentation">-->
                        <!--    <button class="nav-link" id="ctab005" data-bs-toggle="tab" data-bs-target="#tab05"-->
                        <!--        type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">-->
                        <!--        <i>-->
                        <!--            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"-->
                        <!--                xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"-->
                        <!--                viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"-->
                        <!--                xml:space="preserve" class="">-->
                        <!--                <g>-->
                        <!--                    <linearGradient id="a" x1="76.23" x2="418.52" y1="456.689"-->
                        <!--                        y2="114.399" gradientUnits="userSpaceOnUse">-->
                        <!--                        <stop offset="0" stop-color="#fcc60e"></stop>-->
                        <!--                        <stop offset="1" stop-color="#e92e29"></stop>-->
                        <!--                    </linearGradient>-->
                        <!--                    <path fill="url(#a)"-->
                        <!--                        d="M511.496 365.717c-2.914-29.978-18.264-57.261-43.222-76.824-9.626-7.545-20.558-13.851-32.613-18.873V134.854a7.998 7.998 0 0 0-4-6.928L221.831 6.781a8 8 0 0 0-8 0L4.001 127.926a7.998 7.998 0 0 0-4 6.928v242.291a7.998 7.998 0 0 0 4 6.928l209.83 121.145a8 8 0 0 0 8 0l209.83-121.145a7.986 7.986 0 0 0 3.493-4.168c5.458 7.042 9.238 14.936 11.023 23.256 6.598 30.738-13.282 60.623-51.881 77.992a8.001 8.001 0 0 0 3.277 15.296c.511 0 1.028-.049 1.546-.151 37.033-7.267 67.343-24.495 87.652-49.822 18.736-23.361 27.516-52.042 24.725-80.759zM217.831 246.762l-58.49-33.769 193.83-111.908 58.49 33.769zM98.49 177.861 292.32 65.953l44.851 25.895-193.83 111.908zm36.852 39.751-.001 76.934-44.85-25.894-.001-76.935zm82.489-194.665 58.489 33.769L82.49 168.623l-58.489-33.769zM16.001 148.711 74.49 182.48l.001 90.791a7.998 7.998 0 0 0 4 6.928l60.85 35.131a8 8 0 0 0 12-6.928l.001-81.552 58.489 33.769v223.816L16.001 372.527zm209.83 335.723V260.619l193.83-111.908v115.597c-16.639-5.019-35.004-7.89-54.733-8.498v-25.873a7.999 7.999 0 0 0-13.135-6.135l-92.489 77.41a8.002 8.002 0 0 0 .403 12.585l92.489 67.855a7.999 7.999 0 0 0 12.733-6.45v-26.896c21.185 1.138 39.795 6.837 54.196 16.654.183.125.356.257.537.383v7.184zm221.106-23.515a86.164 86.164 0 0 0 5.423-7.957c10.064-16.727 13.336-35.109 9.462-53.158-4.07-18.963-16.033-36.033-33.686-48.066-18.855-12.852-43.479-19.646-71.208-19.646a8 8 0 0 0-8 8v19.317l-71.53-52.479 71.53-59.867v16.623a8 8 0 0 0 8 8c95.478 0 134.358 51.486 138.644 95.576 3.139 32.311-11.576 69.954-48.635 93.657z"-->
                        <!--                        opacity="1" data-original="url(#a)" class=""></path>-->
                        <!--                </g>-->
                        <!--            </svg>-->
                        <!--        </i>-->
                        <!--        Return Request <img class="arrow-indi"-->
                        <!--            src="{{ asset('assets/front/img/arrow-right.png') }}" />-->
                        <!--    </button>-->
                        <!--</li>-->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ctab006" data-bs-toggle="tab" data-bs-target="#tab06"
                                type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0"
                                        y="0" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="52.971" x2="446.307" y1="520.574"
                                                y2="127.238" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)" fill-rule="evenodd"
                                                d="M392.464 337.423c7.002 0 12.712 5.696 12.712 12.692 0 6.994-5.71 12.682-12.712 12.682-6.976 0-12.685-5.688-12.685-12.682 0-6.996 5.708-12.692 12.685-12.692zm-26.097 12.692c0 14.399 11.714 26.111 26.096 26.111 14.408 0 26.124-11.712 26.124-26.111 0-14.409-11.716-26.118-26.124-26.118-14.382 0-26.096 11.709-26.096 26.118zM57.351 490.959h433.603v-74.225H386.027c-36.762 0-66.63-29.886-66.63-66.619 0-36.735 29.868-66.626 66.63-66.626h104.926v-78.556H57.351c-14.301 0-27.229-6.072-36.304-15.784v265.502c-.001 20.027 16.294 36.308 36.304 36.308zm0-372.067h47.912l-41.934 72.614h-5.978c-20.01 0-36.304-16.281-36.304-36.307-.001-20.016 16.294-36.307 36.304-36.307zm189.573 9.189c1.805 6.704 5.493 12.593 10.611 17.067l-26.743 46.358H121.88l53.998-93.512c6.437 2.211 13.386 2.453 20.09.659a34.264 34.264 0 0 0 17.075-10.614l34.554 19.938c-2.208 6.441-2.451 13.38-.673 20.104zm-71.1-104.584 146.266 84.442-48.262 83.567h-27.551l25.935-44.904a6.715 6.715 0 0 0 .673-5.093 6.72 6.72 0 0 0-3.124-4.074c-4.901-2.826-8.403-7.374-9.856-12.836-1.454-5.453-.727-11.149 2.1-16.041a6.707 6.707 0 0 0-2.451-9.167l-45.057-26.014a6.706 6.706 0 0 0-5.089-.678 6.701 6.701 0 0 0-4.066 3.133c-2.827 4.889-7.38 8.393-12.847 9.848-5.467 1.464-11.15.707-16.052-2.104a6.686 6.686 0 0 0-9.156 2.454l-60.892 105.475H78.842zm100.483.329 119.415 119.411-48.288 48.27h-58.093l47.723-82.665a6.71 6.71 0 0 0-2.451-9.17l-85.051-49.105zm138.726 95.066v72.614h-48.612l43.548-43.525a6.727 6.727 0 0 0 0-9.491l-19.606-19.599h24.67zm75.921 284.413v-106.39H386.027c-29.357 0-53.218 23.87-53.218 53.2 0 29.331 23.862 53.19 53.218 53.19zm6.733-211.799h-69.216v-79.328c0-3.705-3.016-6.713-6.705-6.713h-44.842L281.047 9.583a6.733 6.733 0 0 0-9.508 0L237.525 43.61 176.74 8.514a6.73 6.73 0 0 0-9.184 2.457l-54.536 94.493H57.351c-27.416 0-49.742 22.316-49.742 49.735V454.65c0 27.419 22.326 49.735 49.742 49.735h440.336c3.689 0 6.705-3.008 6.705-6.715V198.22c0-3.706-3.016-6.714-6.705-6.714z"
                                                clip-rule="evenodd" opacity="1" data-original="url(#a)"
                                                class="">
                                            </path>
                                        </g>
                                    </svg>
                                </i>
                                Vasvi Wallet <img class="arrow-indi"
                                    src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ctab007" data-bs-toggle="tab" data-bs-target="#tab07"
                                type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0"
                                        y="0" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="104.389" x2="407.61" y1="420.631"
                                                y2="117.411" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)"
                                                d="M411.656 368.601c-20.471 25.956-47.277 46.543-77.521 59.533a8 8 0 0 1-10.507-4.194 8 8 0 0 1 4.193-10.508c27.802-11.941 52.447-30.87 71.272-54.74a8.001 8.001 0 0 1 12.563 9.909zM99.529 137.655a7.958 7.958 0 0 0 4.826 1.624 7.986 7.986 0 0 0 6.382-3.169c19.105-25.213 44.501-45.111 73.443-57.543a8 8 0 0 0 4.193-10.508 7.999 7.999 0 0 0-10.508-4.193c-31.483 13.523-59.105 35.164-79.88 62.582a7.998 7.998 0 0 0 1.544 11.207zM327.82 78.567c28.941 12.432 54.337 32.33 73.441 57.544a7.987 7.987 0 0 0 6.382 3.169 8 8 0 0 0 6.371-12.831c-20.775-27.419-48.396-49.06-79.878-62.583a8 8 0 0 0-10.508 4.193 7.998 7.998 0 0 0 4.192 10.508zm-146.802 350.22a8 8 0 0 0 7.354-4.845 8 8 0 0 0-4.193-10.508c-27.81-11.947-52.458-30.876-71.279-54.742a8 8 0 0 0-12.564 9.908c20.467 25.952 47.275 46.539 77.527 59.535a7.97 7.97 0 0 0 3.155.652zm-6.432-283.376c5.268-17.012 16.058-32.288 30.383-43.015a84.976 84.976 0 0 1 21.246-11.626c-10.525-8.634-17.254-21.734-17.254-36.378 0-25.938 21.102-47.039 47.04-47.039s47.039 21.102 47.039 47.039c0 14.644-6.729 27.744-17.254 36.378a85.015 85.015 0 0 1 21.245 11.625c14.324 10.727 25.114 26.002 30.382 43.015 2.444 7.892 1.049 16.212-3.827 22.826-4.876 6.615-12.412 10.409-20.674 10.409H199.088c-8.262 0-15.798-3.794-20.674-10.409-4.876-6.613-6.271-14.933-3.828-22.825zm50.375-91.018c0 17.115 13.924 31.04 31.04 31.04 17.115 0 31.039-13.925 31.039-31.04s-13.924-31.039-31.039-31.039c-17.116 0-31.04 13.923-31.04 31.039zm-33.669 104.351c1.829 2.479 4.67 3.902 7.795 3.902h113.824c3.125 0 5.967-1.423 7.795-3.902 1.828-2.48 2.347-5.615 1.422-8.601-9.022-29.136-35.598-48.711-66.129-48.711-30.532 0-57.107 19.575-66.129 48.711-.924 2.986-.406 6.121 1.422 8.601zm315.294 162.493c-4.876 6.615-12.412 10.409-20.674 10.409H372.087c-8.262 0-15.797-3.794-20.674-10.409-4.876-6.614-6.271-14.935-3.827-22.826 5.268-17.012 16.058-32.288 30.382-43.015a84.976 84.976 0 0 1 21.246-11.626c-10.525-8.634-17.254-21.734-17.254-36.378 0-25.938 21.102-47.039 47.04-47.039s47.04 21.102 47.04 47.039c0 14.644-6.729 27.744-17.254 36.378a84.97 84.97 0 0 1 21.245 11.626c14.324 10.727 25.114 26.002 30.382 43.015 2.444 7.891 1.049 16.211-3.827 22.826zM397.961 207.393c0 17.115 13.924 31.04 31.04 31.04s31.04-13.925 31.04-31.04-13.924-31.039-31.04-31.039-31.04 13.923-31.04 31.039zm97.168 95.752c-9.022-29.137-35.598-48.712-66.129-48.712-30.532 0-57.107 19.575-66.129 48.711-.925 2.985-.406 6.12 1.422 8.601 1.829 2.479 4.669 3.902 7.795 3.902h113.825c3.125 0 5.967-1.423 7.795-3.903s2.346-5.615 1.421-8.599zm-355.217 28.501H26.088c-8.262 0-15.798-3.794-20.674-10.409-4.876-6.615-6.271-14.936-3.826-22.827 5.267-17.011 16.057-32.287 30.382-43.014a84.976 84.976 0 0 1 21.246-11.626c-10.525-8.634-17.254-21.734-17.254-36.378 0-25.938 21.102-47.039 47.04-47.039s47.04 21.102 47.04 47.039c0 14.644-6.729 27.744-17.254 36.378a84.97 84.97 0 0 1 21.245 11.626c14.324 10.727 25.114 26.002 30.382 43.015 2.444 7.891 1.049 16.211-3.827 22.826-4.878 6.616-12.413 10.409-20.676 10.409zM51.961 207.393c0 17.115 13.924 31.04 31.04 31.04s31.04-13.925 31.04-31.04-13.924-31.039-31.04-31.039-31.04 13.923-31.04 31.039zM26.088 315.646h113.824c3.126 0 5.967-1.423 7.796-3.903 1.828-2.479 2.346-5.614 1.422-8.599-9.022-29.137-35.598-48.712-66.13-48.712s-57.107 19.575-66.129 48.711c-.925 2.985-.407 6.12 1.421 8.6 1.829 2.481 4.67 3.903 7.796 3.903zM337.414 471.41c2.444 7.893 1.049 16.213-3.828 22.827-4.876 6.615-12.412 10.409-20.674 10.409H199.088c-8.262 0-15.797-3.794-20.674-10.409-4.876-6.614-6.271-14.935-3.828-22.827 5.268-17.012 16.058-32.288 30.383-43.015a84.983 84.983 0 0 1 21.245-11.625c-10.525-8.634-17.253-21.734-17.253-36.377 0-25.938 21.102-47.039 47.04-47.039s47.039 21.102 47.039 47.039c0 14.644-6.728 27.744-17.253 36.378a84.992 84.992 0 0 1 21.244 11.625c14.324 10.726 25.114 26.001 30.383 43.014zm-81.435-59.978h.043c17.105-.012 31.018-13.931 31.018-31.04 0-17.115-13.924-31.039-31.039-31.039-17.116 0-31.04 13.924-31.04 31.039 0 17.108 13.912 31.028 31.018 31.04zm66.15 64.711c-9.02-29.129-35.585-48.701-66.107-48.71h-.043c-30.523.009-57.088 19.582-66.108 48.71-.925 2.986-.406 6.121 1.422 8.602 1.828 2.479 4.669 3.902 7.795 3.902h113.824c3.125 0 5.967-1.423 7.795-3.902 1.829-2.481 2.347-5.616 1.422-8.602z"
                                                opacity="1" data-original="url(#a)" class=""></path>
                                        </g>
                                    </svg>
                                </i>
                                Refferal <img class="arrow-indi" src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ctab008" data-bs-toggle="modal" data-bs-target="#logout"
                                type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0"
                                        y="0" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve" class="">
                                        <g>
                                            <linearGradient id="a" x1="77.597" x2="408.813" y1="421.608"
                                                y2="90.392" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fcc60e"></stop>
                                                <stop offset="1" stop-color="#e92e29"></stop>
                                            </linearGradient>
                                            <path fill="url(#a)"
                                                d="M436.854 387.749c-43.725 64.156-116.115 102.458-193.646 102.458-62.56 0-121.374-24.361-165.61-68.598C33.361 377.374 9 318.56 9 256S33.361 134.626 77.598 90.391c44.236-44.236 103.051-68.598 165.61-68.598 77.531 0 149.922 38.302 193.646 102.458 3.732 5.477 2.318 12.941-3.158 16.674-5.475 3.731-12.941 2.319-16.674-3.158-39.25-57.591-104.228-91.974-173.814-91.974C127.299 45.793 33 140.092 33 256s94.299 210.207 210.208 210.207c69.587 0 134.564-34.383 173.814-91.974 3.732-5.477 11.2-6.891 16.674-3.158 5.477 3.733 6.891 11.197 3.158 16.674zM503 256c0 5.436-2.282 10.366-6.426 13.884l-100.745 85.538c-3.386 2.875-7.528 4.36-11.738 4.36-2.594 0-5.214-.564-7.698-1.714-6.52-3.018-10.567-9.354-10.564-16.535v-27.834l-175.123.001c-13.469 0-24.427-10.958-24.427-24.427v-66.544c0-13.469 10.958-24.427 24.427-24.427l175.122-.001v-27.84c0-7.18 4.048-13.513 10.562-16.528 6.514-3.016 13.96-2.004 19.437 2.643l100.748 85.541C500.718 245.633 503 250.563 503 256zm-27.154 0-86.018-73.033v27.335c0 6.628-5.372 12-12 12l-187.122.001a.456.456 0 0 0-.427.427v66.544c0 .216.212.427.427.427l187.122-.001a12.002 12.002 0 0 1 12 12v27.334zm5.195-4.412a.259.259 0 0 1-.017.015l.017-.015c0 .001 0 .001 0 0z"
                                                opacity="1" data-original="url(#a)" class=""></path>
                                        </g>
                                    </svg>
                                </i>
                                logout <img class="arrow-indi" src="{{ asset('assets/front/img/arrow-right.png') }}" />
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade  {{ request()->page != 'wishlist' ? 'show active' : '' }}" id="tab01"
                        role="tabpanel" aria-labelledby="tab001" tabindex="0">
                        <h4 class="tab-title">Your Profile</h4>
                        <div class="row profile-form">
                            <form id="update-dashboard" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" placeholder="Name" name="name"
                                        id="name"class="form-control" value="{{ $user->name }}" />
                                    <a class="form-link">Edit</a>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" placeholder="Name" name="email" id="email"
                                        class="form-control" readonly value="{{ $user->email }}" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <input type="text" placeholder="Gendor" name="gender" id="gender"
                                        class="form-control" value="{{ $user->gender }}" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>DOB</label>
                                    <input type="date" placeholder="Dob"name="date_of_birth" id="date_of_birth"
                                        class="form-control" value="{{ $user->date_of_birth }}" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile</label>
                                    <input type="text" placeholder="Name"name="phone_number" id="phone_number"
                                        class="form-control" value="{{ $user->phone_number }}" />
                                    <a class="form-link">Verify</a>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Profile Image</label>
                                    <input type="file" class="form-control" name="image" id="image"
                                        accept="image/*" />

                                    {{-- Preview Area --}}
                                    <div style="margin-top:10px;">
                                        <img id="preview-image" alt="Preview"
                                            style="display:none;width:80px;height:80px;border:1px solid #ddd;
              padding:5px;border-radius:50%;object-fit:cover;object-position:top;">
                                    </div>
                                </div>
                                <!--<div class="form-group">-->
                                <!--   <label>Password</label>-->
                                <!--   <input type="Password" placeholder="Name" class="form-control" value="******" />-->
                                <!--</div>-->
                                <div class="form-group">
                                    <button type="submit" class="btn submit-btn login-button">Update</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Order section -->
                    <div class="tab-pane fade" id="tab02" role="tabpanel" aria-labelledby="tab002" tabindex="0">
                        <h4 class="tab-title">Your Orders</h4>
                        <ul class="order-product-list" id="current_order_item">
                            @if (isset($orderDetails))
                                @foreach ($orderDetails as $order)
                                    @php
                                        $firstItem = $order->items->first();
                                        $totalQty = $order->items->sum('qty');

                                        if ($firstItem) {
                                            $combination = json_decode($firstItem->combination);

                                            $variantId = \App\Models\VariantValue::where(
                                                'name',
                                                'like',
                                                '%' . reset($combination) . '%',
                                            )->value('id');

                                            $img =
                                                \App\Models\ProductGraphics::where('product_id', $firstItem->product_id)
                                                    ->where('variant_id', $variantId)
                                                    ->value('graphic') ??
                                                \App\Models\ProductGraphics::where(
                                                    'product_id',
                                                    $firstItem->product_id,
                                                )->value('graphic');
                                        } else {
                                            $combination = null;
                                            $variantId = null;
                                            $img = null;
                                        }
                                    @endphp
                                    @if (!empty($firstItem) && !empty($firstItem?->product?->sku))
                                    <li>
                                        <div class="border-box order-product">
                                            <a href="javascript:void('0')" class="arrow-redirect"
                                                data-orderId="{{ $order->order_number }}">
                                                <img src="{{ asset('assets/front/img/arrow-right.png') }}" /></a>
                                            <div class="process-list-box" id="order_status_{{ $order->order_number }}">
                                                @php
                                                    $completedStatuses = collect($order->statusHistories)
                                                        ->pluck('orderStatus.slug')
                                                        ->toArray();
                                                    $delivered = in_array('delivered', $completedStatuses);
                                                    $cancelled = in_array('cancelled', $completedStatuses);
                                                @endphp

                                                {{-- <ul class="process-step-list">
                                        @foreach ($allStatuses as $index => $status)
                                        @php
                                        $slug = $status->slug;
                                        $completedStatuses =
                                        collect($order->statusHistories)->pluck('orderStatus.slug')->toArray();
                                        $delivered = in_array('delivered', $completedStatuses);
                                        $cancelled = in_array('cancelled', $completedStatuses);
                                        $isReturnFlow = in_array($slug, ['return-requested', 'return-accepted',
                                        'refund-pending', 'refunded']);

                                        if ($isReturnFlow && (!$delivered || !in_array($slug, $completedStatuses))) {
                                        continue;
                                        }

                                        if ($slug === 'cancelled' && !$cancelled) {
                                        continue;
                                        }

                                        if ($slug === 'cancelled' && $delivered) {
                                        continue;
                                        }

                                        if ($cancelled && $slug !== 'cancelled' && !in_array($slug, $completedStatuses))
                                        {
                                        continue;
                                        }

                                        $isCompleted = in_array($slug, $completedStatuses);
                                        $class = $isCompleted ? 'active' : '';
                                        $textColorClass = '';
                                        $extraClass = '';

                                        if ($slug === 'cancelled' && $isCompleted) {
                                        $extraClass = 'cancelled';
                                        $textColorClass = 'text-danger';
                                        }
                                        @endphp

                                        <li class="{{ $class }} {{ $extraClass }}">
                                            <span><i class="{{ $status->icon }}"></i></span>
                                            <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                        </li>

                                        @if ($slug === 'cancelled' && $isCompleted)
                                        @break
                                        @endif

                                        @if ($slug === 'delivered' && $isCompleted)
                                        @php
                                        $hasCompletedReturn = collect(['return-requested', 'return-accepted',
                                        'refund-pending', 'refunded'])
                                        ->intersect($completedStatuses)->isNotEmpty();
                                        @endphp
                                        @if (!$hasCompletedReturn)
                                        @break
                                        @endif
                                        @endif
                                        @endforeach
                                    </ul> --}}
                                            </div>
                                            @if (!empty($firstItem) && !empty($firstItem?->product?->sku))
                                                <div class="order-product-detail">
                                                    <figure>
                                                        @if(!empty($firstItem?->product?->sku))
                                                        <a
                                                            href="{{ route('front-product.detail', ['sku' => $firstItem?->product?->sku, 'slug' => productSlug($firstItem?->product?->short_description)]) }}">
                                                            <img src="{{ url('uploads/products/' . $img) }}" /></a>
                                                            @endif
                                                    </figure>
                                                    <figcaption>
                                                        <h4 class="text-green">
                                                            @if(!empty($firstItem?->product?->sku))
                                                            <a
                                                                href="{{ route('front-product.detail', ['sku' => $firstItem->product->sku, 'slug' => productSlug($firstItem->product->short_description)]) }}">
                                                                {{ $firstItem ? $firstItem->product->name : 'Product Name Not Available' }}</a>
                                                                @endif
                                                        </h4>
                                                        <div class="price-tag"><span>₹{{ $order->total }}</span> <span
                                                                class="product-items">{{ $totalQty }} Items</span>
                                                        </div>
                                                        <div class="order-on">
                                                            <span>Order {{ $order->created_at->format('M d, Y') }}</span>
                                                        </div>
                                                        <div class="orderid">Order ID: {{ $order->order_number }}</div>
                                                        <div class="print_icon">
                                                            <a href="{{ route('front-orders.generate.invoice', $order->id) }}"
                                                                class="btn btn-info " target="_blank"
                                                                title="Generate Invoice"><i
                                                                    class="fa-solid fa-print"></i></a>
                                                        </div>

                                                    </figcaption>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <div class="order-detail-page" id="order-details-page"> </div>


                    </div>
                    <div class="tab-pane fade show  {{ request()->page == 'wishlist' ? 'show active' : '' }}"
                        id="tab03" role="tabpanel" aria-labelledby="tab003" tabindex="0">
                        <h4 class="tab-title">Wishlist</h4>
                        <div class="women-seller women-seller-slider wishlist-data">

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab04" role="tabpanel" aria-labelledby="tab004" tabindex="0">
                        <h4 class="tab-title">Your Address</h4>
                        <div class="">
                            <div class="select-delivery-box-inner billing-address p-0 mb-4">
                                <h5>Select Billing Address</h5>
                                @if (isset($userAddressDetails[0]))
                                    @foreach ($userAddressDetails as $key => $userAdd)
                                        @if ($userAdd->type == 'billing')
                                            <div class="form-check">
                                                <a href="javascript:void(0)" data-id="{{ $userAdd->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#edit-address"
                                                    class="form-link edit-address-btn">Edit</a>
                                                <input class="form-check-input" type="radio" name="address"
                                                    value="{{ $userAdd->id }}" />
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <div class="select-content">
                                                        <span class="tagcheck">
                                                            @if ($userAdd->address_type == 1)
                                                                Home
                                                            @elseif($userAdd->address_type == 2)
                                                                Office
                                                            @else
                                                                Others
                                                            @endif
                                                        </span>
                                                        <h6>{{ $userAdd->name }}</h6>
                                                        <p>{{ $userAdd->address }} {{ $userAdd->landmark }},
                                                            {{ $userAdd->city->name ?? '' }}, {{ $userAdd->state->name }},
                                                            {{ $userAdd->country->name }} - {{ $userAdd->postal_code }}
                                                        </p>
                                                        <p>Phone: +91{{ $userAdd->phone_number }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="select-delivery-box-inner p-0">
                                <h5>Select Shipping Addrress</h5>
                                @if (isset($userAddressDetails[0]))
                                    @foreach ($userAddressDetails as $userShipAdd)
                                        @if ($userShipAdd->type == 'shipping')
                                            <div class="form-check">
                                                <a href="javascript:void(0)" data-id="{{ $userShipAdd->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#edit-address"
                                                    class="form-link edit-address-btn">Edit</a>
                                                <input class="form-check-input" type="radio" value=""
                                                    id="flexRadioDefault1" checked="" />
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <div class="select-content">
                                                        <span class="tagcheck">
                                                            @if ($userShipAdd->address_type == 1)
                                                                Home
                                                            @elseif($userShipAdd->address_type == 2)
                                                                Office
                                                            @else
                                                                Others
                                                            @endif
                                                        </span>
                                                        <h6>{{ $userShipAdd->name }}</h6>
                                                        <p>{{ $userShipAdd->address }} {{ $userShipAdd->landmark }},
                                                            {{ $userShipAdd->city->name ?? '' }},
                                                            {{ $userShipAdd->state->name }},
                                                            {{ $userShipAdd->country->name }} -
                                                            {{ $userShipAdd->postal_code }}</p>
                                                        <p>Phone: +91{{ $userShipAdd->phone_number }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                <a href="" data-bs-toggle="modal" data-bs-target="#add-address"
                                    class="btn btn-primary mt-2">Add New Address</a>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade common-modal" id="add-address" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 id="staticBackdropLabel">Add New Address</h1>
                                        <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                                            aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <form method="post" id="addAddressForm">
                                        <div class="modal-body">
                                            <div class="row address-form">
                                                <div class="col-md-6 mb-3">
                                                    <select class="form-select selectcommon" name="country"
                                                        id="country" aria-label="Default select example">
                                                        <option selected="">Country/Region</option>
                                                        @if (isset($countries))
                                                            @foreach ($countries as $key => $country)
                                                                <option value="{{ $key }}">{{ $country }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <select class="form-select selectcommon" name="address_type"
                                                        aria-label="Default select example">
                                                        <option value="billing" selected="">Shipping Addrress</option>
                                                        <option value="shipping">Billing Address</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="firstname"
                                                            placeholder="First name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="lastname"
                                                            placeholder="Last name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Addess" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="addressSecond" class="form-control"
                                                            placeholder="Apartment, suite, etc. (optional)" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <select class="form-select selectcommon" id="state"
                                                        name="state" aria-label="Default select example">
                                                        <option selected>State</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <select class="form-select selectcommon" id="city"
                                                            name="city" aria-label="Default select example">
                                                            <option>City</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="pinCode" class="form-control"
                                                            placeholder="PIN code" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="phone" class="form-control"
                                                            placeholder="Phone"
                                                            value="{{ Auth::guard('customer')->user()->phone_number }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="inner_check_box">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="home" value="1"
                                                                checked="">
                                                            <label class="form-check-label" for="home">
                                                                <div class="sp-content">
                                                                    <h6>Home</h6>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="office" value="2">
                                                            <label class="form-check-label" for="office">
                                                                <div class="sp-content">
                                                                    <h6>Office</h6>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="Others" value="3">
                                                            <label class="form-check-label" for="Others">
                                                                <div class="sp-content">
                                                                    <h6>Others</h6>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-4 text-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="saveAddressBtn">Save</button>
                                                    <button type="button" class="btn btn-secondary ms-2"
                                                        id="cancelAddressBtn">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Model for Edit address-->
                        <div class="modal fade common-modal" id="edit-address" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 id="staticBackdropLabel">Edit Address</h1>
                                        <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                                            aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <form method="post" id="editAddressForm">
                                        <div class="modal-body">
                                            <div class="row address-form">
                                                <div class="col-md-12 mb-3">
                                                    <select class="form-select selectcommon" name="country"
                                                        id="country" aria-label="Default select example">
                                                        <option>Country/Region</option>
                                                        <option value="101" selected="">India</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="addressId" class="addressId" value="">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="firstname"
                                                            placeholder="First name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="lastname"
                                                            placeholder="Last name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Addess" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="addressSecond" class="form-control"
                                                            placeholder="Apartment, suite, etc. (optional)" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <!--<select class="form-select selectcommon editState" name="state" aria-label="Default select example">-->
                                                    <select class="form-select selectcommon editState" id="state"
                                                        name="state">
                                                        <option>State</option>
                                                        @if (isset($states))
                                                            @foreach ($states as $key => $state)
                                                                <option value="{{ $key }}">{{ $state }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <select class="form-select selectcommon editCity" name="city">
                                                            <option>City</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="pinCode" class="form-control"
                                                            placeholder="PIN code" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="phone" class="form-control"
                                                            placeholder="Phone"
                                                            value="{{ Auth::guard('customer')->user()->phone_number }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="inner_check_box">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="home" value="1">
                                                            <label class="form-check-label" for="home">
                                                                <div class="sp-content">
                                                                    <h6>Home</h6>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="office" value="2">
                                                            <label class="form-check-label" for="office">
                                                                <div class="sp-content">
                                                                    <h6>Office</h6>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="Others" value="3">
                                                            <label class="form-check-label" for="Others">
                                                                <div class="sp-content">
                                                                    <h6>Others</h6>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-4 text-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="updateAddressBtn">Save</button>
                                                    <button type="button" class="btn btn-secondary ms-2"
                                                        id="cancelAddressBtn">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab05" role="tabpanel" aria-labelledby="tab005" tabindex="0">
                        <h4 class="tab-title">Return Request</h4>
                        <div class="request-return-sec">
                            <div class="productreturn">
                                <ul class="productreturn-list">
                                    <li>
                                        <figure>
                                            <img src="assets/img/photo1.avif">
                                        </figure>
                                        <figcaption>
                                            <div class="orderid d-flex justify-content-between">
                                                Order ID:1000069760
                                                <p class="mb-0">Quantity:1</p>
                                            </div>
                                            <h4>Striped Men Round Neck Brown T-shirt</h4>
                                            <p class="s-text">Size: M</p>
                                            <p class="s-text">Color: Red</p>
                                            <div class="price-tag pt-1"><span>₹538</span></div>
                                        </figcaption>
                                    </li>
                                </ul>
                                <div class="return-reason-list">
                                    <div class="form-select-box mt-4">
                                        <label>Reason for return</label>
                                        <select class="form-select common-select" aria-label="Default select example">
                                            <option selected>Don't like the size/fit of the product</option>
                                            <option value="1">Product is missing in the package</option>
                                            <option value="2">Quality of the product not as expected</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="form-select-box mt-4">
                                        <label>More details</label>
                                        <select class="form-select common-select" aria-label="Default select example">
                                            <option selected>Do not like the fit</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="comments-sec mt-4">
                                        <label>Comments</label>
                                        <textarea class="form-control" placeholder="Type anything as ur wish"></textarea>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary mt-3">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab06" role="tabpanel" aria-labelledby="tab005" tabindex="0">
                        <h4 class="tab-title">Wallet Balance</h4>
                        <div class="wallet-balance-sec">
                            <p>Store Credit can be redeemed at the time of checkout.</p>
                            <div class="balance-code">
                                <!--<div class="cureent-balance-box">-->
                                <!--    <div class="cb-left"><i class="fa-solid fa-wallet"></i> Redeemed Balance</div>-->
                                <!--    <span class="amount text-green">₹0.00</span>-->
                                <!--</div>-->
                                <!--</br>-->
                                <div class="cureent-balance-box">
                                    <div class="cb-left"><i class="fa-solid fa-wallet"></i> Total Wallet Balance</div>
                                    <span class="amount text-green">

                                        ₹{{ $avlWallet }}</span>
                                </div>
                                <div class="cureent-balance-box">
                                    <div class="cb-left"><i class="fa-solid fa-wallet"></i> Total Earn From Refferal</div>
                                    <span class="amount text-green">
                                        @php
                                            $referralWallet = Auth::guard('customer')->user()->referral_wallet;

                                        @endphp
                                        ₹{{ $referralWallet }}</span>
                                </div>

                                <div class="cureent-balance-box">
                                    <div class="cb-left"><i class="fa-solid fa-wallet"></i> Total Earn From Cashback</div>
                                    <span class="amount text-green">
                                        0</span>
                                </div>
                                <div class="cureent-balance-box">
                                    <div class="cb-left"><i class="fa-solid fa-wallet"></i>Total Redeemed Amount</div>
                                    <span class="amount text-green">

                                        ₹{{ $redeemedamount }}</span>
                                </div>
                                <div class="cureent-balance-box">
                                    <div class="cb-left"><i class="fa-solid fa-wallet"></i>Total Earn From Refound</div>
                                    <span class="amount text-green">

                                        ₹{{ $totalrefund }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab07" role="tabpanel" aria-labelledby="tab005" tabindex="0">
                        <h4 class="tab-title">Refferal</h4>
                        <div class="refer-box">
                            <div class="refer-box-head">
                                <h3>Refer friends. Get rewards.</h3>
                                <!--<p>Get 20% off all Products when they shop online with your link.</p>-->

                                <a class="refer-btn"
                                    id="copyBtn">{{ Auth::guard('customer')->user()->user_referral_code }}</a> <span
                                    class="refer-code">{{ $referralWallet }}</span>
                            </div>
                            <ul class="refer-benifit-list">
                                <!--<li>Refer friends, family members or colleagues</li>-->
                                <!--<li>Get a $20 MOO Gift Card for every new refferral that places an order.</li>-->
                                <!--<li>psst- Your refferrals also get 25% off thier first order !</li>-->
                            </ul>
                            <div class="share_button">{!! $share_buttons !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade xs-modal" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <p>Are You sure you want to logout ?</p>
                    <div class="btn-box">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('front-user.logout') }}" class="btn ">Logout</a>
                        <!--<button type="button" class="btn ">Logout</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/front/js/dashboard.js') }}"></script>

    <script>
        // your custome placeholder goes here!
        var ph = "Search for style",
            searchBar = $("#search"),
            // placeholder loop counter
            phCount = 0;

        // function to return random number between
        // with min/max range
        function randDelay(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        // function to print placeholder text in a
        // 'typing' effect
        function printLetter(string, el) {
            // split string into character seperated array
            var arr = string.split(""),
                input = el,
                // store full placeholder
                origString = string,
                // get current placeholder value
                curPlace = $(input).attr("placeholder"),
                // append next letter to current placeholder
                placeholder = curPlace + arr[phCount];

            setTimeout(function() {
                // print placeholder text
                $(input).attr("placeholder", placeholder);
                // increase loop count
                phCount++;
                // run loop until placeholder is fully printed
                if (phCount < arr.length) {
                    printLetter(origString, input);
                }
                // use random speed to simulate
                // 'human' typing
            }, randDelay(50, 90));
        }

        // function to init animation
        function placeholder() {
            $(searchBar).attr("placeholder", "");
            printLetter(ph, searchBar);
        }

        placeholder();
        $(".submit").click(function(e) {
            phCount = 0;
            e.preventDefault();
            placeholder();
        });
    </script>
    <script>
        function updateImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the image source
                    $('#profilePic').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);


            }
        }
        $(document).on('submit', '#editProfileForm', function(e) {
            e.preventDefault();
            $btnName = $(this).find('button[type=submit]').html();
            $(this).find('button[type=submit]').prop('disabled', true);
            $(this).find('button[type=submit]').html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ' +
                $btnName);
            const that = this;
            var formData = new FormData($('#editProfileForm')[0]);
            const attributes = {
                hasButton: true,
                btnSelector: '.saveBtn',
                btnText: $btnName,
                handleSuccess: function() {
                    localStorage.setItem('flashMessage', datas['msg']);
                    window.location.href = "{{ route('user.dashboard') }}";
                }
            };
            const ajaxOptions = {
                url: "{{ route('front-user.updateProfile') }}",
                method: 'post',
                data: formData
            };

            makeAjaxRequest(ajaxOptions, attributes);
        });
        $(document).on('submit', '#changePasswordForm', function(e) {
            e.preventDefault();
            $btnName = $(this).find('button[type=submit]').html();
            $(this).find('button[type=submit]').prop('disabled', true);
            $(this).find('button[type=submit]').html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ' +
                $btnName);
            const that = this;
            var formData = new FormData($('#changePasswordForm')[0]);
            const attributes = {
                hasButton: true,
                btnSelector: '.changePasswordBtn',
                btnText: $btnName,
                handleSuccess: function() {
                    localStorage.setItem('flashMessage', datas['msg']);
                    window.location.href = "{{ route('user.dashboard') }}";
                }
            };
            const ajaxOptions = {
                url: "{{ route('front-user.changePassword') }}",
                method: 'post',
                data: formData
            };

            makeAjaxRequest(ajaxOptions, attributes);
        });

        $('.arrow-redirect').on('click', function() {
            let orderId = $(this).data('orderid');

            $.ajax({
                type: "GET",
                url: `${window.location.origin}/order-details/${orderId}`,
                success: function(response) {
                    $('#current_order_item').hide();
                    $('#order-details-page').fadeIn();
                    $('#order-details-page').html(response.html);
                    $(`#status_list_${orderId}`).html($(`#order_status_${orderId}`).html());

                },
                error: function(err) {
                    console.error("AJAX error:", err);
                }
            });
        });

        wishhlist();

        function wishhlist() {
            $.ajax({
                type: "GET",
                url: "{{ route('front-user.wishlist') }}",
                success: function(response) {
                    $('.wishlist-data').html(response.wishlistData);
                },
                error: function(xhr) {
                    if (xhr.status === 401 || xhr.status === 302) {
                        window.location.href = '/login'; // or your customer login route
                    } else {
                        console.error("AJAX error:", xhr);
                    }
                }
            })
        }


        $(document).on('click', '#current_order_back', function() {
            $('#current_order_item').fadeIn();
            $('#order-details-page').fadeOut();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#update-dashboard').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this); // <-- IMPORTANT (it captures file too)

                $.ajax({
                    url: "{{ route('front-user.updateProfile') }}",
                    type: "POST",
                    data: formData,
                    contentType: false, // required for file upload
                    processData: false, // required for file upload
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = response.redirect_url;
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let firstError = Object.values(errors)[0][0];

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: firstError,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Something went wrong. Please try again later.',
                            });
                        }
                    }
                });
            });
        });

        const img = document.getElementById('preview-image');
        document.getElementById('image').onchange = e => {
            const file = e.target.files[0];
            if (!file) return img.style.display = 'none';
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
        };

        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('change', '.print-checkbox-select-all', function() {
                if ($(this).prop('checked')) {
                    $(document).find('.print-checkbox').prop('checked', true);
                } else {
                    $(document).find('.print-checkbox').prop('checked', false);
                }
            });
            $(document).on('change', '.print-checkbox', function() {
                if ($('.print-checkbox:checked').length) {
                    if ($(document).find('.print-checkbox:checked').length < $(
                            '.print-checkbox').length) {
                        $(document).find('.print-checkbox-select-all').prop('indeterminate',
                            true);
                    } else {
                        $(document).find('.print-checkbox-select-all').prop('indeterminate',
                            false);
                        $(document).find('.print-checkbox-select-all').prop('checked', true);
                    }
                } else {
                    $(document).find('.print-checkbox-select-all').prop('indeterminate', false);
                    $(document).find('.print-checkbox-select-all').prop('checked', false);
                }
            });


        });
        $(document).on('click', '.print-invoice-btn', function() {
            if ($(document).find('.print-checkbox:checked').length) {
                var itemIds = [];
                var orderId = $(this).data('id');
                $(document).find('.print-checkbox:checked').each(function(i, e) {
                    id = $(e).data('id');
                    itemIds.push(id);

                });
                $.ajax({
                    url: '{{ route('front-orders.generate.items.invoice') }}',
                    data: {
                        ids: itemIds,
                        id: orderId
                    },
                    dataType: 'json',
                    method: 'post',
                    success: function(res) {

                        let byteChars = atob(res.file);
                        let byteNumbers = new Array(byteChars.length);
                        for (let i = 0; i < byteChars.length; i++) {
                            byteNumbers[i] = byteChars.charCodeAt(i);
                        }
                        let byteArray = new Uint8Array(byteNumbers);
                        let blob = new Blob([byteArray], {
                            type: "application/pdf"
                        });

                        let link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = res.filename;
                        link.click();

                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Something went wrong', 'error');
                    }
                });
            } else {
                Swal.fire('Error!', 'Please select item', 'error');
            }
        });
    </script>
@endsection
