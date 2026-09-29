@extends('layouts.app')

@section('auth')

    {{-- 
      LOGIKA BARU:
      Cek apakah kita ada di halaman 'guest' (login, register, lupa password).
    --}}
    @if (request()->routeIs('login') ||
            request()->routeIs('register') ||
            request()->routeIs('password.request') ||
            request()->routeIs('password.reset'))

        {{-- ===== LAYOUT GUEST ===== --}}
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')
    @else
        {{-- ===== LAYOUT SETELAH LOGIN (ADMIN / USER) ===== --}}

        @if (\Request::is('rtl'))
            @include('layouts.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('layouts.navbars.auth.nav-rtl')
                <div class="container-fluid py-4"
                    style="min-height: 85vh; display: flex; flex-direction: column; justify-content: space-between;">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        @elseif (\Request::is('profile'))
            {{-- [PERUBAHAN 1] Logika Sidebar Dinamis di Halaman Profile --}}
            @if (auth()->user()->role == 'admin')
                @include('layouts.navbars.auth.sidebar-admin')
            @elseif(auth()->user()->role == 'user')
                @include('layouts.navbars.auth.sidebar-user')
            @endif

            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('layouts.navbars.auth.nav')
                @yield('content')
            </div>
        @elseif (\Request::is('virtual-reality'))
            @include('layouts.navbars.auth.nav')
            <div class="border-radius-xl mt-3 mx-3 position-relative"
                style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">

                {{-- [PERUBAHAN 2] Logika Sidebar Dinamis di Halaman VR --}}
                @if (auth()->user()->role == 'admin')
                    @include('layouts.navbars.auth.sidebar-admin')
                @elseif(auth()->user()->role == 'user')
                    @include('layouts.navbars.auth.sidebar-user')
                @endif

                <main class="main-content mt-1 border-radius-lg">
                    @yield('content')
                </main>
            </div>
            @include('layouts.footers.auth.footer')
        @else
            {{-- [LOGIKA SIDEBAR] --}}
            @if (auth()->user()->role == 'admin')
                @include('layouts.navbars.auth.sidebar-admin')
            @elseif(auth()->user()->role == 'user')
                @include('layouts.navbars.auth.sidebar-user')
            @endif

            <main
                class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ Request::is('rtl') ? 'overflow-hidden' : '' }}">
                @include('layouts.navbars.auth.nav')

                <div class="container-fluid py-4" style="min-height: 85vh;">
                    @yield('content')
                </div>

                <div class="container-fluid">
                    @include('layouts.footers.auth.footer')
                </div>

            </main>
        @endif

        @include('components.fixed-plugin')

    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    @stack('scripts')


@endsection
