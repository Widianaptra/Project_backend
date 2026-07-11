<?php
// Menampilkan detail data kelas
include '../config/con-db.php';

$error = "";

// Ambil ID dari URL
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Validasi
    if (!empty($id)) {

        try {

            $sql = "SELECT * FROM kelas WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            $kelas = $stmt->fetch(PDO::FETCH_ASSOC);

            // Jika data tidak ditemukan
            if (!$kelas) {
                header("Location: index.php");
                exit;
            }

        } catch (PDOException $e) {

            $error = "Gagal mengambil data: " . $e->getMessage();

        }

    } else {

        $error = "ID kelas tidak valid.";

    }

} else {

    header("Location: index.php");
    exit;

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas Gym</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f7f6;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,.1);
        }

        h2 {
            margin-top: 0;
            color: #34495e;
        }

        .detail-group {
            margin-bottom: 20px;
        }

        .detail-group label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .detail-box {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f9f9f9;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #95a5a6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .error-msg {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Detail Kelas Gym</h2>

    <?php if (!empty($error)) : ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php else : ?>

        <div class="detail-group">
            <label>Nama Kelas</label>
            <div class="detail-box">
                <?= htmlspecialchars($kelas['nama_kelas']) ?>
            </div>
        </div>

        <div class="detail-group">
            <label>Durasi</label>
            <div class="detail-box">
                <?= htmlspecialchars($kelas['durasi']) ?>
            </div>
        </div>

        <div class="detail-group">
            <label>Deskripsi</label>
            <div class="detail-box">
                <?= nl2br(htmlspecialchars($kelas['deskripsi'])) ?>
            </div>
        </div>

    <?php endif; ?>

    <a href="index.php" class="btn">Kembali</a>

</div>

</body>
</html>