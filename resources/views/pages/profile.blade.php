{{-- 
  PERBAIKAN KUNCI: 
  Kita cek role user. Jika 'admin', pakai layout admin ('auth').
  Jika bukan (berarti 'user'), pakai layout user ('user').
--}}
@extends(Auth::user()->role == 'admin' ? 'layouts.user_type.auth' : 'layouts.user_type.user')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Informasi Profil Saya</h6>
        </div>
        <div class="card-body pt-4 p-3">

            {{-- Form untuk update profil --}}
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="user-name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user-email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-phone" class="form-label">No. HP</label>
                            <input type="text" class="form-control" id="user-phone" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="user-pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="user-alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                @if(session('success'))
                <div class="alert alert-success" role="alert" style="color: white;">
                    {{ session('success') }}
                </div>
                @endif

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-0">Update Profil</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection