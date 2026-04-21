@extends('gudang.app')

@section('title', 'Gudang')
@section('header', 'Gudang')

@section('content')

<style>

.top-strip{
    background:#F2CC8E;
    padding:14px 22px;
    font-weight:700;
    box-shadow:0 6px 14px rgba(0,0,0,.12);
    margin-bottom:18px;
}
.page-area{
    padding:22px;
    background:#f5f6fa;
    min-height: calc(100vh - 60px);
}
.page-title{
    font-size:26px;
    font-weight:700;
}


.gudang-card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 8px 18px rgba(0,0,0,.10);
    padding:18px;
    cursor:pointer;
    transition:.15s;
    border:1px solid rgba(0,0,0,.04);
}
.gudang-card:hover{
    transform:translateY(-1px);
    box-shadow:0 10px 22px rgba(0,0,0,.13);
}
.gudang-count{
    font-size:32px;
    font-weight:700;
    line-height:1;
    margin:0 0 6px;
}
.gudang-name{
    font-size:14px;
    font-weight:700;
    margin:0;
}
.gudang-sub{
    font-size:12px;
    color:#777;
    margin-top:4px;
}
.gudang-icon{
    font-size:38px;
    opacity:.18;
}

/* ================= MODAL TAMBAH ================= */
.modal-add-gudang .modal-dialog{
    max-width:560px;              
}
.modal-add-gudang .modal-content{
    border-radius:12px;
    border:none;
    box-shadow:0 16px 36px rgba(0,0,0,.22);
    padding:22px 26px 18px;       
}


.modal-add-gudang .m-title{
    font-size:28px;              
    font-weight:500;
    margin:0;
}
.modal-add-gudang .btn-close{
    transform:scale(1.2);         
}

/* form */
.modal-add-gudang label{
    font-size:14px;
    font-weight:500;
    margin-bottom:8px;
}
.modal-add-gudang input{
    height:40px;
    border-radius:6px;
    font-size:14px;
}

/* tombol */
.modal-add-gudang .btn-save{
    background:#1fb289;
    color:#fff;
    border:none;
    padding:10px 34px;
    border-radius:6px;
    font-size:16px;
    min-width:140px;
}
.modal-add-gudang .btn-cancel{
    background:#f06b6b;
    color:#fff;
    border:none;
    padding:10px 34px;
    border-radius:6px;
    font-size:16px;
    min-width:140px;
}

/* ================= MODAL SUKSES ================= */
.modal-success .modal-dialog{
    max-width:400px;            
}
.modal-success .modal-content{
    border-radius:12px;
    border:none;
    box-shadow:0 16px 36px rgba(0,0,0,.22);
    padding:40px 24px 34px;
    text-align:center;
    position:relative;
}


.modal-success .btn-close{
    position:absolute;
    top:16px;
    right:16px;
    transform:scale(1.2);
}


.modal-success .big-check{
    font-size:64px;
    color:#8ad48a;
    margin-bottom:16px;
    line-height:1;
}


.modal-success h5{
    font-size:30px;               
    font-weight:500;
    margin:0;
}
.modal-success p{
    font-size:14px;
    color:#555;
    margin-top:10px;
}


@media (max-width: 768px){
    .modal-success .modal-dialog{ max-width:95%; }
    .modal-add-gudang .modal-dialog{ max-width:92%; }

    .modal-add-gudang .m-title{ font-size:24px; }
    .modal-success h5{ font-size:26px; }
}
</style>

<div class="top-strip">Jovina Inventory</div>

<div class="page-area">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="page-title">Gudang</div>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahGudangModal">
            <i class="fa fa-plus"></i> Tambah Gudang
        </button>
    </div>


    <div class="row g-3">
        @php
            $gudangs = [
                ['nama'=>'Gudang Masuk','count'=>$masukCount ?? 0,'route'=>'gudang.masuk','icon'=>'fa-warehouse'],
                ['nama'=>'Gudang Penjualan','count'=>$penjualanCount ?? 0,'route'=>'gudang.penjualan','icon'=>'fa-cart-shopping'],
                ['nama'=>'Gudang Rusak','count'=>$rusakCount ?? 0,'route'=>'gudang.rusak','icon'=>'fa-bolt'],
                ['nama'=>'Gudang Retur','count'=>$returCount ?? 0,'route'=>'gudang.retur','icon'=>'fa-rotate-left'],
            ];
        @endphp

        @foreach($gudangs as $g)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="gudang-card" onclick="window.location='{{ route($g['route']) }}'">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="gudang-count">{{ $g['count'] }}</div>
                            <div class="gudang-name">{{ $g['nama'] }}</div>
                            <div class="gudang-sub">7 hari terakhir</div>
                        </div>
                        <i class="fa {{ $g['icon'] }} gudang-icon"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade modal-add-gudang" id="tambahGudangModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="formTambahGudang">
            <div class="modal-content">

                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="m-title">Tambah Gudang</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="mb-4">
                    <label>Nama Gudang</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="d-flex justify-content-center gap-4">
                    <button type="submit" class="btn-save">Simpan</button>
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL SUKSES ================= --}}
<div class="modal fade modal-success" id="modalSukses" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            <div class="big-check"><i class="fa fa-check"></i></div>
            <h5>Berhasil!</h5>
            <p>Gudang berhasil ditambahkan!</p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('formTambahGudang')?.addEventListener('submit', function(e){
    e.preventDefault();

    const addEl = document.getElementById('tambahGudangModal');
    bootstrap.Modal.getInstance(addEl)?.hide();

    const okEl = document.getElementById('modalSukses');
    new bootstrap.Modal(okEl).show();

    this.reset();
});
</script>
@endpush