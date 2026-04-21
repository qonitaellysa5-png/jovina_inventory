<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6fa;
            padding-left: 220px; /* lebar sidebar */
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            background: #3b2a1a;
            color: #fff;
        }

        .sidebar .brand {
            padding: 14px;
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        .sidebar .profile {
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        .sidebar .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .sidebar .profile small {
            font-size: 11px;
            color: #9dff9d;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(239,161,34,.45);
            color: #000;
        }

        /* ================= CONTENT ================= */
        .content {
            padding: 0;
        }

        .top-bar {
            background: #F2CC8E;
            padding: 14px 24px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
        }

        .page-content {
            padding: 24px;
        }

        /* ================= KOMPONEN ================= */
        .alert-welcome {
            background: #DE7A62;
            color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
        }

        .card-box {
            border-radius: 12px;
            border: 1px solid #eaeaea;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
        }

        .stat-card {
            height: 120px;
            padding: 16px;
        }

        .stat-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .stat-text div {
            font-size: 13px;
            color: #555;
        }

        .stat-text h3 {
            margin: 0;
            font-weight: bold;
        }

        .stat-text small {
            font-size: 12px;
            color: #777;
        }

        .stat-icon {
            font-size: 34px;
            opacity: .25;
        }

        .table-header-custom th {
            background: #F2CC8E;
            text-align: center;
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- ========== SIDEBAR ========== -->
<div class="sidebar">
    <div class="brand">JOVINA</div>

    <div class="profile">
        <img src="{{ asset('images/profil.jpg') }}">
        <div>
            <strong>Dian</strong><br>
            <small>Admin</small>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="{{ route('data-barang') }}" class="{{ request()->routeIs('data-barang') ? 'active' : '' }}">
        <i class="fa fa-box"></i> Data Barang
    </a>

    <a href="{{ route('stok-masuk') }}" class="{{ request()->routeIs('stok-masuk') ? 'active' : '' }}">
        <i class="fa fa-arrow-down"></i> Stok Masuk
    </a>

    <a href="{{ route('stok-keluar') }}" class="{{ request()->routeIs('stok-keluar') ? 'active' : '' }}">
        <i class="fa fa-arrow-up"></i> Stok Keluar
    </a>

    <a href="{{ route('retur') }}" class="{{ request()->routeIs('retur') ? 'active' : '' }}">
        <i class="fa fa-rotate-left"></i> Retur
    </a>

    <a href="{{ route('mutasi') }}" class="{{ request()->routeIs('mutasi') ? 'active' : '' }}">
        <i class="fa fa-random"></i> Mutasi
    </a>

    <a href="{{ route('gudang') }}" class="{{ request()->routeIs('gudang') ? 'active' : '' }}">
        <i class="fa fa-warehouse"></i> Gudang
    </a>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-right-from-bracket"></i> Keluar
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</div>

<!-- ========== CONTENT KANAN ========== -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>