<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

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
            height:520px;
            background:#ffffff;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,.15);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        /* AREA FORM */
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

        /* OPTIONS */
        .options{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            font-size:14px;
        }

        .options-left{
            display:flex;
            align-items:center;
            gap:6px;
        }

        .options input[type="checkbox"]{
            width:16px;
            height:16px;
            margin:0;
        }

        .options a{
            text-decoration:none;
            color:#2BBE9A;
            font-weight:500;
        }

        .options a:hover{
            text-decoration:underline;
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
            <h2>Masuk</h2>

            @if(session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>Nama Pengguna</label>
                <input type="text" name="username" placeholder="Masukkan nama pengguna" required>

                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>

                <div class="options">
                    <div class="options-left">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                   <a href="{{ route('forgot.password') }}">Lupa Password?</a>

                </div>

                <button type="submit">Masuk</button>
            </form>

            <form action="/" method="GET">
                <button type="submit" class="btn-back">Kembali</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>