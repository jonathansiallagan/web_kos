@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Edit Data Akun: {{ $user->name }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                
                <form action="{{ route('user.update', $user->id) }}" method="POST">
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
                                <label for="user-role" class="form-label">Role</label>
                                <select class="form-select" id="user-role" name="role" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="user-alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-md mt-4 mb-0">Kembali</a>
                        <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-0">Update User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection