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
            padding-left: 220px;
        }

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

        .content {
            padding: 0;
        }
    </style>
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

    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="{{ route('stok-masuk.index') }}"
       class="{{ request()->routeIs('stok-masuk.index') ? 'active' : '' }}">
        <i class="fa fa-arrow-down"></i> Stok Masuk
    </a>

    <a href="{{ route('stok-keluar.index') }}"
       class="{{ request()->routeIs('stok-keluar.index') ? 'active' : '' }}">
        <i class="fa fa-arrow-up"></i> Stok Keluar
    </a>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-right-from-bracket"></i> Keluar
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</div>

<!-- ========== CONTENT ========== -->
<div class="content">
    @yield('content')
</div>

</body>
</html>