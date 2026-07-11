<?php
// Proses edit data
include '../config/con-db.php';

$error = "";

// Ambil ID dari URL
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    try {

        // Ambil data berdasarkan ID
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

    header("Location: index.php");
    exit;

}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_kelas = trim($_POST['nama_kelas']);
    $deskripsi  = trim($_POST['deskripsi']);
    $durasi     = $_POST['durasi'];

    // Validasi
    if (!empty($nama_kelas) && !empty($durasi)) {

        try {

            $sql = "UPDATE kelas
                    SET nama_kelas = :nama_kelas,
                        deskripsi = :deskripsi,
                        durasi = :durasi
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nama_kelas' => $nama_kelas,
                ':deskripsi'  => $deskripsi,
                ':durasi'     => $durasi,
                ':id'         => $id
            ]);

            // Redirect setelah berhasil
            header("Location: index.php?update=1");
            exit;

        } catch (PDOException $e) {

            $error = "Gagal mengubah data: " . $e->getMessage();

        }

    } else {

        $error = "Nama kelas dan durasi wajib diisi.";

    }

    // Update data yang ditampilkan jika terjadi error
    $kelas['nama_kelas'] = $nama_kelas;
    $kelas['deskripsi']  = $deskripsi;
    $kelas['durasi']     = $durasi;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas Gym</title>

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
        textarea,
        select {
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

        .btn-update {
            background: #f39c12;
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

    <h2>Edit Kelas Gym</h2>

    <?php if (!empty($error)) : ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Nama Kelas</label>
            <input
                type="text"
                name="nama_kelas"
                value="<?= htmlspecialchars($kelas['nama_kelas']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Durasi</label>
            <select name="durasi" required>
                <option value="">-- Pilih Durasi --</option>
                <option value="30 Menit" <?= $kelas['durasi'] == '30 Menit' ? 'selected' : '' ?>>30 Menit</option>
                <option value="45 Menit" <?= $kelas['durasi'] == '45 Menit' ? 'selected' : '' ?>>45 Menit</option>
                <option value="60 Menit" <?= $kelas['durasi'] == '60 Menit' ? 'selected' : '' ?>>60 Menit</option>
                <option value="90 Menit" <?= $kelas['durasi'] == '90 Menit' ? 'selected' : '' ?>>90 Menit</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi"><?= htmlspecialchars($kelas['deskripsi']) ?></textarea>
        </div>

        <div class="btn-group">
            <a href="index.php" class="btn btn-kembali">Batal</a>
            <button type="submit" class="btn btn-update">Update Kelas</button>
        </div>

    </form>

</div>

</body>
</html>