<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Admin</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f5f5f5;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        /* CARD UTAMA */
        .container{
            width:500px;
            height:560px;
            background:#ffffff;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,.15);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        /* AREA FORM (SAMA DENGAN LOGIN) */
        .right{
            width:100%;
            padding:60px;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .form-wrapper{
            width:100%;
            max-width:420px;
        }

        h2{
            text-align:center;
            font-size:32px;
            font-weight:700;
            margin-bottom:30px;
        }

        label{
            display:block;
            font-size:14px;
            margin-bottom:6px;
            font-weight:600;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"]{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:1px solid #ccc;
            margin-bottom:18px;
            font-size:14px;
        }

        input:focus{
            outline:none;
            border-color:#2BBE9A;
        }

        /* BUTTON */
        button{
            width:100%;
            padding:14px;
            background:#2BBE9A;
            border:none;
            border-radius:10px;
            color:#ffffff;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
        }

        button:hover{
            background:#25a989;
        }

        .btn-back{
            margin-top:10px;
            background:#ffffff;
            border:1px solid #ccc;
            color:#000000;
        }

        .btn-back:hover{
            background:#f0f0f0;
        }

        .error{
            color:red;
            margin-bottom:15px;
            text-align:center;
            font-size:14px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="right">
        <div class="form-wrapper">
            <h2>Daftar</h2>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label>Nama Lengkap</label>
                <input type="text" name="nama_admin" placeholder="Masukkan nama lengkap" required>
                
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>

                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" required>

                <button type="submit">Daftar</button>
            </form>

            <form action="/" method="GET">
                <button type="submit" class="btn-back">Kembali</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>