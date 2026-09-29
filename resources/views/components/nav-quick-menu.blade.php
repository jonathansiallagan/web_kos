{{-- resources/views/components/nav-quick-menu.blade.php --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="navQuickMenu" aria-labelledby="navQuickMenuLabel"
    data-bs-backdrop="true" data-bs-scroll="false" style="z-index: 2000;">

    <div class="offcanvas-header position-relative" style="padding-right:3.5rem;">
        <h5 class="offcanvas-title mb-0" id="navQuickMenuLabel">Menu Cepat</h5>

        {{-- Tombol X jelas terlihat (FontAwesome) dan posisinya absolut di pojok kanan atas --}}
        <button type="button" class="btn btn-link text-dark p-0 m-0 position-absolute"
            style="top:0.75rem; right:0.8rem;" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fas fa-times fa-lg"></i>
        </button>
    </div>



    <div class="offcanvas-body">

        @php($user = Auth::user())

        @if ($user && $user->role === 'admin')
            {{-- MENU UNTUK ADMIN --}}
            <h6 class="text-uppercase text-muted small">Kelola Kos</h6>
            <ul class="list-unstyled mb-3">
                <li class="mb-2">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                        <i class="ni ni-tv-2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('tables') }}" class="d-flex align-items-center">
                        <i class="ni ni-building me-2"></i> Data Kamar
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('penghuni.index') }}" class="d-flex align-items-center">
                        <i class="ni ni-single-02 me-2"></i> Data Penghuni
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('keuangan.index') }}" class="d-flex align-items-center">
                        <i class="ni ni-money-coins me-2"></i> Keuangan
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('laporan.index') }}" class="d-flex align-items-center">
                        <i class="ni ni-chart-bar-32 me-2"></i> Laporan Kerusakan
                    </a>
                </li>
            </ul>

            <h6 class="text-uppercase text-muted small">Manajemen Akun</h6>
            <ul class="list-unstyled mb-3">
                <li class="mb-2">
                    <a href="{{ route('user.index') }}" class="d-flex align-items-center">
                        <i class="ni ni-badge me-2"></i> Daftar Akun
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('tagihan.index') }}" class="d-flex align-items-center">
                        <i class="ni ni-credit-card me-2"></i> Manajemen Tagihan
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.notifications.index') }}"
                        class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="ni ni-bell-55 me-2"></i> Notifikasi
                        </div>
                        @if ($user->unreadNotifications->count() > 0)
                            <span class="badge bg-danger rounded-pill">{{ $user->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <h6 class="text-uppercase text-muted small">Akun</h6>
            <ul class="list-unstyled mb-3">
                <li class="mb-2">
                    <a href="{{ route('profile') }}" class="d-flex align-items-center">
                        <i class="ni ni-single-02 me-2"></i> Profile
                    </a>
                </li>
            </ul>
        @else
            {{-- MENU UNTUK USER / PENGHUNI --}}
            <h6 class="text-uppercase text-muted small">Menu Penghuni</h6>
            <ul class="list-unstyled mb-3">
                <li class="mb-2">
                    <a href="{{ route('user.home') }}" class="d-flex align-items-center">
                        <i class="ni ni-tv-2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('user.tagihan.index') }}" class="d-flex align-items-center">
                        <i class="ni ni-bullet-list-67 me-2"></i> Riwayat Tagihan
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('user.notifications.index') }}"
                        class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="ni ni-bell-55 me-2"></i> Notifikasi
                        </div>
                        @if ($user->unreadNotifications->count() > 0)
                            <span class="badge bg-danger rounded-pill">{{ $user->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('user.laporan.create') }}" class="d-flex align-items-center">
                        <i class="ni ni-settings-gear-65 me-2"></i> Lapor Kerusakan
                    </a>
                </li>
            </ul>

            <h6 class="text-uppercase text-muted small">Akun</h6>
            <ul class="list-unstyled mb-3">
                <li class="mb-2">
                    <a href="{{ route('profile') }}" class="d-flex align-items-center">
                        <i class="ni ni-single-02 me-2"></i> Profile
                    </a>
                </li>
            </ul>
        @endif

        <hr>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="ni ni-button-power me-2"></i> Logout
            </button>
        </form>

    </div>
</div>
