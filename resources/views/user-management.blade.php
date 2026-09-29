@extends('layouts.user_type.auth')

@section('content')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Daftar Semua Akun</h6>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Dibuat</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($users as $user)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 px-3">{{ $user->id }}</p>
                                            </td>

                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if($user->role == 'admin')
                                                    <span class="badge badge-sm bg-gradient-success">Admin</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">User</span>
                                                @endif
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d/m/y') }}</span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm mb-0 px-2 py-1">
                                                    Edit
                                                </a>

                                                <form action="{{ route('user.destroy', $user->id) }}"
                                                      method="POST"
                                                      class="d-inline form-delete-user">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm mb-0 px-2 py-1 btn-delete-user">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-sm p-4">Belum ada data user.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer d-flex justify-content-end pb-0">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================
    // SWEETALERT DELETE USER
    // ==========================
    const deleteButtons = document.querySelectorAll('.btn-delete-user');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('form');

            Swal.fire({
                title: 'Hapus User?',
                text: "User ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });


    // ==========================
    // SWEETALERT SESSION SUCCESS
    // ==========================
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}"
        });
    @endif


    // ==========================
    // SWEETALERT SESSION ERROR
    // ==========================
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}"
        });
    @endif

});
</script>
@endpush
