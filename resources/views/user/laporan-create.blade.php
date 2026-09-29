@extends('layouts.user_type.user') {{-- Menggunakan layout user --}}

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Buat Laporan Kerusakan Baru</h6>
                        {{-- TODO: Buat route untuk user melihat laporannya sendiri --}}
                        <a href="#" class="btn btn-secondary btn-sm mb-0">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Riwayat Laporan
                        </a>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">

                        {{-- Form ini akan dikirim ke LaporanController@store --}}
                        <form action="{{ route('user.laporan.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Judul Laporan</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Contoh: AC Kamar Bocor" value="{{ old('judul') }}" required>
                                    @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Kamar (Otomatis)</label>
                                    {{-- 
                                      Kita cari kamar milik user ini. 
                                      Controller sudah mengirim $kamars, tapi kita filter di sini.
                                      Asumsi $kamars adalah SEMUA kamar.
                                    --}}
                                    @php
                                        $kamarUser = $kamars->firstWhere('user_id', auth()->id());
                                    @endphp

                                    @if($kamarUser)
                                        <input type="text" class="form-control" value="{{ $kamarUser->no_kamar }} ({{ $kamarUser->tipe_kamar }})" disabled>
                                        <input type="hidden" name="kamar_id" value="{{ $kamarUser->id }}">
                                    @else
                                        <input type="text" class="form-control" value="Kerusakan Umum (Bukan Kamar)" disabled>
                                        <input type="hidden" name="kamar_id" value="">
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Deskripsi Kerusakan</label>
                                    <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan kerusakan secara rinci..." required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn bg-gradient-primary px-4">
                                    <i class="fas fa-save me-2"></i>Kirim Laporan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection