@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0">Detail Permintaan Sewa #{{ $pemesanan->id }}</h5>
                            <p class="text-sm mb-0">
                                Tanggal Request: <b>{{ $pemesanan->created_at->format('d M Y, H:i') }}</b>
                            </p>
                        </div>
                        <div class="col-4 text-end">
                            <a href="{{ route('pemesanan.index') }}" class="btn btn-outline-secondary btn-sm mb-0">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Informasi Pemohon (User)</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="avatar me-3">
                                <img src="{{ asset('assets/img/team-2.jpg') }}" alt="kal" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $pemesanan->user->name }}</h6>
                                <p class="mb-0 text-xs">{{ $pemesanan->user->email }}</p>
                            </div>
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No. HP:</strong> &nbsp; {{ $pemesanan->user->phone ?? '-' }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pekerjaan:</strong> &nbsp; {{ $pemesanan->user->pekerjaan ?? '-' }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat Asal:</strong> &nbsp; {{ $pemesanan->user->alamat ?? '-' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Informasi Kamar yang Diminta</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-radius-lg bg-gray-100 p-3 mb-3 text-center">
                                <h4 class="text-primary mb-0">{{ $pemesanan->kamar->nomor_kamar }}</h4>
                                <span class="text-xs text-secondary">Nomor Kamar</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border-radius-lg bg-gray-100 p-3 mb-3 text-center">
                                <h4 class="text-success mb-0">Rp {{ number_format($pemesanan->kamar->harga, 0, ',', '.') }}</h4>
                                <span class="text-xs text-secondary">Harga per Bulan</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm">
                        Fasilitas: {{ $pemesanan->kamar->fasilitas ?? 'Standar' }} <br>
                        Lantai: {{ $pemesanan->kamar->lantai ?? '1' }}
                    </p>

                    <hr class="horizontal dark my-3">

                    <h6 class="mb-3">Tindakan Admin:</h6>
                    @if($pemesanan->status == 'pending')
                        <div class="d-flex gap-2">
                            <form action="{{ route('penghuni.approve', $pemesanan->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn bg-gradient-success w-100 mb-0" onclick="return confirm('Yakin ingin menerima penghuni ini?')">
                                    <i class="fas fa-check me-2"></i> Terima Penghuni
                                </button>
                            </form>

                            <form action="{{ route('penghuni.reject', $pemesanan->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-gradient-danger w-100 mb-0" onclick="return confirm('Yakin ingin menolak permintaan ini?')">
                                    <i class="fas fa-times me-2"></i> Tolak
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-{{ $pemesanan->status == 'diterima' ? 'success' : 'danger' }} text-white text-center" role="alert">
                            Permintaan ini sudah berstatus: <strong>{{ strtoupper($pemesanan->status) }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection