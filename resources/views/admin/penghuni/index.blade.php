@extends('layouts.admin')

@section('title', 'Kelola Penghuni')
@section('header', 'Kelola Penghuni')

@section('content')
<div class="container-fluid px-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold text-dark"><i class="fas fa-users text-warning me-2"></i>Data Penghuni</h3>
      <p class="text-muted small">Kelola seluruh penghuni kos beserta statusnya.</p>
    </div>

    <a href="{{ route('admin.penghuni.create') }}" class="btn btn-warning text-white">
      <i class="fas fa-plus me-2"></i>Tambah Penghuni
    </a>
  </div>

  <!-- Notifikasi -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
          <thead class="table-warning">
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No Telepon</th>
              <th>Kamar</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
          @forelse($penghunis as $p)
            <tr>
              <td>{{ $loop->iteration }}</td>

              <td>
                <img src="{{ asset('storage/' . $p->foto) }}"
                     style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
              </td>

              <td><strong>{{ $p->nama }}</strong></td>
              <td>{{ $p->email }}</td>
              <td>{{ $p->no_telepon }}</td>

              <td><strong>{{ $p->kamar->no_kamar ?? '-' }}</strong></td>

              <td>
                <span class="badge {{ $p->status == 'Aktif' ? 'bg-success' : 'bg-warning' }}">
                  {{ $p->status }}
                </span>
              </td>

              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('admin.penghuni.edit', $p->id) }}" class="btn btn-sm btn-outline-warning">
                    <i class="fas fa-edit"></i>
                  </a>

                  <form method="POST" action="{{ route('admin.penghuni.destroy', $p->id) }}" 
                        onsubmit="return confirm('Hapus penghuni ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-muted">Belum ada penghuni.</td>
            </tr>
          @endforelse
          </tbody>

        </table>
      </div>

      <div class="mt-3 d-flex justify-content-end">
        {{ $penghunis->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>

</div>
@endsection
