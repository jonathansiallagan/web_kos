@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Daftar Laporan Kerusakan</h6>
              <a href="{{ route('laporan.create') }}" class="btn btn-primary btn-sm mb-0">
                <i class="fas fa-plus me-2"></i> Buat Laporan Baru
              </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Laporan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kamar</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pelapor</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($laporans as $laporan)
                      <tr>
                        {{-- Judul Laporan --}}
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $laporan->judul }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ Str::limit($laporan->deskripsi, 50) }}</p>
                            </div>
                          </div>
                        </td>
                        
                        {{-- Kamar --}}
                        <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $laporan->kamar->no_kamar ?? 'Umum' }}</p>
                        </td>

                        {{-- Pelapor --}}
                        <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $laporan->user->name ?? 'N/A' }}</p>
                        </td>

                        {{-- Status --}}
                        <td class="align-middle text-center text-sm">
                          @if($laporan->status == 'Baru')
                            <span class="badge badge-sm bg-gradient-info">Baru</span>
                          @elseif($laporan->status == 'Dikerjakan')
                            <span class="badge badge-sm bg-gradient-warning">Dikerjakan</span>
                          @else
                            <span class="badge badge-sm bg-gradient-success">Selesai</span>
                          @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="align-middle text-center d-flex justify-content-center gap-2">

                          {{-- Form Ganti Status --}}
                          @if($laporan->status != 'Selesai')
                          <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PATCH')
                              @if($laporan->status == 'Baru')
                                <input type="hidden" name="status" value="Dikerjakan">
                                <button type="submit" class="btn btn-info btn-sm mb-0 px-2 py-1">
                                  Tandai Dikerjakan
                                </button>
                              @elseif($laporan->status == 'Dikerjakan')
                                <input type="hidden" name="status" value="Selesai">
                                <button type="submit" class="btn btn-success btn-sm mb-0 px-2 py-1">
                                  Tandai Selesai
                                </button>
                              @endif
                          </form>
                          @endif

                          {{-- Form Hapus --}}
                          <form action="{{ route('laporan.destroy', $laporan->id) }}" 
                                method="POST"
                                class="d-inline delete-form">
                              @csrf
                              @method('DELETE')
                              <button type="button"
                                      class="btn btn-danger btn-sm mb-0 px-2 py-1 btn-delete"
                                      data-name="{{ $laporan->judul }}">
                                Hapus
                              </button>
                          </form>

                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center text-sm p-4">
                          Belum ada laporan kerusakan.
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              
              <div class="card-footer d-flex justify-content-end pb-0">
                {{ $laporans->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection


@push('scripts')
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {

            let form = this.closest('form');
            let title = this.getAttribute('data-name');

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Laporan \"" + title + "\" akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    });

});
</script>
@endpush
