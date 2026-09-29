@extends('layouts.user_type.user')

@section('content')
<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-gradient-primary text-white">
      <h4>Pembayaran Tagihan</h4>
    </div>
    <div class="card-body">
      <p>Silakan selesaikan pembayaran untuk bulan <strong>{{ \Carbon\Carbon::parse($tagihan->bulan_tahun)->format('F Y') }}</strong></p>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between">
          Kamar
          <span>{{ $tagihan->kamar->no_kamar ?? 'Kamar Dihapus' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          Tipe Kamar
          <span>{{ $tagihan->kamar->tipe_kamar ?? '-' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          Jumlah Bayar
          <span>Rp {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          Order ID
          <span><code>{{ $tagihan->order_id }}</code></span>
        </li>
      </ul>
      <button id="pay-button" class="btn btn-primary btn-lg btn-block">Bayar Sekarang</button>
      <a href="{{ route('user.tagihan.index') }}" class="btn btn-secondary btn-lg btn-block mt-2">Kembali</a>
    </div>
  </div>
</div>

<!-- Midtrans Snap JS -->
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{  config ('services.midtrans.client_key') }}"></script>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('pay-button');
    const snapToken = '{{ $snapToken }}';

    console.log('Snap Token:', snapToken);
    console.log('Client Key:', '{{ config('services.midtrans.client_key') }}');

    payButton.addEventListener('click', function() {
        payButton.disabled = true;
        payButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';

        try {
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log('Payment Success:', result);
                    alert('Pembayaran berhasil!');
                    window.location.href = '{{ route('user.tagihan.index') }}';
                },
                onPending: function(result) {
                    console.log('Payment Pending:', result);
                    alert('Pembayaran sedang diproses. Silakan cek status pembayaran Anda.');
                    window.location.href = '{{ route('user.tagihan.index') }}';
                },
                onError: function(result) {
                    console.error('Payment Error:', result);
                    alert('Terjadi kesalahan saat pembayaran. Silakan coba lagi.');
                    payButton.disabled = false;
                    payButton.innerHTML = 'Bayar Sekarang';
                },
                onClose: function() {
                    console.log('Payment popup closed');
                    payButton.disabled = false;
                    payButton.innerHTML = 'Bayar Sekarang';
                }
            });
        } catch (error) {
            console.error('Snap Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
            payButton.disabled = false;
            payButton.innerHTML = 'Bayar Sekarang';
        }
    });
});
</script>
@endsection