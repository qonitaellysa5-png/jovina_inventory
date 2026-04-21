<!-- Form untuk menambah stok masuk -->
<form action="{{ route('stok-masuk.store') }}" method="POST">
    @csrf
    <div>
        <label for="kode">Kode Barang</label>
        <input type="text" id="kode" name="kode" required>
    </div>
    <div>
        <label for="nama">Nama Barang</label>
        <input type="text" id="nama" name="nama" required>
    </div>
    <div>
        <label for="jenis">Jenis Barang</label>
        <input type="text" id="jenis" name="jenis" required>
    </div>
    <div>
        <label for="jumlah">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" required>
    </div>
    <div>
        <label for="tanggal">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" required>
    </div>
    <div>
        <label for="gudang">Gudang</label>
        <input type="text" id="gudang" name="gudang" required>
    </div>
    <button type="submit">Simpan</button>
</form>
