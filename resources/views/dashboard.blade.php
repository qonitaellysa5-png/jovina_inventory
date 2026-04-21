@extends('app')

@section('title','Dashboard - Jovina Inventory')

@section('content')

<div class="top-bar">
    <div class="top-left">Jovina Inventory</div>
</div>

<div class="page-content">

    <h5 class="fw-bold mb-3">Dashboard</h5>

    <div class="alert alert-welcome mb-4">
        <strong>Selamat Datang!</strong> Anda telah masuk sebagai Dian - Admin
    </div>

    <div class="row g-3 mb-4">
        @php
        $cards = [
            ['Total Barang Masuk', $barangMasuk ?? 0, 'fa-arrow-down'],
            ['Total Barang Keluar', $barangKeluar ?? 0, 'fa-arrow-up'],
            ['Total Barang Mutasi', $barangMutasi ?? 0, 'fa-random'],
            ['Total Barang Retur', $barangRetur ?? 0, 'fa-rotate-left'],
            ['Total Gudang', $totalGudang ?? 0, 'fa-warehouse'],
            ['Total Stok Unit', $totalStok ?? 0, 'fa-box'],
        ];
        @endphp

        @foreach($cards as $c)
        <div class="col-md-4 col-lg-2">
            <div class="card card-box stat-card">
                <div class="stat-inner">
                    <div class="stat-text">
                        <div>{{ $c[0] }}</div>
                        <h3>{{ $c[1] }}</h3>
                        <small>7 hari terakhir</small>
                    </div>
                    <div class="stat-icon">
                        <i class="fa {{ $c[2] }}"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- CETAK -->
    <div class="d-flex justify-content-end mb-2">
        <button onclick="window.print()" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-print"></i> Cetak
        </button>
    </div>

    <!-- BOX TABEL -->
    <div class="card card-box p-3">
        <h6 class="mb-3">Daftar Produk Terlaris</h6>

        <table class="table table-bordered table-sm mb-0">
            <thead class="table-header-custom">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Satuan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Gudang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk ?? [] as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['kode'] }}</td>
                    <td>{{ $item['satuan'] }}</td>
                    <td>{{ $item['nama'] ?? '-' }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>{{ $item['gudang'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection