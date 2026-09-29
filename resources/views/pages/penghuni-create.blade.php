@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Tambah Penghuni Baru</h6>
                        <a href="{{ route('penghuni.index') }}" class="btn btn-secondary btn-sm mb-0">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">

                        {{-- Ini adalah form untuk MENAMBAH PENGHUNI --}}
                        <form action="{{ route('penghuni.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                {{-- Dropdown untuk memilih kamar (Hanya yang Tersedia) --}}
                                <div class="col-md-6">
                                    <label class="form-label">Pilih Kamar (Hanya yang Tersedia)</label>
                                    <select name="kamar_id" class="form-select" required>
                                        <option value="">-- Pilih Kamar --</option>
                                        @forelse($kamarsKosong as $kamar)
                                            <option value="{{ $kamar->id }}">{{ $kamar->no_kamar }} ({{ $kamar->tipe_kamar }})</option>
                                        @empty
                                            <option disabled>Tidak ada kamar tersedia</option>
                                        @endforelse
                                    </select>
                                </div>

                                {{-- Dropdown untuk memilih penghuni (Hanya user yang belum punya kamar) --}}
                                <div class="col-md-6">
                                    <label class="form-label">Pilih Penghuni (User)</label>
                                    <select name="user_id" class="form-select" required>
                                        <option value="">-- Pilih User --</option>
                                        @forelse($calonPenghuni as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @empty
                                            <option disabled>Tidak ada user (calon penghuni) tersedia</option>
                                        @endforelse
                                    </select>
                                </div>

                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn bg-gradient-primary px-4">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection