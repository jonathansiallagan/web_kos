@extends('layouts.user_type.auth')

@section('content')

  <div class="container-fluid py-4">
    
    {{-- BAGIAN KARTU LAPORAN (PENGGANTI KARTU KREDIT) --}}
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pemasukan (Bulan Ini)</p>
                      <h5 class="font-weight-bolder mb-0">
                        Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                      <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengeluaran (Bulan Ini)</p>
                      <h5 class="font-weight-bolder mb-0">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                      <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Keuntungan Bersih (Bulan Ini)</p>
                      <h5 class="font-weight-bolder mb-0">
                        Rp {{ number_format($keuntunganBersih, 0, ',', '.') }}
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-chart-bar-32 text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      {{-- BAGIAN FORM PENGELUARAN (PENGGANTI BILLING INFORMATION) --}}
      <div class="col-md-7 mt-4">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Catat Pengeluaran Baru</h6>
          </div>
          <div class="card-body pt-4 p-3">
            
            <form action="{{ route('keuangan.storePengeluaran') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Contoh: 50000" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                  <option value="">-- Pilih Kategori --</option>
                  <option value="Listrik">Listrik</option>
                  <option value="Air">Air</option>
                  <option value="Internet">Internet</option>
                  <option value="Gaji Karyawan">Gaji Karyawan</option>
                  <option value="Perbaikan">Perbaikan</option>
                  <option value="Lain-lain">Lain-lain</option>
                </select>
              </div>
              <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Contoh: Bayar tagihan listrik November" required></textarea>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-primary btn-md mt-2 mb-0">Simpan Pengeluaran</button>
              </div>
            </form>

          </div>
        </div>
      </div>

      {{-- BAGIAN RIWAYAT PENGELUARAN (PENGGANTI YOUR TRANSACTION'S) --}}
      <div class="col-md-5 mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Riwayat Pengeluaran</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="far fa-calendar-alt me-2"></i>
                <small>5 Transaksi Terbaru</small>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Terbaru</h6>
            <ul class="list-group">
              @forelse($daftarPengeluaran as $pengeluaran)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ $pengeluaran->kategori }}</h6>
                    <span class="text-xs">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  - Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}
                </div>
              </li>
              @empty
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <p class="text-sm">Belum ada pengeluaran bulan ini.</p>
              </li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>

    {{-- BAGIAN RIWAYAT PEMASUKAN (PENGGANTI INVOICES) --}}
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Riwayat Pemasukan (Lunas)</h6>
              </div>
              <div class="col-6 text-end">
                <a class="btn btn-outline-primary btn-sm mb-0" href="{{ route('penghuni.index') }}">View All</a>
              </div>
            </div>
          </div>
          <div class="card-body p-3 pb-0">
            <ul class="list-group">
              @forelse($daftarPemasukan as $pemasukan)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark font-weight-bold text-sm">Bayar Kamar {{ $pemasukan->kamar->no_kamar ?? '' }}</h6>
                  <span class="text-xs">Oleh: {{ $pemasukan->user->name ?? 'N/A' }} (Lunas pada {{ $pemasukan->updated_at->format('d M Y') }})</span>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + Rp {{ number_format($pemasukan->jumlah_bayar, 0, ',', '.') }}
                </div>
              </li>
              @empty
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <p class="text-sm">Belum ada pemasukan lunas bulan ini.</p>
              </li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
  
@endsection