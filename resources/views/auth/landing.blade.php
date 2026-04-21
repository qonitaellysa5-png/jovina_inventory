<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jovina Inventory</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">    <style>
        body{
            margin:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#ffffff;
            font-family: 'Inter', sans-serif;
        }
        .card{
            width:720px;
            padding:50px 40px;
            background:#f2f2f2;
            border-radius:20px;
            text-align:center;
        }
        .logo{
            width:120px;
            margin-bottom:20px;
        }
        .title{
            font-size:48px;
            font-weight:800;
            margin:0;
        }

        .title span{
            color:#F8BD00;
        }
        
        .desc{
            font-size:20px;
            font-weight:400;
            color:rgba(0,0,0,0.6);
            margin:20px 0 40px;
        }

        .btn-group{
                display: flex;
                flex-direction: column; /* tombol atas-bawah */
                justify-content: center;
                align-items: center; /* rata tengah horizontal */
                gap: 10px; /* jarak antar tombol */
        }


        .btn{
            width:200px;
            padding:14px 0;
            border-radius:10px;
            text-decoration:none;
            font-weight:700;
            color:white;
            display:inline-block;
        }

        .btn-login{
            background:#20c997;
        }

        .btn-register{
            background:#6c757d;
        }
    </style>
</head>
<body>

<div class="card">

    <img src="{{ asset('images/logo.jpeg') }}" class="logo" alt="Logo Jovina">

    <h1 class="title">
        Jovina <span>Inventory</span>
    </h1>

    <p class="desc">
        pencatatan stok barang memudahkan pengelolaan barang masuk,
        keluar, retur, mutasi, dan gudang
    </p>

    <div class="btn-group">
        <a href="{{ route('login') }}" class="btn btn-login">Masuk</a>
        <a href="{{ route('register') }}" class="btn btn-register">Daftar</a>
    </div>

</div>

</body>

</html>