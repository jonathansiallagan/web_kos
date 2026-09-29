@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Semua Notifikasi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <ul class="list-group list-group-flush">
                            @forelse ($notifications as $notif)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-4 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="btn btn-icon-only btn-rounded btn-outline-{{ $notif->read_at ? 'secondary' : 'primary' }} mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                            <i class="fas fa-{{ $notif->read_at ? 'check-double' : 'envelope' }}"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{ $notif->data['pesan'] ?? 'Notifikasi Baru' }}</h6>
                                            <span class="text-xs">{{ $notif->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-primary text-gradient text-sm font-weight-bold">
                                        {{ $notif->read_at ? 'Dibaca' : 'Baru' }}
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item border-0 ps-4">Tidak ada notifikasi.</li>
                            @endforelse
                        </ul>

                        <div class="px-4 mt-3">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection