@extends('layouts.user_type.user')

@section('content')

    {{-- Pesan Selamat Datang --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-0 font-weight-bolder">Selamat Datang, {{ $user->name }}!</h5>

                    {{-- Tampilkan pesan sukses/error jika ada --}}
                    @if (session('success'))
                        <div class="alert alert-success text-white mt-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger text-white mt-3" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- 
      LOGIKA UTAMA:
      Cek apakah user sudah punya kamar.
    --}}

    @if ($kamar)
        {{-- ================================================ --}}
        {{-- 1. JIKA SUDAH PUNYA KAMAR: Tampilkan Info Kamar --}}
        {{-- ================================================ --}}
        <div class="row">
            {{-- Kartu Info Kamar Saya --}}
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Kamar Saya</h6>
                    </div>
                    <div class="card-body px-0 pb-2 pt-0">
                        <ul class="list-group list-group-flush px-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-sm">No. Kamar</span>
                                <strong class="text-dark">{{ $kamar->no_kamar }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-sm">Tipe Kamar</span>
                                <strong class="text-dark">{{ $kamar->tipe_kamar }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-sm">Harga per Bulan</span>
                                <strong class="text-dark">Rp
                                    {{ number_format($kamar->harga_perbulan, 0, ',', '.') }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="text-sm">Status Kamar</span>
                                <span class="badge badge-sm bg-gradient-success">Ditempati</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- Kartu Tagihan --}}
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Tagihan Bulan Ini ({{ now()->format('F Y') }})</h6>
                    </div>
                    <div class="card-body p-4">
                        @php
                            $tagihanBulanIni = auth()->user()->kamar ? auth()->user()->kamar->pembayaranBulanIni : null;
                        @endphp

                        @if ($tagihanBulanIni)
                            @if ($tagihanBulanIni->status_pembayaran == 'Lunas')
                                <div class="alert alert-success text-white" role="alert">
                                    <strong>LUNAS!</strong> Terima kasih atas pembayaranmu.
                                </div>
                            @else
                                <div class="alert alert-danger text-white" role="alert">
                                    <strong>BELUM BAYAR</strong> Mohon segera lakukan pembayaran.
                                </div>
                            @endif
                        @else
                            <div class="alert alert-light" role="alert">
                                Tagihan untuk bulan ini belum dibuat oleh admin.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @elseif($pemesananPending)
        {{-- ======================================================== --}}
        {{-- 2. JIKA BELUM PUNYA KAMAR, TAPI PESANAN PENDING (DIPROSES) --}}
        {{-- ======================================================== --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 text-center">
                    <div class="card-body p-5">
                        <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                        <h5 class="mb-2">Pesananmu Sedang Ditinjau</h5>
                        <p>Kamu telah memesan kamar: <strong class="text-dark">{{ $pemesananPending->kamar->no_kamar }}
                                ({{ $pemesananPending->kamar->tipe_kamar }})</strong>.</p>
                        <p class="mb-0">Admin akan segera meninjau pemesananmu. Mohon tunggu konfirmasi.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- ======================================================= --}}
        {{-- 3. JIKA BELUM PUNYA KAMAR & BELUM MEMESAN: Tampilkan Kamar Kosong --}}
        {{-- ======================================================= --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Pilih Kamar yang Tersedia</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Info Kamar</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Harga</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Ukuran</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kamarsKosong as $kamar)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- (Foto kamar)
                          <div>
                            <img src="{{ asset('storage/' . $kamar->foto) }}" class="avatar avatar-sm me-3" alt="foto">
                          </div>
                          --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $kamar->no_kamar }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $kamar->tipe_kamar }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">Rp
                                                    {{ number_format($kamar->harga_perbulan, 0, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $kamar->ukuran }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <form action="{{ route('user.pemesanan.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                                                    <button type="submit" class="btn btn-primary btn-sm mb-0">
                                                        Pesan Sekarang
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm p-4">
                                                Maaf, saat ini tidak ada kamar yang tersedia.
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
    @endif

@endsection
