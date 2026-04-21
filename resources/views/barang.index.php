<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="{{ asset('css/barang.css') }}">
</head>
<body>

<h2>Data Barang</h2>
<a href="{{ route('barang.create') }}" class="btn">Tambah Barang</a>

<table>
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jenis</th>
        <th>Satuan</th>
        <th>Stok</th>
    </tr>
    @foreach($barang as $b)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $b->nama_barang }}</td>
        <td>{{ $b->jenis_barang }}</td>
        <td>{{ $b->satuan }}</td>
        <td>{{ $b->stok_unit }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
