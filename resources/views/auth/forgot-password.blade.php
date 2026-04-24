<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter','Segoe UI', sans-serif;
        }

        body{
            background:#f5f5f5;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
        }

        /* NOTIF */
        .notif{
            width:500px;
            background:#FCEFC4;
            color:#000;
            padding:14px 20px;
            border-radius:12px;
            margin-bottom:20px;
            font-size:14px;
            cursor:pointer;
            text-align:center;
            font-weight:500;
        }

        .notif span{
            font-weight:700;
        }

        /* CARD */
        .container{
            width:500px;
            background:#ffffff;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,.15);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .form-wrapper{
            width:100%;
            padding:40px;
        }

        h1{
            text-align:center;
            font-size:32px;
            font-weight:700;
            margin-bottom:10px;
        }

        .desc{
            text-align:center;
            font-size:14px;
            color:#666;
            margin-bottom:30px;
        }

        label{
            font-size:14px;
            font-weight:600;
            margin-bottom:6px;
            display:block;
        }

        input{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:1px solid #ccc;
            margin-bottom:18px;
        }

        button{
            width:100%;
            padding:14px;
            background:#2BBE9A;
            border:none;
            border-radius:10px;
            color:#fff;
            font-weight:600;
            cursor:pointer;
        }

        .btn-back{
            margin-top:10px;
            background:#fff;
            border:1px solid #ccc;
            color:#000;
        }

        .error{
            color:red;
            text-align:center;
            margin-bottom:10px;
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="notif" onclick="window.location='{{ route('login') }}'">
        <span>item</span> — {{ session('success') }}
        <br>
        <small>(klik untuk kembali ke login)</small>
    </div>
@endif

<div class="container">
    <div class="form-wrapper">
        <h1>Lupa Password?</h1>
        <p class="desc">Masukkan password baru anda!</p>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('forgot.password.update') }}">
            @csrf

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password Baru</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Simpan Password</button>
        </form>

        <form action="{{ route('login') }}" method="GET">
            <button class="btn-back">Kembali</button>
        </form>
    </div>
</div>

</body>
</html>