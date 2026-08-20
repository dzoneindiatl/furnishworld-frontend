<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $siteLogo = \App\Models\Setting::where('key','Site.logo')->first();
    $siteFooterLogo = \App\Models\Setting::where('key','Site.footerlogo')->first();
    $optionallogo = \App\Models\Setting::where('key','Site.optionallogo')->first();
    $favIcon = \App\Models\Setting::where('key','Site.fav_icon')->first();
@endphp
<!-- Include Head -->
@include('front.includes.head_home')
    
    <body>
        <div class="wrapper">
            @include('front.includes.header_home')
            
            @yield('content')
                
            <!-- </div> -->

            <div id="flash-msg" class="alert alert-info d-none"></div>

            <!-- Include Footer -->
            @include('front.includes.footer_home')
            @include('front.includes.script')
        </div>
    </body>
</html>
