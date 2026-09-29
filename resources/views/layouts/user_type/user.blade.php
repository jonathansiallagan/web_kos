{{-- File: resources/views/layouts/user_type/user.blade.php --}}

{{-- 1. Kita extends 'layouts.app' dan tambahkan class 'g-sidenav-show' --}}
@extends('layouts.app', [
    'class' => 'g-sidenav-show bg-gray-100'
])

@section('auth')
    {{-- 
      Ini adalah layout untuk PENGGUNA (PENYEWA) yang SUDAH LOGIN
    --}}
    
    {{-- 2. Kita sertakan sidebar PENGGUNA yang baru --}}
    @include('layouts.navbars.auth.sidebar-user')
    
    {{-- 3. Kita bungkus konten utama dengan <main> --}}
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        
        @include('layouts.navbars.auth.nav')
        
        <div class="container-fluid py-4">
            @yield('content') {{-- Dashboard pengguna akan masuk di sini --}}
        </div>

    </main>
    
    {{-- 4. Footer dipindah ke luar <main> agar tidak tumpang tindih --}}
    @include('layouts.footers.auth.footer')
    
    @include('components.fixed-plugin')
    
@endsection