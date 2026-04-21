@extends('layouts.app', ['title' => 'Tambah Stok Keluar'])

@section('content')
<h1 class="page-title">Tambah Stok Keluar</h1>
<div class="divider"></div>

<div class="card" style="max-width: 720px;">
    <form method="POST" action="{{ route('stok-keluar.store') }}" class="form">
        @csrf

        <label class="label">Barang</label>
        <select name="barang_id" class="input" required>
            <option value="">-- pilih barang --</option>
            @foreach($barangs as $b)
                <option value="{{ $b->id }}">{{ $b->kode_barang }} — {{ $b->nama_barang }}</option>
            @endforeach
        </select>
        @error('barang_id') <div class="error">{{ $message }}</div> @enderror

        <label class="label">Jumlah Unit</label>
        <input name="jumlah_unit" class="input" placeholder="contoh: 3 Helai / 78 pcs / 101 gram" required>
        @error('jumlah_unit') <div class="error">{{ $message }}</div> @enderror

        <label class="label">Tanggal</label>
        <input type="date" name="tanggal" class="input" required>
        @error('tanggal') <div class="error">{{ $message }}</div> @enderror

        <label class="label">Gudang</label>
        <input name="gudang" class="input" placeholder="contoh: Gudang Penjualan">
        @error('gudang') <div class="error">{{ $message }}</div> @enderror

        <div style="display:flex; gap:10px; margin-top:16px;">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-ghost" href="{{ route('stok-keluar.index') }}">Batal</a>
        </div>
    </form>
</div>
@endsection
