@extends('layouts.app')

@section('title', 'Pembayaran - Jovina Inventory')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #3d2b1f;">Konfirmasi Pesanan</h2>
        <p class="text-muted">Selesaikan pembayaran untuk produk Jovina Hair Extension pilihanmu</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <div class="table-responsive bg-white rounded shadow-sm border">
                <table class="table align-middle mb-0">
                    <thead style="background: #efa122;" class="text-white border-0">
                        <tr>
                            <th class="p-3 border-0">Produk</th>
                            <th class="p-3 border-0 text-center">Harga</th>
                            <th class="p-3 border-0 text-center">Jumlah</th>
                            <th class="p-3 border-0 text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="p-3 border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/70" class="rounded me-3 shadow-sm border" alt="Hair Extension" style="width: 70px; height: 70px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0 fw-bold">Hair Extension Premium - Black</h6>
                                        <small class="text-muted">Human Hair 100%</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center border-0">Rp 299.900</td>
                            <td class="text-center border-0">1 Unit</td>
                            <td class="text-center fw-bold border-0" style="color: #efa122;">Rp 299.900</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded shadow-sm border">
                <div class="d-flex gap-2">
                    <input type="text" class="form-control shadow-none" placeholder="Punya kode promo?" style="max-width: 250px; border-radius: 8px;">
                    <button class="btn px-4 fw-bold text-white" style="background: #efa122; border: none; border-radius: 8px;">Gunakan</button>
                </div>
                <span class="text-muted small d-none d-md-inline">Pastikan pesanan sudah benar.</span>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg p-4 rounded-4" style="background: #ffffff; border-top: 5px solid #efa122 !important;">
                <h5 class="fw-bold mb-4" style="color: #3d2b1f;">Ringkasan Belanja</h5>
                
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total Harga</span>
                    <span>Rp 299.900</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Pengiriman</span>
                    <span class="fw-bold" style="color: #efa122;">Gratis</span>
                </div>
                
                <hr style="border-top: 2px dashed #ddd;">
                
                <div class="d-flex justify-content-between mb-4 align-items-center">
                    <span class="h5 mb-0 fw-bold">Total Tagihan</span>
                    <span class="h4 mb-0 fw-bold" style="color: #efa122;">Rp 299.900</span>
                </div>

                <button id="pay-button" class="btn w-100 py-3 fw-bold text-white shadow" 
                        style="background: #efa122; border: none; border-radius: 12px; font-size: 17px;">
                    <i class="fas fa-shopping-bag me-2"></i> BAYAR SEKARANG
                </button>

                <div class="text-center mt-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Logo_Midtrans.png" alt="Midtrans" style="height: 15px; opacity: 0.6;">
                    <p class="text-muted mt-1" style="font-size: 10px;">Aman & Terenkripsi oleh Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {
        fetch("{{ route('payment.process') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.snap_token){
                snap.pay(data.snap_token, {
                    onSuccess: function(result){ alert("Pembayaran Berhasil"); },
                    onPending: function(result){ alert("Menunggu Pembayaran"); },
                    onError: function(result){ alert("Pembayaran Gagal"); }
                });
            } else {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error(error);
            alert("Gagal mengambil token pembayaran");
        });
    });
});
</script>
@endpush