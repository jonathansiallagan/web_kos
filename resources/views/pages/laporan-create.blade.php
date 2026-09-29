@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Buat Laporan Kerusakan Baru</h6>
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-sm mb-0">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">
                        
                        <form action="{{ route('laporan.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                
                                <div class="col-md-6">
                                    <label class="form-label">Judul Laporan</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Contoh: AC Kamar Bocor" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Kamar (Opsional)</label>
                                    <select name="kamar_id" class="form-select">
                                        <option value="">-- Pilih Kamar (jika kerusakan spesifik) --</option>
                                        @foreach($kamars as $kamar)
                                            <option value="{{ $kamar->id }}">{{ $kamar->no_kamar }} ({{ $kamar->tipe_kamar }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Deskripsi Kerusakan</label>
                                    <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan kerusakan secara rinci..." required></textarea>
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