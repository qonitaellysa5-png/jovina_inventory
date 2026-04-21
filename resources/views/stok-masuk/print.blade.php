<!DOCTYPE html>
<html>
<head>
    <title>Print Stok Masuk</title>
    <style>
        body { font-family: Arial }
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid #000; padding:6px }
    </style>
</head>
<body onload="window.print()">

<h3 align="center">Data Barang - Jovina Inventory</h3>

<table>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Satuan</th>
        <th>Stok</th>
        <th>Gudang</th>
    </tr>
    @foreach($barang as $i => $b)
    <tr>
        <td>{{ $i+1 }}</td>
            <td>{{ $b->kode_barang }}</td>
            <td>{{ $b->nama_barang }}</td>
            <td>{{ $b->jenis_barang }}</td>
            <td>{{ $b->satuan }}</td>
            <td>{{ $b->stok }}</td>
            <td>{{ $b->gudang }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>