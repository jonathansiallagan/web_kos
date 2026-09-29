@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        {{-- JUDUL DIUBAH --}}
                        <h6 class="mb-0">Edit Kamar: {{ $kamar->no_kamar }}</h6>
                        <a href="{{ route('tables') }}" class="btn btn-secondary btn-sm mb-0">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">
                        
                        {{-- 1. ACTION FORM DIUBAH ke route 'kamar.update' --}}
                        <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH') {{-- 2. METHOD DIUBAH menjadi 'PATCH' untuk update --}}
                            
                            <div class="row g-3">
                                
                                {{-- 3. SEMUA INPUT DIBERI 'value' DARI DATA LAMA --}}
                                
                                <div class="col-md-6">
                                    <label class="form-label">No. Kamar</label>
                                    <input type="text" name="no_kamar" class="form-control" required 
                                           value="{{ old('no_kamar', $kamar->no_kamar) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tipe Kamar</label>
                                    <input type="text" name="tipe_kamar" class="form-control" required
                                           value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Harga per Bulan</label>
                                    <input type="number" name="harga_perbulan" class="form-control" required
                                           value="{{ old('harga_perbulan', $kamar->harga_perbulan) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ukuran</label>
                                    <input type="text" name="ukuran" class="form-control" required
                                           value="{{ old('ukuran', $kamar->ukuran) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Fasilitas</label>
                                    {{-- (Decode JSON jika fasilitas disimpan sebagai JSON) --}}
                                    @php
                                        $fasilitas = old('fasilitas', $kamar->fasilitas);
                                        // Cek jika ini JSON, ubah jadi string dipisah koma
                                        if (is_string($fasilitas) && ($json = json_decode($fasilitas, true)) && json_last_error() == JSON_ERROR_NONE) {
                                            $fasilitas = implode(', ', $json);
                                        }
                                    @endphp
                                    <textarea name="fasilitas" class="form-control" rows="3">{{ $fasilitas }}</textarea>
                                </div>

                                {{-- Bagian upload foto (dengan preview foto lama) --}}
                                <div class="col-12">
                                    <label class="form-label">Foto Kamar (Opsional: ganti foto)</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer" id="drop-area">
                                        <label for="foto" class="cursor-pointer block">
                                            <svg class="mx-auto w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16V4m10 0v12M5 20h14M3 20a2 2 0 002 2h14a2 2 0 002-2H3z" />
                                            </svg>
                                            <p class="text-sm text-gray-600 mt-2">
                                                Drag & Drop atau <span class="text-warning fw-semibold">klik untuk unggah foto baru</span>
                                            </p>
                                            {{-- Hapus 'required' agar tidak wajib ganti foto --}}
                                            <input type="file" name="foto" id="foto" class="d-none" accept="image/*">
                                        </label>
                                        
                                        {{-- Tampilkan foto lama (jika ada) atau preview baru --}}
                                        <img id="preview" 
                                             src="{{ $kamar->foto ? asset('storage/' . $kamar->foto) : '' }}" 
                                             class="mx-auto mt-3 img-thumbnail rounded {{ $kamar->foto ? '' : 'd-none' }}" 
                                             style="max-height: 150px;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Tersedia" {{ old('status', $kamar->status) == 'Tersedia' ? 'selected' : '' }}>
                                            Tersedia
                                        </option>
                                        <option value="Terisi" {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>
                                            Terisi
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn bg-gradient-primary px-4">
                                    <i class="fas fa-save me-2"></i>Update Kamar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- JavaScript untuk preview gambar (tetap sama) --}}
@push('scripts')
<script>
  const fotoInput = document.getElementById('foto');
  const preview = document.getElementById('preview');
  const dropArea = document.getElementById('drop-area');

  fotoInput.addEventListener('change', () => {
    const file = fotoInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(file);
    }
  });

  // Optional: drag & drop
  dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('border-warning');
  });

  dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('border-warning');
  });

  dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    fotoInput.files = e.dataTransfer.files;
    fotoInput.dispatchEvent(new Event('change'));
    dropArea.classList.remove('border-warning');
  });
</script>
@endpush