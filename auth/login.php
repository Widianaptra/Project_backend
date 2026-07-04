<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management - Login</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            background:#f3f4f6;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            width:380px;
            background:#fff;
            padding:40px;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }

        .logo{
            text-align:center;
            font-size:50px;
            margin-bottom:10px;
        }

        h2{
            text-align:center;
            color:#16a34a;
            margin-bottom:8px;
        }

        p{
            text-align:center;
            color:#666;
            margin-bottom:30px;
            font-size:14px;
        }

        label{
            display:block;
            margin-bottom:6px;
            font-weight:600;
            color:#444;
        }

        input{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:8px;
            margin-bottom:18px;
            outline:none;
            transition:.3s;
        }

        input:focus{
            border-color:#16a34a;
            box-shadow:0 0 5px rgba(22,163,74,.2);
        }

        button{
            width:100%;
            padding:12px;
            background:#16a34a;
            color:white;
            border:none;
            border-radius:8px;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        button:hover{
            background:#15803d;
        }

        .register{
            text-align:center;
            margin-top:20px;
            font-size:14px;
        }

        .register a{
            color:#16a34a;
            text-decoration:none;
            font-weight:bold;
        }

        .register a:hover{
            text-decoration:underline;
        }

    </style>

</head>

<body>

<div class="login-box">

    <h2>GYM MANAGEMENT</h2>

    <p>Silakan login untuk melanjutkan</p>

    <form action="proses_login.php" method="POST">

        <label>Username</label>

        <input
        type="text"
        name="username"
        placeholder="Masukkan username"
        required>

        <label>Password</label>

        <input
        type="password"
        name="password"
        placeholder="Masukkan password"
        required>

        <button type="submit">
            Login
        </button>

    </form>

    <div class="register">
        Belum punya akun?
        <a href="register.php">Daftar di sini</a>
    </div>

</div>

</body>
</html>