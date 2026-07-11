<?php
// Proses simpan data
include '../config/con-db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_kelas   = trim($_POST['nama_kelas']);
    $deskripsi    = trim($_POST['deskripsi']);
    $kuota        = trim($_POST['kuota']);
    $nama_trainer = trim($_POST['nama_trainer']);

    // Validasi
    if (!empty($nama_kelas) && !empty($kuota) && !empty($nama_trainer)) {

        try {

            $sql = "INSERT INTO kelas (nama_kelas, deskripsi, kuota, nama_trainer)
                    VALUES (:nama_kelas, :deskripsi, :kuota, :nama_trainer)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nama_kelas'   => $nama_kelas,
                ':deskripsi'    => $deskripsi,
                ':kuota'        => $kuota,
                ':nama_trainer' => $nama_trainer
            ]);

            // Redirect setelah berhasil
            header("Location: index_kelas.php?success=1");
            exit;

        } catch (PDOException $e) {

            $error = "Gagal menyimpan data: " . $e->getMessage();

        }

    } else {

        $error = "Nama kelas, kuota, dan nama trainer wajib diisi.";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Baru</title>

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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type=text],
        input[type=number],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
        }

        .btn-simpan {
            background: #2ecc71;
            flex: 2;
        }

        .btn-kembali {
            background: #95a5a6;
            flex: 1;
        }

        .error-msg {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Tambah Kelas Gym Baru</h2>

    <?php if (!empty($error)) : ?>
        <div class="error-msg">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Nama Kelas</label>
            <input
                type="text"
                name="nama_kelas"
                value="<?= isset($nama_kelas) ? htmlspecialchars($nama_kelas) : '' ?>"
                placeholder="Masukkan nama kelas"
                required>
        </div>

        <div class="form-group">
            <label>Kuota Peserta</label>
            <input
                type="number"
                name="kuota"
                min="1"
                value="<?= isset($kuota) ? htmlspecialchars($kuota) : '' ?>"
                placeholder="Masukkan kuota peserta"
                required>
        </div>

        <div class="form-group">
            <label>Nama Trainer</label>
            <input
                type="text"
                name="nama_trainer"
                value="<?= isset($nama_trainer) ? htmlspecialchars($nama_trainer) : '' ?>"
                placeholder="Masukkan nama trainer"
                required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea
                name="deskripsi"
                placeholder="Masukkan deskripsi kelas"><?= isset($deskripsi) ? htmlspecialchars($deskripsi) : '' ?></textarea>
        </div>

        <div class="btn-group">
            <a href="index.php" class="btn btn-kembali">
                Batal
            </a>

            <button type="submit" class="btn btn-simpan">
                Simpan Kelas
            </button>
        </div>

    </form>

</div>

</body>
</html>