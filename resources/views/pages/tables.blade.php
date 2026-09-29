@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            
            {{-- 1. JUDUL CARD & TOMBOL TAMBAH --}}
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Data Kamar</h6>
              {{-- 2. LINK KE HALAMAN CREATE (route kamar.create) --}}
              <a href="{{ route('kamar.create') }}" class="btn btn-primary btn-sm mb-0">
                <i class="fas fa-plus me-2"></i> Tambah Kamar
              </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  
                  {{-- 3. HEADER TABEL DIUBAH --}}
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Info Kamar</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>

                  {{-- 4. ISI TABEL DINAMIS DARI DATABASE --}}
                  <tbody>
                    @forelse($kamars as $kamar)
                      <tr>
                        {{-- Info Kamar (No & Tipe) --}}
                        <td>
                          <div class="d-flex px-2 py-1">
                            {{-- (Opsional: Tampilkan foto kamar di sini jika ada)
                            <div>
                              <img src="{{ asset('storage/' . $kamar->foto) }}" class="avatar avatar-sm me-3" alt="foto kamar">
                            </div>
                            --}}
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $kamar->no_kamar }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $kamar->tipe_kamar }}</s_kamar>
                            </div>
                          </div>
                        </td>
                        
                        {{-- Harga --}}
                        <td>
                          <p class="text-sm font-weight-bold mb-0">Rp {{ number_format($kamar->harga_perbulan) }}</p>
                          <p class="text-xs text-secondary mb-0">/ bulan</p>
                        </td>

                        {{-- Status --}}
                        <td class="align-middle text-center text-sm">
                          @if($kamar->status == 'Tersedia')
                            <span class="badge badge-sm bg-gradient-success">Tersedia</span>
                          @else
                            <span class="badge badge-sm bg-gradient-secondary">Terisi</span>
                          @endif
                        </td>

                        {{-- Aksi (Edit & Hapus) --}}
                        <td class="align-middle text-center">
                          {{-- Link ke route kamar.edit --}}
                          <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-warning btn-sm mb-0 px-2 py-1" data-toggle="tooltip" data-original-title="Edit kamar">
                            Edit
                          </a>
                          
                          {{-- Form untuk Hapus (route kamar.destroy) --}}
                          <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="form-delete-kamar d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm mb-0 px-2 py-1">
                                  Hapus
                              </button>
                          </form>

                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center text-sm p-4">
                          Belum ada data kamar. Silakan <a href="{{ route('kamar.create') }}">tambah kamar baru</a>.
                        </td>
                      </tr>
                    @endforelse
                  </tbody>

                </table>
              </div>
              
              {{-- 5. LINK PAGINATION --}}
              <div class="card-footer d-flex justify-content-end pb-0">
                {{ $kamars->links('pagination::bootstrap-5') }}
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

    /* ============================
       KONFIRMASI HAPUS KAMAR
    ============================= */
    const deleteForms = document.querySelectorAll('.form-delete-kamar');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus Kamar?',
                text: "Kamar ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
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


    /* ============================
       NOTIFIKASI SUKSES
       (BERDASARKAN SESSION FLASH)
    ============================= */
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
            timer: 2500,
            showConfirmButton: false
        });
    @endif

});
</script>
@endpush

