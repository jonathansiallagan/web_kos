@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">

                {{-- Tombol Generate Tagihan --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Buat Tagihan Bulan Ini</h5>
                        <p class="card-text">
                            Klik tombol ini untuk membuat tagihan bulan {{ now()->format('F Y') }}.
                            <br>
                            <small class="text-muted">
                                <i>Sistem akan otomatis memeriksa</i> dan <b>hanya</b> membuat tagihan untuk penghuni baru
                                yang belum ditagih bulan ini.
                            </small>
                        </p>

                        <form action="{{ route('tagihan.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync me-2"></i>
                                Periksa & Buat Tagihan Baru
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Tabel Daftar Tagihan --}}
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Semua Tagihan</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">

                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Penghuni & Kamar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Bulan Tagihan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($tagihan as $item)
                                    <tr>
                                        {{-- Info Penghuni & Kamar --}}
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->user->name ?? 'User Dihapus' }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $item->kamar->no_kamar ?? 'Kamar Dihapus' }}
                                                        ({{ $item->kamar->tipe_kamar ?? '' }})
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Bulan Tagihan --}}
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ \Carbon\Carbon::parse($item->bulan_tahun)->format('F Y') }}
                                            </p>
                                        </td>

                                        {{-- Jumlah --}}
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                            </p>
                                        </td>

                                        {{-- Status --}}
                                        <td class="align-middle text-center text-sm">
                                            @if($item->status_pembayaran == 'Lunas')
                                            <span class="badge badge-sm bg-gradient-success">Lunas</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger">Belum Bayar</span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="align-middle text-center">
                                            @if($item->status_pembayaran == 'Belum Bayar')

                                            {{-- Form Hidden --}}
                                            <form id="form-lunas-{{ $item->id }}"
                                                action="{{ route('tagihan.update', $item->id) }}"
                                                method="POST" class="d-none">
                                                @csrf
                                                @method('PATCH')
                                            </form>

                                            {{-- Button SweetAlert --}}
                                            <button type="button"
                                                class="btn btn-success btn-sm mb-0 px-2 py-1 btn-lunas"
                                                data-id="{{ $item->id }}">
                                                Tandai Lunas
                                            </button>

                                            @else
                                            <button class="btn btn-secondary btn-sm mb-0 px-2 py-1" disabled>
                                                Lunas
                                            </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-sm p-4">
                                            Belum ada data tagihan.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="card-footer d-flex justify-content-end pb-0">
                            {{ $tagihan->links('pagination::bootstrap-5') }}
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
document.addEventListener("DOMContentLoaded", function () {

    // Tombol Lunas
    document.querySelectorAll('.btn-lunas').forEach(btn => {
        btn.addEventListener('click', function () {

            let id = this.dataset.id;

            Swal.fire({
                title: "Konfirmasi",
                text: "Tandai tagihan ini sebagai LUNAS?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, tandai lunas!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-lunas-' + id).submit();
                }
            });

        });
    });

    // Alert sukses setelah update
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 1500,
            showConfirmButton: false
        });
    @endif

});
</script>
@endpush
