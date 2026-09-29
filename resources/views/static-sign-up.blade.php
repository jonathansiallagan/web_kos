@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            {{-- Bagian Gambar Kiri --}}
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Buat Akun Baru</h3>
                  <p class="mb-0">Isi data diri Anda untuk mendaftar</p>
                </div>
                <div class="card-body">
                  
                  {{-- FORM BARU KITA --}}
                  <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="mb-3">
                      <label class="form-label">Nama Lengkap</label>
                      <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- No HP --}}
                    <div class="mb-3">
                      <label class="form-label">Nomor HP</label>
                      <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}" required>
                      @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                      <label class="form-label">Jenis Kelamin</label>
                      {{-- Gunakan class 'form-select' dari Soft UI --}}
                      <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                      </select>
                      @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="mb-3">
                      <label class="form-label">Pekerjaan</label>
                      <input type="text" name="pekerjaan" class="form-control" placeholder="Contoh: Mahasiswa, Pegawai, dll" value="{{ old('pekerjaan') }}" required>
                      @error('pekerjaan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                      <label class="form-label">Alamat Lengkap</label>
                      <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap Anda" required>{{ old('alamat') }}</textarea>
                      @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
                      {{-- Indikator kekuatan password dari HTML kustom-mu --}}
                      <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                      </div>
                      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-3">
                      <label class="form-label">Konfirmasi Password</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                    
                    {{-- Ganti tombol Sign Up --}}
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Daftar Sekarang</button>
                    </div>

                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-info text-gradient font-weight-bold">Masuk di sini</a>
                  </p>
                </div>
              </div>
            </div>
            
            {{-- Bagian Gambar Kanan --}}
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>

  {{-- CSS untuk password strength meter --}}
  @push('styles')
  <style>
    .password-strength {
      height: 5px;
      border-radius: 3px;
      background: #e9ecef; /* Warna dasar abu-abu Soft UI */
      margin-top: 8px;
    }
    .password-strength-bar {
      height: 100%;
      width: 0%;
      border-radius: 3px;
      transition: width 0.3s ease;
    }
  </style>
  @endpush

  {{-- JavaScript untuk password strength meter --}}
  @push('scripts')
  <script>
    const password = document.getElementById("password");
    const bar = document.getElementById("strengthBar");
    password.addEventListener("input", function () {
      const val = password.value;
      let strength = 0;
      if (val.length >= 8) strength += 25;
      if (val.match(/[a-z]+/)) strength += 25;
      if (val.match(/[A-Z]+/)) strength += 25;
      if (val.match(/[0-9]+/)) strength += 25;
      
      bar.style.width = strength + "%";
      
      if (strength <= 25) bar.style.background = "#f5365c"; // Warna danger
      else if (strength <= 50) bar.style.background = "#fb6340"; // Warna warning
      else if (strength <= 75) bar.style.background = "#fb6340"; // Warna warning
      else bar.style.background = "#2dce89"; // Warna success
    });
  </script>
  @endpush

@endsection