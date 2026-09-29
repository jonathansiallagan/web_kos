<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>

        {{-- Arahkan ke dashboard PENGGUNA --}}
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('user.home') }}">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Website Kos</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- Link ke Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/home') ? 'active' : '' }}" href="{{ route('user.home') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tachometer-alt text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- Judul Menu --}}
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu Penghuni</h6>
            </li>

            {{-- Riwayat Tagihan --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/tagihan*') ? 'active' : '' }}"
                    href="{{ route('user.tagihan.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-history text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Riwayat Tagihan</span>
                </a>
            </li>

            {{-- Lapor Kerusakan (tampil jika pembayaran bulan ini LUNAS) --}}
            @if(auth()->user()->pembayaranBulanIni && auth()->user()->pembayaranBulanIni->status_pembayaran === 'Lunas')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('user/laporan*') ? 'active' : '' }}"
                        href="{{ route('user.laporan.create') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tools text-dark text-gradient text-lg top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lapor Kerusakan</span>
                    </a>
                </li>
            @endif

            {{-- Notifikasi (dari branch feature-notifikasi) --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/notifications') ? 'active' : '' }}"
                    href="{{ route('user.notifications.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bell text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notifikasi</span>
                </a>
            </li>

            {{-- Judul Account Pages --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>

            {{-- Profile --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            {{-- Logout --}}
            <li class="nav-item">
                <a class="nav-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt text-dark text-gradient text-lg top-0"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

        {{-- Footer Bantuan --}}
        <div class="sidenav-footer mx-3 mt-auto">
            <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
                <div class="full-background"
                    style="background-image: url('../assets/img/curved-images/white-curved.jpeg')"></div>

                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                        <i class="fab fa-whatsapp text-dark text-gradient text-lg top-0" aria-hidden="true"></i>
                    </div>
                    <div class="docs-info">
                        <h6 class="text-white up mb-0">Butuh bantuan?</h6>
                        <p class="text-xs font-weight-bold">Silahkan hubungi kami via</p>
                        <a href="https://wa.me/6281378155056" target="_blank"
                            class="btn btn-white btn-sm w-100 mb-0">WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</aside>