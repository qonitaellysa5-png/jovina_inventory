<h3>Stok Masuk Jovina Inventory</h3>
<table width="100%" border="1" cellspacing="0">
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