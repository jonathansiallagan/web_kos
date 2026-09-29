@extends('layouts.user_type.auth') 

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Notifikasi Saya</h6>
                        
                        {{-- Tombol Tandai Semua Dibaca --}}
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.markRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary mb-0">
                                    Tandai Semua Dibaca
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                
                <div class="card-body p-3">
                    <ul class="list-group">
                        @forelse($notifications as $notification)
                            <li class="list-group-item border-0 d-flex p-3 mb-2 bg-gray-100 border-radius-lg">
                                
                                {{-- Ikon --}}
                                <div class="d-flex flex-column justify-content-center me-3">
                                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center">
                                        <i class="{{ $notification->data['icon'] ?? 'fa fa-bell' }} text-dark text-lg"></i>
                                    </div>
                                </div>

                                {{-- Konten Pesan --}}
                                <div class="d-flex flex-column justify-content-center w-100">
                                    <h6 class="mb-1 text-sm {{ $notification->read_at ? 'text-secondary' : 'text-dark font-weight-bold' }}">
                                        {{ $notification->data['title'] ?? 'Notifikasi' }}
                                    </h6>
                                    <p class="text-xs text-secondary mb-2">
                                        {{ $notification->data['message'] ?? '' }}
                                    </p>
                                    <span class="text-xxs text-secondary">
                                        <i class="fa fa-clock me-1"></i>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                {{-- Tombol Aksi (Sebelah Kanan) --}}
                                <div class="ms-auto text-end align-self-center">
                                    @if(isset($notification->data['url']))
                                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ $notification->data['url'] }}">
                                            <i class="fas fa-external-link-alt text-xs me-1"></i> Lihat
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <div class="text-center py-5">
                                <i class="fa fa-bell-slash text-secondary text-4xl mb-3" style="font-size: 2rem;"></i>
                                <p class="text-sm text-secondary">Belum ada notifikasi untuk Anda.</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection