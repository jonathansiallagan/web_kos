@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        
        {{-- ================================================= --}}
        {{-- 1. TABEL BARU: Pemesanan Menunggu Persetujuan    --}}
        {{-- ================================================= --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Pemesanan Menunggu Persetujuan</h6>
                        <p class="text-sm">Daftar calon penghuni yang memesan kamar via dashboard user.</p>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Calon Penghuni</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kamar yg Dipesan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tgl Pesan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemesanansPending as $pemesanan)
                                        <tr>
                                            {{-- Info Penghuni --}}
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $pemesanan->user->name ?? 'User Dihapus' }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $pemesanan->user->email ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Info Kamar --}}
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $pemesanan->kamar->no_kamar ?? 'N/A' }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $pemesanan->kamar->tipe_kamar ?? 'N/A' }}</p>
                                            </td>
                                            {{-- Tanggal Pesan --}}
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $pemesanan->created_at->format('d M Y') }}</p>
                                            </td>
                                            {{-- Aksi --}}
                                            <td class="align-middle text-center d-flex justify-content-center gap-2">
                                                {{-- Tombol Setujui --}}
                                                <form action="{{ route('penghuni.approve', $pemesanan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm mb-0 px-2 py-1" onclick="return confirm('Anda yakin ingin MENYETUJUI pesanan ini? Kamar akan ditandai Terisi.')">
                                                        Setujui
                                                    </button>
                                                </form>

                                                {{-- Tombol Tolak --}}
                                                <form action="{{ route('penghuni.reject', $pemesanan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-0 px-2 py-1" onclick="return confirm('Anda yakin ingin MENOLAK pesanan ini?')">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm p-4">
                                                Tidak ada pemesanan yang menunggu persetujuan.
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

        {{-- ================================================= --}}
        {{-- 2. TABEL LAMA: Data Penghuni Aktif & Status Bayar --}}
        {{-- ================================================= --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Data Penghuni Aktif & Status Bayar</h6>
                        <a href="{{ route('penghuni.create') }}" class="btn btn-primary btn-sm mb-0">
                            <i class="fas fa-plus me-2"></i> Tambah Penghuni (Manual)
                        </a>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penghuni</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kamar</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Bayar (Bulan Ini)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kamarsTerisi as $kamar)
                                        <tr>
                                            {{-- Info Penghuni --}}
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $kamar->user->name ?? 'N/A' }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $kamar->user->email ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Info Kamar --}}
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $kamar->no_kamar }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $kamar->tipe_kamar }}</p>
                                            </td>
                                            {{-- Status Bayar --}}
                                            <td class="align-middle text-center text-sm">
                                                @if($kamar->pembayaranBulanIni)
                                                    @if($kamar->pembayaranBulanIni->status_pembayaran == 'Lunas')
                                                        <span class="badge badge-sm bg-gradient-success">Lunas</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-danger">Belum Bayar</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-sm bg-gradient-warning">Belum Ada Tagihan</span>
                                                @endif
                                            </td>
                                            {{-- Aksi --}}
                                            <td class="align-middle text-center d-flex justify-content-center gap-2">
                                                {{-- Tombol Keluarkan --}}
                                                <form action="{{ route('penghuni.destroy', $kamar->id) }}" method="POST" class="form-keluarkan d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm mb-0 px-2 py-1 btn-keluarkan">
                                                        Keluarkan
                                                    </button>
                                                </form>

                                                {{-- Tombol Manual Lunas --}}
                                                @if($kamar->pembayaranBulanIni && $kamar->pembayaranBulanIni->status_pembayaran != 'Lunas')
                                                    <form action="{{ route('penghuni.markLunas', $kamar->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm mb-0 px-2 py-1"
                                                                onclick="return confirm('Tandai pembayaran bulan ini sebagai Lunas?')">
                                                            Lunas
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm p-4">
                                                Belum ada data penghuni aktif.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end pb-0">
                            {{ $kamarsTerisi->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.btn-keluarkan');

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {

            let form = this.closest('form');

            Swal.fire({
                title: 'Keluarkan Penghuni?',
                text: "Penghuni akan dikeluarkan dan kamar berubah menjadi tersedia.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, keluarkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    });

    // Notifikasi sukses apabila ada session success
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

});
</script>
@endpush
