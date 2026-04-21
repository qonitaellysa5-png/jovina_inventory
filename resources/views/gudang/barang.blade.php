@extends('app')

@section('title', 'Gudang - ' . ($gudang->nama ?? ''))

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
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        flex-wrap:wrap;
    }

    .card-white{
        background:#fff;
        border-radius:12px;
        box-shadow:0 8px 18px rgba(0,0,0,.12);
        padding:18px;
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
        flex-wrap:wrap;
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
        width:180px;
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

    @media print {
        .sidebar, .top-strip, .toolbar, .btn, .dropdown, .searchbox, .pagination, .back-btn { display:none !important; }
        body{ background:#fff !important; padding:0 !important; }
        .page-area{ padding:0 !important; }
        .card-white{ box-shadow:none !important; }
    }
</style>

<div class="top-strip">Jovina Inventory</div>

<div class="page-area">
    <div class="page-title">
        <div>Gudang: {{ $gudang->nama }}</div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('gudang') }}" class="btn btn-outline-secondary btn-sm back-btn">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <button type="button" onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <div class="card-white">

        <div class="toolbar">
            <div class="toolbar-left">
                <span>Tampilkan</span>

                <select id="limitSelect">
                    <option value="10"  {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25"  {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50"  {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100</option>
                </select>

                <span>Data</span>
            </div>

            <div class="toolbar-right">
                <div class="searchbox">
                    <span>Cari</span>
                    <input type="text" id="searchInput" placeholder="kode / nama / jenis..." />
                </div>
            </div>
        </div>

        <div class="table-wrap">
            <table id="barangGudangTable">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th style="width:130px;">Kode Barang</th>
                        <th>Nama Barang</th>
                        <th style="width:140px;">Jenis Barang</th>
                        <th style="width:90px;">Satuan</th>
                        <th style="width:150px;">Stok Unit</th>
                        <th style="width:160px;">Stok dapat dijual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $i => $b)
                        @php $idx = $barangs->firstItem() + $i; @endphp
                        <tr>
                            <td style="text-align:center;">{{ $idx }}</td>
                            <td style="text-align:center;">{{ $b->kode }}</td>
                            <td>{{ $b->nama }}</td>
                            <td style="text-align:center;">{{ $b->jenis }}</td>
                            <td style="text-align:center;">{{ $b->satuan }}</td>
                            <td style="text-align:center;">{{ $b->stok_unit }} {{ $b->satuan }}</td>
                            <td style="text-align:center;">{{ $b->stok_dapat_dijual }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:16px;">
                                Belum ada data barang di {{ $gudang->nama }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $barangs->appends(request()->query())->links() }}
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchInput')?.addEventListener('keyup', function(){
        const val = this.value.toLowerCase();
        document.querySelectorAll('#barangGudangTable tbody tr').forEach(row => {
            row.style.display = Array.from(row.cells).some(td => td.textContent.toLowerCase().includes(val)) ? '' : 'none';
        });
    });

    document.getElementById('limitSelect')?.addEventListener('change', function () {
        const perPage = this.value;

        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.delete('page');

        window.location.href = url.toString();
    });
</script>
@endpush
@endsection