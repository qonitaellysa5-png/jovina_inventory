@extends('app')

@section('title', 'Stok Keluar')

@section('content')
<style>
/* ================= TOP ================= */
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

/* ================= TOOLBAR ================= */
.toolbar-2row{ margin-bottom:12px; }
.tb-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
    flex-wrap:wrap;           
}
.tb-row-1{ margin-bottom:8px; }

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

/* ================= INPUT  ================= */
.date-one,
.show-rows,
.searchbox{
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

/* ================= TABLE ================= */
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

/* ================= PRINT ================= */
@media print{
    .sidebar, .top-strip, .toolbar-2row, .pagination, .btn, .dropdown, .searchbox { display:none !important; }
    body{ background:#fff !important; padding:0 !important; }
    .page-area{ padding:0 !important; }
    .card-white{ box-shadow:none !important; }
}


.modal{ z-index:2000 !important; }
.modal-backdrop{ z-index:1990 !important; }


@media (max-width: 992px){
    .tb-row{ gap:10px; }
    .tb-right{ width:100%; justify-content:flex-start; } 
}
@media (max-width: 576px){
    .searchbox input{ width:130px; }
}
</style>

<div class="top-strip">Jovina Inventory</div>

<div class="page-area">
    <div class="page-title">Stok Keluar</div>

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

        <div class="toolbar-2row">
            <div class="tb-row tb-row-1">
                <div class="tb-left">
                    <div class="date-one">
                        <span>Tanggal :</span>
                        <input type="date" id="datePick">
                    </div>
                </div>

                <div class="tb-right">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa fa-plus"></i> Tambah Stok Keluar
                    </button>
                </div>
            </div>

            <div class="tb-row tb-row-2">
                <div class="tb-left">
                    <div class="show-rows">
                        <span>Tampilkan</span>
                        <select id="limitSelect">
                            <option value="10"  {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25"  {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50"  {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span>Data</span>
                    </div>
                </div>

                <div class="tb-right">
                    <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-print"></i> Cetak
                    </button>

                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-file-export"></i> Ekspor
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('stok-keluar.export.excel') }}">
                                    <i class="fa fa-file-excel text-success"></i> Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('stok-keluar.export.pdf') }}">
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

                            <form method="POST" action="{{ route('stok-keluar.import.excel') }}" enctype="multipart/form-data" class="mb-2">
                                @csrf
                                <input type="file" name="file" class="form-control form-control-sm mb-2" accept=".xlsx,.xls,.csv" required>
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="fa fa-file-excel"></i> Impor Excel
                                </button>
                            </form>

                            <form method="POST" action="{{ route('stok-keluar.import.pdf') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="form-control form-control-sm mb-2" accept=".pdf" required>
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fa fa-file-pdf"></i> Upload PDF
                                </button>
                            </form>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-eye-slash"></i> Kolom
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            @php $columns = ['no','kode','nama','jenis','satuan','jumlah','tanggal','gudang','aksi']; @endphp
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
        </div>

        <div class="table-wrap">
            <table id="stokKeluarTable">
                <thead>
                    <tr>
                        <th class="col-no" style="width:60px;">No</th>
                        <th class="col-kode" style="width:120px;">Kode Barang</th>
                        <th class="col-nama">Nama Barang</th>
                        <th class="col-jenis" style="width:130px;">Jenis Barang</th>
                        <th class="col-satuan" style="width:90px;">Satuan</th>
                        <th class="col-jumlah" style="width:100px;">Jumlah</th>
                        <th class="col-tanggal" style="width:120px;">Tanggal</th>
                        <th class="col-gudang" style="width:140px;">Gudang</th>
                        <th class="col-aksi" style="width:110px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($stokKeluars as $i => $s)
                        <tr data-tanggal="{{ $s->tanggal?->format('Y-m-d') ?? $s->tanggal }}">
                            <td class="col-no" style="text-align:center;">{{ $stokKeluars->firstItem() + $i }}</td>
                            <td class="col-kode" style="text-align:center;">{{ $s->barang?->kode ?? '-' }}</td>
                            <td class="col-nama">{{ $s->barang?->nama ?? '-' }}</td>
                            <td class="col-jenis" style="text-align:center;">{{ $s->barang?->jenis ?? '-' }}</td>
                            <td class="col-satuan" style="text-align:center;">{{ $s->barang?->satuan ?? '-' }}</td>
                            <td class="col-jumlah" style="text-align:center;">{{ $s->jumlah }}</td>
                            <td class="col-tanggal" style="text-align:center;">
                                {{ $s->tanggal?->format('Y-m-d') ?? $s->tanggal }}
                            </td>
                            <td class="col-gudang" style="text-align:center;">{{ $s->gudang?->nama ?? '-' }}</td>

                            <td class="col-aksi">
                                <div class="aksi">
                                    <button type="button"
                                            class="btn-act btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $s->id }}"
                                            title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button type="button"
                                            class="btn-act btn-del"
                                            data-delete-form="formDeleteStokKeluar{{ $s->id }}"
                                            data-delete-nama="{{ $s->barang?->nama ?? 'Data' }}"
                                            title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        @include('stokkeluar.modal', ['mode' => 'row', 's' => $s, 'gudangs' => $gudangs])
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $stokKeluars->appends(request()->query())->links() }}
        </div>

    </div>
</div>

@include('stokkeluar.modal', ['mode' => 'global', 'gudangs' => $gudangs])

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
        document.querySelectorAll('#stokKeluarTable tbody tr').forEach(row => {
            row.style.display = Array.from(row.cells).some(td => td.textContent.toLowerCase().includes(val)) ? '' : 'none';
        });
    });

    document.getElementById('datePick')?.addEventListener('change', function(){
        const picked = this.value;
        document.querySelectorAll('#stokKeluarTable tbody tr').forEach(row => {
            const tanggal = row.dataset.tanggal;
            row.style.display = (!picked || tanggal === picked) ? '' : 'none';
        });
    });

    document.getElementById('limitSelect')?.addEventListener('change', function(){
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', this.value);
        url.searchParams.delete('page');
        window.location.href = url.toString();
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