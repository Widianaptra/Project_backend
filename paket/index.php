<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM paket");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Paket Member</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; margin: 30px; }
        .container { max-width: 900px; margin: auto; }
        h2 { text-align: center; margin-bottom: 25px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .card h3 { color: #16a34a; }
        .price { font-size: 24px; font-weight: bold; margin: 15px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #16a34a; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px; }
        .btn:hover { background: #15803d; }
        .alert { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Pilih Paket Member Gym</h2>
    
    <?php if(isset($_GET['success'])) { echo "<div class='alert'>" . htmlspecialchars($_GET['success']) . "</div>"; } ?>
    
    <div class="grid">
        <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="card">
            <h3><?= htmlspecialchars($row['nama_paket']) ?></h3>
            <div class="price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></div>
            <p>Durasi: <?= htmlspecialchars($row['durasi_bulan']) ?> Bulan</p>
            <a href="beli_paket.php?id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Apakah Anda yakin ingin membeli paket ini?')">Beli Paket</a>
        </div>
        <?php endwhile; ?>
        <?php if(mysqli_num_rows($query) == 0): ?>
            <p>Belum ada paket yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>