<?php
session_start();

// Proteksi halaman: pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f3f4f6;
        }

        .navbar {
            background: #16a34a;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 24px;
        }

        .logout {
            text-decoration: none;
            color: white;
            background: #dc2626;
            padding: 10px 18px;
            border-radius: 8px;
            transition: .3s;
        }

        .logout:hover {
            background: #b91c1c;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
            margin-bottom: 30px;
        }

        .welcome h1 {
            color: #16a34a;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #555;
            font-size: 16px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin-bottom: 10px;
            color: #333;
            font-size: 20px;
        }

        .card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn-membership {
            display: inline-block;
            text-decoration: none;
            background: #16a34a;
            color: white;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            transition: .3s;
            width: 100%;
        }

        .btn-membership:hover {
            background: #15803d;
        }

        footer {
            text-align: center;
            margin: 40px 0;
            color: #777;
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
        <h1>Halo, Selamat Datang!</h1>
        <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
        <p>Status Akun: <strong><?php echo ucfirst($_SESSION['role']); ?></strong></p>
    </div>

    <div class="cards">
        <!-- CARD UTAMA: MEMBERSHIP -->
        <div class="card">
            <div>
                <div class="icon">💳</div>
                <h3>Membership Gym</h3>
                <p>Aktifkan atau perpanjang paket member Gym Anda di sini untuk mendapatkan akses penuh ke fasilitas latihan.</p>
            </div>
            <!-- Redirect mengarah ke folder paket_member Anda -->
            <a href="../paket/index.php" class="btn-membership">Pilih & Beli Paket</a>
        </div>

       
</div>

<footer>
    &copy; 2026 Gym Management System
</footer>

</body>
</html>