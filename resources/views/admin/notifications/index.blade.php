@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Semua Notifikasi Admin</h6>
                        </div>
                        <div class="col-6 text-end">
                            <form action="{{ route('notifications.markRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-0">
                                    Tandai Semua Dibaca
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pesan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                <tr class="{{ is_null($notification->read_at) ? 'bg-gray-100' : '' }}">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $notification->data['title'] ?? 'Notifikasi' }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $notification->data['message'] ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $notification->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ $notification->data['url'] ?? '#' }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Lihat Detail">
                                            Lihat <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <span class="text-sm text-secondary">Tidak ada notifikasi saat ini.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection