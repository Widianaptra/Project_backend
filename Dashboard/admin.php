<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

// strtolower() untuk mengubah 'Admin' menjadi 'admin' sebelum dicek
if (strtolower($_SESSION['role']) != 'admin') {
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
            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
            gap:20px;
        }

        .card{
            background:white;
            border-radius:12px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
            transition:.3s;
            cursor:pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
            margin-bottom: 15px;
        }

        /* Grouping untuk membungkus tombol di dalam card */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none; 
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.1s ease;
            cursor: pointer;
            text-align: center;
        }

        .btn-tambah {
            background-color: #16a34a; 
            color: white;
            border: 1px solid #15803d;
        }

        .btn-tambah:hover {
            background-color: #15803d; 
        }

        .btn-lihat {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-lihat:hover {
            background-color: #f9fafb;
            color: #111827;
        }

        .btn-inventory {
            background-color: #4b5563;
            color: white;
            border: 1px solid #374151;
        }

        .btn-inventory:hover {
            background-color: #374151;
        }

        .btn:active {
            transform: scale(0.98); 
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
    <h2>Gym Management System</h2>
    <a class="logout" href="../auth/logout.php">Logout</a>
</div>

<div class="container">
    <div class="welcome">
        <h1>Selamat Datang!</h1>
        <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
        <p>
            Login sebagai
            <strong><?php echo ucfirst($_SESSION['role']); ?></strong>
        </p>
    </div>

    <div class="cards">
        <!-- CARD 1: DATA KELAS -->
        <div class="card">
            <div>
                <div class="icon">🏋️</div>
                <h3>Data Kelas</h3>
                <p>Mengelola penjadwalan kelas, kapasitas, dan instruktur senam/fitness.</p>
            </div>
            <div class="btn-group">
                <a href="../crud_class/create.php" class="btn btn-tambah">
                    + Tambah Kelas Baru
                </a>
                <a href="../crud_class/index_kelas.php" class="btn btn-lihat">
                    👁️ Lihat Daftar Kelas
                </a>
            </div>
        </div>

        <!-- CARD 2: INVENTARIS ALAT -->
        <div class="card">
            <div>
                <div class="icon">🛠️</div>
                <h3>Inventaris Alat</h3>
                <p>Mencatat, memantau kondisi, dan mengelola daftar seluruh alat fitness di area gym.</p>
            </div>
            <div class="btn-group">
                <a href="../crud_inventory/create.php" class="btn btn-inventory">
                    + Tambah Alat Baru
                </a>
                <a href="../crud_inventory/index.php" class="btn btn-lihat">
                    👁️ Lihat Daftar Alat
                </a>
            </div>
        </div>
    </div>
</div>

<footer>
    © 2026 Gym Management System
</footer>

</body>
</html>