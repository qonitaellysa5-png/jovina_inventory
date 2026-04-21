<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jovina Inventory</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="{{ asset('images/jovina_logo.png') }}" alt="Logo Jovina">
            <div class="profile-info">
                <img src="{{ asset('images/profile_icon.png') }}" alt="Profile Icon">
                <span>Dian - Admin</span>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Data Barang</a></li>
            <li><a href="#">Stok Masuk</a></li>
            <li><a href="#">Stok Keluar</a></li>
            <li><a href="#">Retur</a></li>
            <li><a href="#">Mutasi</a></li>
            <li><a href="#">Gudang</a></li>
            <li><a href="#">Keluar</a></li>
        </ul>
    </nav>

    <!-- Content Section -->
    <section class="content">
        <h2>Stok Masuk</h2>
        <div class="date-and-buttons">
            <span>{{ date('d/m/Y') }}</span>
            <button class="add-item">+ Tambah Barang</button>
        </div>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Satuan</th>
                    <th>Stok Unit</th>
                    <th>Gudang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['kode'] }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['jenis'] }}</td>
                        <td>{{ $item['satuan'] }}</td>
                        <td>{{ $item['stok'] }}</td>
                        <td>{{ $item['gudang'] }}</td>
                        <td><button>Masukkan Gudang</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <span><</span> <span>1</span> <span>2</span> <span>3</span> <span>...</span> <span>></span>
        </div>
    </section>
</body>
</html>
