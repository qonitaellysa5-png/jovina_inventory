@extends('app')

@section('title', 'Data Barang')

@section('content')
<style>
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
        min-height: calc(100vh - 60px);
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

    .top-actions{
        display:flex;
        justify-content:flex-end;
        margin-bottom:8px;
    }

    .toolbar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        flex-wrap:wrap;
        margin-bottom:12px;
    }

    .toolbar-left{
        display:flex;
        align-items:center;
        gap:10px;
        font-size:13px;
        color:#444;
    }

    .toolbar-left select{
        height:30px;
        border:1px solid #dde3ee;
        border-radius:6px;
        padding:0 10px;
        background:#fff;
        outline:none;
        font-size:13px;
    }

    .toolbar-right{
        display:flex;
        align-items:center;
        gap:10px;
        margin-left:auto;
        flex-wrap:wrap;
    }

    .searchbox{
        display:flex;
        align-items:center;
        gap:10px;
        font-size:13px;
        color:#444;
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
    thead th:last-child{ border-right:none; }

    tbody td{
        padding:10px 10px;
        border-right:1px solid #dfe6f1;
        border-bottom:1px solid #dfe6f1;
        vertical-align:middle;
    }
    tbody td:last-child{ border-right:none; }
    tbody tr:last-child td{ border-bottom:none; }

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
    .btn-act:hover{ background:#f6f7fb; }
    .btn-edit i{ color:#2a7de1; }
    .btn-del i{ color:#e04b4b; }

    @media print {
        .sidebar, .top-strip, .top-actions, .toolbar, .pager, .btn, .dropdown, .searchbox { display:none !important; }
        body{ background:#fff !important; padding:0 !important; }
        .page-area{ padding:0 !important; }
        .card-white{ box-shadow:none !important; }
    }

    .modal { z-index: 2000 !important; }
    .modal-backdrop { z-index: 1990 !important; }
</style>

<div class="top-strip">Jovina Inventory</div>

<div class="page-area">
    <div class="page-title">Data Barang</div>

    @if($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-1">Gagal:</div>
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-white">

        <div class="top-actions">
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fa fa-plus"></i> Tambah Barang
            </button>
        </div>

        <div class="toolbar">
            <div class="toolbar-left">
                <span>Tampilkan</span>
                <select id="limitSelect" disabled>
                    <option selected>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <span>Data</span>
            </div>

            <div class="toolbar-right">
                <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-print"></i> Cetak
                </button>

                <div class="dropdown">
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-file-export"></i> Ekspor
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('barang.export.excel') }}">
                                <i class="fa fa-file-excel text-success"></i> Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('barang.export.pdf') }}">
                                <i class="fa fa-file-pdf text-danger"></i> PDF
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown">
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-file-import"></i> Impor
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width:260px;">
                        <div class="fw-bold mb-2" style="font-size:13px;">Impor Data</div>

                        <form method="POST" action="{{ route('barang.import.excel') }}" enctype="multipart/form-data" class="mb-2">
                            @csrf
                            <input type="file" name="file" class="form-control form-control-sm mb-2">
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                <i class="fa fa-file-excel"></i> Impor Excel
                            </button>
                        </form>

                        <form method="POST" action="{{ route('barang.import.pdf') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control form-control-sm mb-2">
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fa fa-file-pdf"></i> Impor PDF
                            </button>
                        </form>
                    </ul>
                </div>

                <div class="dropdown">
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-eye-slash"></i> Kolom
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-3">
                        @php $columns = ['no','kode','nama','jenis','satuan','stok_unit','stok_dapat_dijual','gudang','aksi']; @endphp
                        @foreach($columns as $col)
                            <li class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input column-toggle" type="checkbox" data-column="{{ $col }}" checked id="col-{{ $col }}">
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

        <div class="table-wrap">
            <table id="barangTable">
                <thead>
                    <tr>
                        <th class="col-no" style="width:60px;">No</th>
                        <th class="col-kode" style="width:130px;">Kode Barang</th>
                        <th class="col-nama">Nama Barang</th>
                        <th class="col-jenis" style="width:140px;">Jenis Barang</th>
                        <th class="col-satuan" style="width:90px;">Satuan</th>
                        <th class="col-stok_unit" style="width:150px;">Stok Unit</th>
                        <th class="col-stok_dapat_dijual" style="width:160px;">Stok dapat dijual</th>
                        <th class="col-gudang" style="width:140px;">Gudang</th>
                        <th class="col-aksi" style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $i => $b)
                        @php $idx = $barangs->firstItem() + $i; @endphp
                        <tr>
                            <td class="col-no" style="text-align:center;">{{ $idx }}</td>
                            <td class="col-kode">{{ $b->kode_barang }}</td>
                            <td class="col-nama">{{ $b->nama_barang }}</td>
                            <td class="col-jenis" style="text-align:center;">{{ $b->jenis }}</td>
                            <td class="col-satuan" style="text-align:center;">{{ $b->satuan }}</td>
                            <td class="col-stok_unit" style="text-align:center;">{{ $b->stok_unit }} {{ $b->satuan }}</td>
                            <td class="col-stok_dapat_dijual" style="text-align:center;">{{ $b->stok_dapat_dijual }}</td>
                            <td class="col-gudang" style="text-align:center;">{{ $b->gudang?->nama ?? '-' }}</td>
                            <td class="col-aksi">
                                <div class="aksi">
                                    <button type="button"
                                            class="btn-act btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $b->id }}"
                                            title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button type="button"
                                            class="btn-act btn-del"
                                            data-delete-form="formDeleteBarang{{ $b->id }}"
                                            data-delete-nama="{{ $b->nama }}"
                                            title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        
                        @include('barang.modal', ['mode' => 'row', 'b' => $b, 'gudangs' => $gudangs])
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $barangs->links() }}
        </div>

    </div>
</div>


@include('barang.modal', ['mode' => 'global', 'gudangs' => $gudangs])

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

    document.getElementById('searchInput')?.addEventListener('keyup', function(){
        const val = this.value.toLowerCase();
        document.querySelectorAll('#barangTable tbody tr').forEach(row => {
            row.style.display = Array.from(row.cells).some(td => td.textContent.toLowerCase().includes(val)) ? '' : 'none';
        });
    });

    let deleteFormToSubmit = null;

    document.querySelectorAll('[data-delete-form]').forEach(btn => {
        btn.addEventListener('click', function(){
            const formId = this.getAttribute('data-delete-form');
            const nama = this.getAttribute('data-delete-nama') || '';
            deleteFormToSubmit = document.getElementById(formId);

            const textEl = document.getElementById('confirmDeleteText');
            if(textEl){
                textEl.textContent = `Data "${nama}" akan dihapus dan tidak dapat dikembalikan!`;
            }

            new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
        });
    });

    document.getElementById('btnConfirmDelete')?.addEventListener('click', function(){
        if(deleteFormToSubmit) deleteFormToSubmit.submit();
    });

    @if(session('toast'))
        (function(){
            const toast = @json(session('toast'));
            const el = document.getElementById('successModal');
            if(!el) return;

            document.getElementById('successTitle').textContent = toast.title || 'Berhasil!';
            document.getElementById('successMessage').textContent = toast.message || '';

            const mOk = new bootstrap.Modal(el);
            mOk.show();

            setTimeout(() => {
                bootstrap.Modal.getInstance(el)?.hide();
            }, 1600);
        })();
    @endif
</script>
@endpush
@endsection