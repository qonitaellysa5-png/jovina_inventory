@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Stok Masuk</h1>
    <form action="{{ route('stok_masuk.update', $stokMasuk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $stokMasuk->kode_barang }}" required>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $stokMasuk->nama_barang }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_barang">Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="{{ $stokMasuk->jenis_barang }}" required>
        </div>
        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $stokMasuk->satuan }}" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $stokMasuk->jumlah }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $stokMasuk->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="gudang">Gudang</label>
            <input type="text" class="form-control" id="gudang" name="gudang" value="{{ $stokMasuk->gudang }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
