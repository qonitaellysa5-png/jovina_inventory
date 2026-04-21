<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Keluar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Logo Jovina -->
            <div class="logo">
                <img src="logo-jovina.png" alt="Logo Jovina" class="logo-img">
                <h1>Jovina Inventaris</h1>
            </div>

            <!-- Menu Navigasi -->
            <nav>
                <ul>
                    <li><a href="#">Dasbor</a></li>
                    <li><a href="#">Data Barang</a></li>
                    <li><a href="#">Stok Masuk</a></li>
                    <li><a href="#">Stok Keluar</a></li>
                    <li><a href="#">Mutasi</a></li>
                    <li><a href="#">Retur</a></li>
                    <li><a href="#">Gudang</a></li>
                    <li><a href="#">Keluar</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <!-- Profil Admin -->
                <div class="profile">
                    <img src="profile-logo.png" alt="Logo Profil" class="profile-img">
                    <p>Dian-Admin</p>
                </div>
                <!-- Tanggal Sekarang -->
                <div class="date">
                    <img src="date-logo.png" alt="Logo Tanggal" class="date-img">
                    <p>{{ date('d/m/Y') }}</p>
                </div>
            </div>

            <h2 class="section-title">STOK KELUAR</h2>

            <div class="actions">
                <button class="add-item" style="background-color: #25BA9C;">+ Tambah Barang</button>
                <div class="export-import">
                    <button class="btn-cetak">Cetak</button>
                    <button class="btn-import">Import</button>
                    <button class="btn-export">Ekspor</button>
                </div>
            </div>

            <!-- Tabel Barang -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Barang Jenis</th>
                            <th>Satuan</th>
                            <th>Unit Stok</th>
                            <th>Gudang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->barang_jenis }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->unit_stok }}</td>
                                <td>{{ $item->gudang }}</td>
                                <td><button>Aksi</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $barang->links() }}
            </div>
        </div>
    </div>
</body>
</html>
