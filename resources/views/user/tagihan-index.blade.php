@extends('layouts.user_type.user')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Riwayat Tagihan Saya</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kamar</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihan as $item)
                        <tr>
                            <td>{{ $item->kamar->no_kamar ?? 'Kamar Dihapus' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->bulan_tahun)->format('F Y') }}</td>
                            <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                            <td>{{ $item->status_pembayaran }}</td>
                            <td>
                                @if ($item->status_pembayaran === 'Belum Bayar')
                                    <a href="{{ route('user.tagihan.bayar', $item->id) }}" class="btn btn-primary btn-sm">
                                        Bayar Sekarang
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Lunas</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada tagihan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $tagihan->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </div>
@endsection
