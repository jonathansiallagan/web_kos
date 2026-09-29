<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ str_replace('-', ' ', Request::path()) }}
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">
                {{ str_replace('-', ' ', Request::path()) }}
            </h6>
        </nav>

        {{-- Right Side Navbar --}}
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">

            {{-- Search Bar --}}
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>

            <ul class="navbar-nav justify-content-end">

                {{-- Logout --}}
                <li class="nav-item d-flex align-items-center">
                    <form role="form" method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Sign Out</span>
                        </a>
                    </form>
                </li>

                {{-- Sidenav toggler (mobile only) --}}
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

                {{-- Quick Menu Button (gear icon) --}}
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="#" class="nav-link text-body p-0 fixed-plugin-button-nav" data-bs-toggle="offcanvas"
                        data-bs-target="#navQuickMenu">
                        <i class="fa fa-cog cursor-pointer"></i>
                    </a>
                </li>

                {{-- Notification Dropdown --}}
                <li class="nav-item dropdown pe-2 d-flex align-items-center">

                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false" onclick="markNotificationAsRead()">

                        <i class="fa fa-bell cursor-pointer"></i>

                        {{-- Red Badge --}}
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span id="notif-badge"
                                class="position-absolute top-5 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md"
                                    href="{{ $notification->data['url'] ?? '#' }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <div
                                                class="avatar avatar-sm bg-gradient-{{ $notification->data['color'] ?? 'primary' }} me-3 my-auto">
                                                <i class="{{ $notification->data['icon'] ?? 'fa fa-envelope' }}"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span
                                                    class="font-weight-bold">{{ $notification->data['title'] ?? 'Notification' }}</span>
                                                <br>
                                                {{ $notification->data['message'] ?? '' }}
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="mb-2 text-center">
                                <p class="text-xs text-secondary mb-0">Tidak ada notifikasi baru.</p>
                            </li>
                        @endforelse

                        <li class="mb-2 text-center">
                            {{-- Cek Role Pengguna --}}
                            @if (auth()->user()->role == 'admin')
                                {{-- Jika Admin, arahkan ke route admin --}}
                                <a class="dropdown-item text-primary" href="{{ route('admin.notifications.index') }}">
                                    Lihat Semua Notifikasi
                                </a>
                            @else
                                {{-- Jika User, arahkan ke route user --}}
                                <a class="dropdown-item text-primary" href="{{ route('user.notifications.index') }}">
                                    Lihat Semua Notifikasi
                                </a>
                            @endif
                        </li>
                    </ul>
                </li>

                <script>
                    function markNotificationAsRead() {
                        const badge = document.getElementById('notif-badge');
                        if (badge) badge.style.display = 'none';

                        fetch("{{ route('notifications.markRead') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            }
                        });
                    }
                </script>

            </ul>
        </div>
    </div>
</nav>

{{-- Quick Menu Script --}}
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const gearBtn = document.querySelector(".fixed-plugin-button-nav");
            const canvas = document.getElementById("navQuickMenu");

            if (!window.bootstrap) {
                console.error('Bootstrap JS belum dimuat.');
                return;
            }

            let offcanvasInstance = null;

            if (canvas) {
                offcanvasInstance = new bootstrap.Offcanvas(canvas, {
                    backdrop: true,
                    scroll: false
                });
            }

            if (gearBtn && offcanvasInstance) {
                gearBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    offcanvasInstance.show();
                });
            }

            document.querySelectorAll('#navQuickMenu a').forEach(link => {
                link.addEventListener('click', () => {
                    try {
                        offcanvasInstance.hide();
                    } catch (e) {}
                });
            });
        });
    </script>
@endpush
