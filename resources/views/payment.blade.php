@extends('layouts.app')

@section('title', 'Pembayaran - Jovina Inventory')

@section('content')
<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="p-4 text-white" style="background: #3b2a1a;">
                    <h5 class="mb-0"><i class="fa fa-credit-card me-2"></i> Ringkasan Pembayaran</h5>
                    <small style="color: #efa122;">Pastikan data pesanan sudah sesuai sebelum membayar</small>
                </div>

                <div class="card-body p-4 bg-white">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <img src="{{ asset('images/item-sample.jpg') }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover; background: #eee;">
                        <div class="ms-3">
                            <h6 class="mb-1 fw-bold">Hair Extension Premium - Black</h6>
                            <p class="text-muted small mb-0">Jumlah: 1 Unit</p>
                            <span class="fw-bold" style="color: #3b2a1a;">Rp 299.900</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-muted">Voucher & Diskon</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Masukkan kode promo">
                            <button class="btn btn-outline-dark btn-sm" type="button">Gunakan</button>
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Jumlah Pesanan</span>
                            <span>Rp 299.900</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Biaya Layanan</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold h5 mb-0">TOTAL</span>
                            <span class="fw-bold h4 mb-0" style="color: #3b2a1a;">Rp 299.900</span>
                        </div>
                    </div>

                    <button id="pay-button" class="btn w-100 py-3 fw-bold text-white shadow-sm" 
                            style="background: #efa122; border: none; border-radius: 10px; font-size: 16px;">
                        LANJUT KE PEMBAYARAN
                    </button>

                    <div class="text-center mt-4">
                        <p class="small text-muted mb-2">Metode pembayaran yang tersedia (via Midtrans):</p>
                        <div class="d-flex justify-content-center gap-3 grayscale opacity-75" style="filter: grayscale(1);">
                            <i class="fab fa-cc-visa fa-2x"></i>
                            <i class="fab fa-cc-mastercard fa-2x"></i>
                            <i class="fa fa-university fa-2x"></i>
                            <i class="fa fa-wallet fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Pakai Client Key Sandbox kamu --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-yOHcUWdTe2BCrccK"></script>

<script>
    const payButton = document.getElementById('pay-button');
    
    payButton.addEventListener('click', function (e) {
        e.preventDefault();

        // Ambil token dari controller lewat route process yang kamu buat
        fetch("{{ route('payment.process') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.snap_token) {
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) { alert("Sukses!"); },
                    onPending: function(result) { alert("Menunggu..."); },
                    onError: function(result) { alert("Gagal!"); }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil token pembayaran');
        });
    });
</script>
@endpush