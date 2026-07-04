<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    echo "<script>
        alert('Akses ditolak! Hanya admin yang dapat membuka halaman ini.');
        window.location='../auth/login.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            background:#f3f4f6;
        }

        .navbar{
            background:#16a34a;
            color:white;
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .navbar h2{
            font-size:24px;
        }

        .logout{
            text-decoration:none;
            color:white;
            background:#dc2626;
            padding:10px 18px;
            border-radius:8px;
            transition:.3s;
        }

        .logout:hover{
            background:#b91c1c;
        }

        .container{
            width:90%;
            max-width:1100px;
            margin:40px auto;
        }

        .welcome{
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
            margin-bottom:30px;
        }

        .welcome h1{
            color:#16a34a;
            margin-bottom:10px;
        }

        .welcome p{
            color:#555;
            font-size:16px;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
        }

        .card{
            background:white;
            border-radius:12px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
            transition:.3s;
            cursor:pointer;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .icon{
            font-size:40px;
            margin-bottom:15px;
        }

        .card h3{
            margin-bottom:10px;
            color:#333;
        }

        .card p{
            color:#666;
            font-size:14px;
        }

        footer{
            text-align:center;
            margin:40px 0;
            color:#777;
        }

    </style>

</head>

<body>

<div class="navbar">

    <h2> Gym Management System</h2>

    <a class="logout" href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

    <div class="welcome">

    <h1>Selamat Datang!</h1>

    <h3><?php echo $_SESSION['username']; ?></h3>

    <p>
        Login sebagai
        <strong><?php echo ucfirst($_SESSION['role']); ?></strong>
    </p>

</div>

    <div class="cards">

        <div class="card">
            <div class="icon">👥</div>
            <h3>Data Member</h3>
            <p>Mengelola data seluruh member gym.</p>
        </div>

        <div class="card">
            <div class="icon">🏋️</div>
            <h3>Data Kelas</h3>
            <p>Mengelola kelas dan trainer.</p>
        </div>

        <div class="card">
            <div class="icon">💳</div>
            <h3>Paket Member</h3>
            <p>Mengelola paket dan masa aktif member.</p>
        </div>

        <div class="card">
            <div class="icon">📅</div>
            <h3>Jadwal</h3>
            <p>Mengelola jadwal kelas dan latihan.</p>
        </div>

    </div>

</div>

<footer>

    © 2026 Gym Management System

</footer>

</body>
</html>