<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Website Kos</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">

    {{-- 
    PERBAIKAN: 
    Saya tambahkan class 'h-100' di sini dan 'max-height-vh-100'
    agar area scroll-nya mengisi tinggi sidebar.
  --}}
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- Dashboard Admin --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- icon dashboard diperbaiki --}}
                        <i class="fas fa-tachometer-alt text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- Judul "Kelola Kos" --}}
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Kelola Kos</h6>
            </li>

            {{-- Link ke DATA KAMAR --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/kamar*') ? 'active' : '' }}" href="{{ route('tables') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- icon data kamar diperbaiki: gunakan icon bed --}}
                        <i class="fas fa-bed text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Kamar</span>
                </a>
            </li>

            {{-- Link ke PENGHUNI --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/penghuni*') ? 'active' : '' }}"
                    href="{{ route('penghuni.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Penghuni</span>
                </a>
            </li>

            {{-- Link ke KEUANGAN --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/keuangan*') ? 'active' : '' }}"
                    href="{{ route('keuangan.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-wallet text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Keuangan</span>
                </a>
            </li>

            {{-- Link ke LAPORAN KERUSAKAN --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/laporan*') ? 'active' : '' }}"
                    href="{{ route('laporan.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tools text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan Kerusakan</span>
                </a>
            </li>

            {{-- Bagian "Manajemen Akun" --}}
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Akun</h6>
            </li>

            {{-- 
        PERBAIKAN: 
        Link 'User Profile' (example) yang duplikat sudah dihapus dari sini.
      --}}

            {{-- Link 'Daftar Akun' (User Management) --}}
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('admin/user-management*') ? 'active' : '' }}"
                    href="{{ route('user.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark {{ Request::is('user-management') ? 'text-white' : 'text-dark' }} "
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Daftar Akun</span>
                </a>
            </li>

            {{-- Link ke MANAJEMEN TAGIHAN --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/tagihan*') ? 'active' : '' }}"
                    href="{{ route('tagihan.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- Ikon Tagihan --}}
                        <i class="fas fa-file-invoice-dollar text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manajemen Tagihan</span>
                </a>
            </li>

            {{-- Menu Notifikasi --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/notifications') ? 'active' : '' }}"
                    href="{{ route('admin.notifications.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bell text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notifikasi</span>
                </a>
            </li>

            {{-- Bagian "Account Pages" --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>

            {{-- Link 'Profile' (Pribadi) --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- icon profile diperbaiki --}}
                        <i class="fas fa-user text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            {{-- Link 'Logout' --}}
            <li class="nav-item">
                <a class="nav-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- icon logout diperbaiki --}}
                        <i class="fas fa-sign-out-alt text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>

    {{-- 
    PERBAIKAN: 
    Blok <div class="sidenav-footer ..."> (kartu "Need help?") 
    telah DIHAPUS dari sini.
  --}}

</aside>
