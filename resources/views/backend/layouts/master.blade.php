<!DOCTYPE html>

<html lang="en-US">
<head>
    @yield('page-title')
    @yield('styles')
    @stack('custom-style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @yield("header-content")
    @yield("sidebar-content")
    <div class="content-wrapper">
        @yield("main-content")
    </div>
    @yield("footer-content")
</div>
@yield('scripts')
@stack('custom-script')
</body>
</html>