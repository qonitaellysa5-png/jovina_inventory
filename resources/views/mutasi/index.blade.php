@extends('app')

@section('title', 'Mutasi')

@section('content')
<style>
/* ========================= LAYOUT ========================= */
.top-strip{
    background:#F2CC8E;
    padding:14px 22px;
    font-weight:700;
    border-radius:0;
    box-shadow:0 6px 14px rgba(0,0,0,.12);
}

.page-area{
    padding:22px;
    background:#f5f6fa;
    min-height:calc(100vh - 60px);
}

.page-title{
    font-size:28px;
    font-weight:700;
    margin:0 0 16px;
    color:#1f1f1f;
}

.card-white{
    background:#fff;
    border-radius:12px;
    box-shadow:0 8px 18px rgba(0,0,0,.12);
    padding:18px;
}

.toolbar-2row{
    margin-bottom:12px;
}

.tb-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
}

.tb-row-1{
    margin-bottom:8px;
}

.tb-left{
    display:flex;
    align-items:center;
    gap:18px;
    flex-wrap:wrap;
}

.tb-right{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;           
    justify-content:flex-end;
    margin-left:auto;
}

.date-one,
.show-rows{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:13px;
    color:#444;
    white-space:nowrap;
}

#limitSelect,
#datePick{
    height:30px;
    border:1px solid #dde3ee;
    border-radius:6px;
    padding:0 10px;
    background:#fff;
    outline:none;
    font-size:13px;
}

.searchbox{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:13px;
    color:#444;
    white-space:nowrap;
}

.searchbox input{
    width:160px;
    height:30px;
    border:1px solid #dde3ee;
    border-radius:6px;
    padding:0 10px;
    outline:none;
    font-size:13px;
    background:#fff;
}

.select-btn-wrap{
    position:relative;
    display:inline-flex;
    align-items:center;
}

.select-like-btn{
    height:30px;
    border:1px solid #6c757d;
    border-radius:6px;
    padding:0 34px 0 12px;
    font-size:13px;
    font-weight:600;
    color:#444;
    background:#fff;
    outline:none;
    cursor:pointer;
    min-width:150px;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
}

.select-btn-wrap:after{
    content:"\f078";
    font-family:"Font Awesome 6 Free";
    font-weight:900;
    position:absolute;
    right:12px;
    font-size:12px;
    color:#6c757d;
    pointer-events:none;
}


@media (max-width:1200px){
    .tb-row-2{
        flex-direction:column;
        align-items:stretch;
    }
    .tb-row-2 .tb-right{
        justify-content:flex-start;
    }
    .searchbox input{
        width:100%;
    }
}

/* ========================= TABLE ========================= */
.table-wrap{
    border:1px solid #dfe6f1;
    border-radius:0;
    overflow:hidden;
    background:#fff;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

thead th{
    background:#f3cf8c;
    padding:10px 10px;
    font-weight:700;
    text-align:center;
    border-right:1px solid #dfe6f1;
    border-bottom:1px solid #dfe6f1;
    white-space:nowrap;
}

thead th:last-child{
    border-right:none;
}

tbody td{
    padding:10px 10px;
    border-right:1px solid #dfe6f1;
    border-bottom:1px solid #dfe6f1;
    vertical-align:middle;
}

tbody td:last-child{
    border-right:none;
}

tbody tr:last-child td{
    border-bottom:none;
}

.badge-status{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:4px 10px;
    border-radius:10px;
    font-size:12px;
    background:#e9ecef;
    color:#333;
    font-weight:600;
    white-space:nowrap;
}

.aksi{
    display:flex;
    justify-content:center;
    gap:10px;
}

.btn-act{
    width:32px;
    height:32px;
    border-radius:6px;
    border:1px solid #dde3ee;
    background:#fff;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}

.btn-act:hover{
    background:#f6f7fb;
}

.btn-edit i{
    color:#2a7de1;
}

.btn-del i{
    color:#e04b4b;
}

.pager{
    display:flex;
    justify-content:flex-end;
    gap:8px;
    margin-top:14px;
    user-select:none;
}

.pg{
    width:34px;
    height:34px;
    border:1px solid #dde3ee;
    background:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    font-size:13px;
    color:#333;
}

.pg:hover{
    background:#f6f7fb;
}

.pg.active{
    background:#2f2626;
    color:#fff;
    border-color:#2f2626;
}

.pg-wide{
    width:auto;
    padding:0 12px;
    border-radius:18px;
}

.dots{
    border:none;
    background:transparent;
    cursor:default;
    padding:0 6px;
    width:auto;
}

/* ========================= PRINT ========================= */
@media print{
    .sidebar,
    .top-strip,
    .toolbar-2row,
    .pager,
    .btn,
    .dropdown,
    .searchbox,
    .select-btn-wrap{
        display:none !important;
    }

    body{
        background:#fff !important;
        padding:0 !important;
    }

    .page-area{
        padding:0 !important;
    }

    .card-white{
        box-shadow:none !important;
    }
}

.modal{
    z-index:2000 !important;
}

.modal-backdrop{
    z-index:1990 !important;
}

/* ========================= MODAL TAMBAH ========================= */
#addModal .modal-dialog{
    max-width:560px;
}

#addModal .modal-content{
    border-radius:6px;
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    border:1px solid rgba(0,0,0,.08);
}

#addModal .modal-header{
    border-bottom:none;
    padding:18px 22px 6px;
}

#addModal .modal-title{
    font-size:26px;
    font-weight:500;
    letter-spacing:.2px;
}

#addModal .modal-body{
    padding:10px 22px 16px;
}

#addModal label{
    font-size:12px;
    color:#222;
    margin-bottom:6px;
}

#addModal .req{
    color:#e53935;
    font-weight:700;
}

#addModal .form-control,
#addModal select{
    height:30px;
    border-radius:3px;
    font-size:13px;
}

#addModal .modal-footer{
    border-top:none;
    padding:10px 22px 20px;
    justify-content:center;
    gap:18px;
}

#addModal .btn-save{
    background:#1fb289;
    border:none;
    padding:8px 24px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:88px;
}

#addModal .btn-cancel{
    background:#f05e5e;
    border:none;
    padding:8px 24px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:88px;
}

/* ========================= MODAL SUCCESS ========================= */
#successModal .modal-dialog{
    max-width:520px;
}

#successModal .modal-content{
    border-radius:6px;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    padding:26px 18px 22px;
    text-align:center;
}

#successModal .check{
    font-size:44px;
    color:#7acb7a;
    margin-bottom:10px;
}

#successModal h5{
    margin:0;
    font-size:20px;
    font-weight:600;
    color:#111;
}

#successModal p{
    margin:8px 0 0;
    font-size:12px;
    color:#444;
}
</style>

@php
    $opsiGudang = ['Gudang Masuk','Gudang Penjualan','Gudang Retur','Gudang Rusak'];
@endphp

<div class="top-strip">Jovina Inventory</div>

<div class="page-area">
    <div class="page-title">Mutasi</div>

    <div class="card-white">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="toolbar-2row">
            <div class="tb-row tb-row-1">
                <div class="tb-left">
                    <div class="date-one">
                        <span>Tanggal :</span>
                        <input type="date" id="datePick">
                    </div>
                </div>

                <div class="tb-right">
                    <button type="button"
                            class="btn btn-success btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#addModal">
                        <i class="fa fa-plus"></i> Tambah Mutasi
                    </button>
                </div>
            </div>

            <div class="tb-row tb-row-2">
                <div class="tb-left">
                    <div class="show-rows">
                        <span>Tampilkan</span>
                        <select id="limitSelect">
                            <option selected>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span>Data</span>
                    </div>
                </div>

                <div class="tb-right">
                    <div class="select-btn-wrap" title="Gudang Asal">
                        <select id="filterGudangAsal" class="select-like-btn">
                            <option value="">Gudang Asal</option>
                            @foreach($opsiGudang as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach

                            @if(isset($gudangs))
                                @foreach($gudangs as $g)
                                    @if(!in_array($g->nama, $opsiGudang))
                                        <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="select-btn-wrap" title="Gudang Tujuan">
                        <select id="filterGudangTujuan" class="select-like-btn">
                            <option value="">Gudang Tujuan</option>
                            @foreach($opsiGudang as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach

                            @if(isset($gudangs))
                                @foreach($gudangs as $g)
                                    @if(!in_array($g->nama, $opsiGudang))
                                        <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <button type="button"
                            onclick="window.print()"
                            class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-print"></i> Cetak
                    </button>

                    <div class="dropdown">
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown">
                            <i class="fa fa-file-export"></i> Ekspor
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-file-excel text-success"></i> Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-file-pdf text-danger"></i> PDF
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown">
                            <i class="fa fa-file-import"></i> Impor
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width:260px;">
                            <div class="fw-bold mb-2" style="font-size:13px;">
                                Impor Data
                            </div>

                            <form method="POST" enctype="multipart/form-data" class="mb-2">
                                @csrf
                                <input type="file" name="file" class="form-control form-control-sm mb-2">
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="fa fa-file-excel"></i> Impor Excel
                                </button>
                            </form>

                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="form-control form-control-sm mb-2">
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fa fa-file-pdf"></i> Impor PDF
                                </button>
                            </form>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown">
                            <i class="fa fa-eye-slash"></i> Kolom
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            @php
                                $columns = [
                                    'no','kode_barang','nama_barang','gudang_asal','gudang_tujuan',
                                    'tanggal_transaksi','jumlah','status','keterangan','aksi'
                                ];
                            @endphp

                            @foreach($columns as $col)
                                <li class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input column-toggle"
                                               type="checkbox"
                                               data-column="{{ $col }}"
                                               checked
                                               id="col-{{ $col }}">
                                        <label class="form-check-label" for="col-{{ $col }}">
                                            {{ ucwords(str_replace('_',' ',$col)) }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="searchbox">
                        <span>Cari</span>
                        <input type="text" id="searchInput" />
                    </div>
                </div>
            </div>
        </div>

        <div class="table-wrap">
            <table id="MutasiTable">
                <thead>
                    <tr>
                        <th class="col-no" style="width:60px;">No</th>
                        <th class="col-kode_barang" style="width:120px;">Kode Barang</th>
                        <th class="col-nama_barang">Nama Barang</th>
                        <th class="col-gudang_asal" style="width:140px;">Gudang Asal</th>
                        <th class="col-gudang_tujuan" style="width:140px;">Gudang Tujuan</th>
                        <th class="col-tanggal_transaksi" style="width:140px;">Tanggal Transaksi</th>
                        <th class="col-jumlah" style="width:100px;">Jumlah</th>
                        <th class="col-status" style="width:110px;">Status</th>
                        <th class="col-keterangan">Keterangan</th>
                        <th class="col-aksi" style="width:120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rows as $i => $s)
                        @php $idx = $i + 1; @endphp

                        <tr data-trx="{{ $s->tanggal_transaksi }}"
                            data-asal="{{ $s->gudang_asal }}"
                            data-tujuan="{{ $s->gudang_tujuan }}">

                            <td class="col-no" style="text-align:center;">{{ $idx }}</td>
                            <td class="col-kode_barang" style="text-align:center;">{{ $s->kode }}</td>
                            <td class="col-nama_barang">{{ $s->nama }}</td>
                            <td class="col-gudang_asal" style="text-align:center;">{{ $s->gudang_asal }}</td>
                            <td class="col-gudang_tujuan" style="text-align:center;">{{ $s->gudang_tujuan }}</td>
                            <td class="col-tanggal_transaksi" style="text-align:center;">{{ $s->tanggal_transaksi }}</td>
                            <td class="col-jumlah" style="text-align:center;">{{ $s->jumlah }}</td>
                            <td class="col-status" style="text-align:center;">
                                <span class="badge-status">{{ $s->status }}</span>
                            </td>
                            <td class="col-keterangan">{{ $s->keterangan }}</td>
                            <td class="col-aksi">
                                <div class="aksi">
                                    <button type="button"
                                            class="btn-act btn-edit"
                                            title="Edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $s->mutasi_id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button type="button"
                                            class="btn-act btn-del"
                                            title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $s->mutasi_id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        @include('mutasi.modal', [
                            'i' => $s->mutasi_id,
                            's' => $s,
                            'opsiGudang' => $opsiGudang,
                            'gudangs' => $gudangs ?? collect()
                        ])
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                Belum ada data mutasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- =================== MODAL TAMBAH MUTASI =================== -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('mutasi.store') }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mutasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label>Kode Barang<span class="req">*</span></label>
                            <input type="text" name="kode_barang" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Nama Barang<span class="req">*</span></label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Jenis Barang</label>
                            <input type="text" name="jenis_barang" class="form-control" placeholder="Persediaan">
                        </div>
                        <div class="col-6">
                            <label>Satuan</label>
                            <input type="text" name="satuan_barang" class="form-control" placeholder="pcs/helai">
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Gudang Asal<span class="req">*</span></label>
                            <select name="gudang_asal_nama" class="form-control" required>
                                <option value="">-- Pilih Gudang --</option>
                                @foreach($opsiGudang as $g)
                                    <option value="{{ $g }}">{{ $g }}</option>
                                @endforeach
                                @if(isset($gudangs))
                                    @foreach($gudangs as $g)
                                        @if(!in_array($g->nama, $opsiGudang))
                                            <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-6">
                            <label>Gudang Tujuan<span class="req">*</span></label>
                            <select name="gudang_tujuan_nama" class="form-control" required>
                                <option value="">-- Pilih Gudang --</option>
                                @foreach($opsiGudang as $g)
                                    <option value="{{ $g }}">{{ $g }}</option>
                                @endforeach
                                @if(isset($gudangs))
                                    @foreach($gudangs as $g)
                                        @if(!in_array($g->nama, $opsiGudang))
                                            <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Jumlah<span class="req">*</span></label>
                            <input type="number" name="jumlah" class="form-control" required min="1">
                        </div>
                        <div class="col-6">
                            <label>Tanggal Transaksi<span class="req">*</span></label>
                            <input type="date" name="tanggal_transaksi" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Status<span class="req">*</span></label>
                            <input type="text" name="status" class="form-control" value="Mutasi" required>
                        </div>
                        <div class="col-6">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Pemindahan">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-save">Simpan</button>
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- =================== POPUP BERHASIL =================== -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="check"><i class="fa fa-check"></i></div>
            <h5>Berhasil!</h5>
            <p id="successText">Sukses</p>
        </div>
    </div>
</div>

@push('scripts')
<script>

    document.querySelectorAll('.column-toggle').forEach(cb => {
        cb.addEventListener('change', function(){
            const col = this.dataset.column;
            document.querySelectorAll('.col-' + col).forEach(el => {
                el.style.display = this.checked ? '' : 'none';
            });
        });
    });

    function applyLimitOnly(){
        const limit = parseInt(document.getElementById('limitSelect')?.value || '10', 10);
        const visible = Array.from(document.querySelectorAll('#MutasiTable tbody tr'))
            .filter(r => r.style.display !== 'none');

        visible.forEach((r, idx) => {
            r.style.display = (idx < limit) ? '' : 'none';
        });
    }

    function applyAllFilters(){
        const t = document.getElementById('datePick')?.value || '';
        const asal = document.getElementById('filterGudangAsal')?.value || '';
        const tujuan = document.getElementById('filterGudangTujuan')?.value || '';
        const q = (document.getElementById('searchInput')?.value || '').toLowerCase();

        document.querySelectorAll('#MutasiTable tbody tr').forEach(row => {
            const rT = row.dataset.trx || '';
            const rA = row.dataset.asal || '';
            const rTu = row.dataset.tujuan || '';

            const okT = !t || (rT === t);
            const okA = !asal || (rA === asal);
            const okTu = !tujuan || (rTu === tujuan);

            const okSearch = !q || Array.from(row.cells).some(td =>
                (td.textContent || '').toLowerCase().includes(q)
            );

            row.style.display = (okT && okA && okTu && okSearch) ? '' : 'none';
        });

        applyLimitOnly();
    }

    document.getElementById('searchInput')?.addEventListener('keyup', applyAllFilters);
    document.getElementById('datePick')?.addEventListener('change', applyAllFilters);
    document.getElementById('filterGudangAsal')?.addEventListener('change', applyAllFilters);
    document.getElementById('filterGudangTujuan')?.addEventListener('change', applyAllFilters);
    document.getElementById('limitSelect')?.addEventListener('change', applyAllFilters);

    // Popup sukses 
    function showSuccess(msg){
        document.getElementById('successText').textContent = msg;

        const el = document.getElementById('successModal');
        const m = new bootstrap.Modal(el);

        m.show();
        setTimeout(() => bootstrap.Modal.getInstance(el)?.hide(), 1600);
    }

    @if(session('success_add'))
        window.addEventListener('load', () => showSuccess('Data mutasi berhasil ditambahkan!'));
    @endif
    @if(session('success_update'))
        window.addEventListener('load', () => showSuccess('Data mutasi berhasil diperbarui!'));
    @endif
    @if(session('success_delete'))
        window.addEventListener('load', () => showSuccess('Data mutasi berhasil dihapus!'));
    @endif

    applyAllFilters();
</script>
@endpush
@endsection