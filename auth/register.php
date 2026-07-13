<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management - Register</title>

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
            min-height:100vh;
            padding:20px;
        }

        .register-box{
            width:420px;
            background:#fff;
            padding:40px;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
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

        input,
        select{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:8px;
            margin-bottom:18px;
            outline:none;
            transition:.3s;
            font-size:15px;
        }

        input:focus,
        select:focus{
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

        .login{
            text-align:center;
            margin-top:20px;
            font-size:14px;
        }

        .login a{
            color:#16a34a;
            text-decoration:none;
            font-weight:bold;
        }

        .login a:hover{
            text-decoration:underline;
        }

    </style>

</head>

<body>

<div class="register-box">

    <h2>GYM MANAGEMENT</h2>

    <p>Buat akun baru</p>

    <form action="proses_register.php" method="POST">

        <label>Nama Lengkap</label>

        <input
        type="text"
        name="nama_lengkap"
        placeholder="Masukkan nama lengkap"
        required>

        <label>Email</label>

        <input
        type="email"
        name="email"
        placeholder="Masukkan email"
        required>

        <label>Password</label>

        <input
        type="password"
        name="password"
        placeholder="Masukkan password"
        required>

        <label>Konfirmasi Password</label>

        <input
        type="password"
        name="confirm_password"
        placeholder="Masukkan ulang password"
        required>

        <label>Role</label>

        <select name="role">

            <option value="customer">Customer</option>
            <option value="members">Members</option>

        </select>

        <button type="submit">
            Daftar
        </button>

    </form>

    <div class="login">
        Sudah punya akun?
        <a href="login.php">Login di sini</a>
    </div>

</div>

</body>
</html>