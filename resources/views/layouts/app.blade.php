<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <title>Website Kos Anda</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />

    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="@stack('body-class')">

    {{-- AUTH CONTENT --}}
    @auth
        @yield('auth')
    @endauth

    {{-- GUEST CONTENT --}}
    @guest
        @yield('guest')
    @endguest

    {{-- 🔹 QUICK NAVBAR MENU --}}
    @include('components.nav-quick-menu')

    {{-- 🔹 JS CORE --}}
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    {{-- 🔹 Soft UI --}}
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

    {{-- 🔹 APP JS --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- 🔹 STACK SCRIPTS --}}
    @stack('scripts')

    {{-- Scrollbar init --}}
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
        }
    </script>

</body>
</html>