<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    style="direction: @if (app()->getLocale() === 'ar') rtl @else ltr @endif;">

@include('ecommerce.layouts.head')
<body>
    
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4R93M6F"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('ecommerce.layouts.navbar')
    <main>
        @yield('content')
    </main>
    @include('ecommerce.helloPopUp')
    @include('ecommerce.layouts.footer')
    @include('ecommerce.layouts.script')
    @yield('scripts')
</body>
</html>

