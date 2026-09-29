@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            {{-- Icon kamar diperbaiki, gunakan icon bed dari FontAwesome --}}
                            <i class="fas fa-bed me-2"></i>
                            Tambah Kamar Baru
                        </h6>
                        <a href="{{ route('tables') }}" class="btn btn-secondary btn-sm mb-0">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">
                        
                        {{-- Ini adalah form untuk MEMBUAT kamar baru --}}
                        <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">No. Kamar</label>
                                    <input type="text" name="no_kamar" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tipe Kamar</label>
                                    <input type="text" name="tipe_kamar" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Harga per Bulan</label>
                                    <input type="number" name="harga_perbulan" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ukuran</label>
                                    <input type="text" name="ukuran" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Fasilitas</label>
                                    <textarea name="fasilitas" class="form-control" rows="3"></textarea>
                                </div>

                                {{-- Bagian upload foto --}}
                                <div class="col-12">
                                    <label class="form-label">Foto Kamar</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-warning transition" id="drop-area">
                                        <label for="foto" class="cursor-pointer block">
                                            {{-- Icon kamar di area upload diperbaiki jadi icon bed --}}
                                            <i class="fas fa-bed fa-3x text-gray-400 mx-auto d-block"></i>
                                            <p class="text-sm text-gray-600 mt-2">
                                                Drag & Drop atau <span class="text-warning fw-semibold">klik untuk unggah</span>
                                            </p>
                                            <input type="file" name="foto" id="foto" class="d-none" accept="image/*" required>
                                        </label>
                                        <img id="preview" class="mx-auto mt-3 img-thumbnail rounded d-none" style="max-height: 150px;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Terisi">Terisi</option>
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

{{-- JavaScript untuk preview gambar --}}
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