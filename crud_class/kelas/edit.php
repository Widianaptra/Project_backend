<?php
// Proses edit data
require_once __DIR__ . '/class/kelas.php';

$error = "";

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $kelasObj = new Kelas();
        $kelas_ditemukan = $kelasObj->getById($id);
        
        // Jika data tidak ditemukan
        if (!$kelas_ditemukan) {
            header("Location: index_kelas.php");
            exit;
        }
    } catch (Exception $e) {
        $error = "Gagal mengambil data: " . $e->getMessage();
    }
} else {
    header("Location: index_kelas.php");
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas   = trim($_POST['nama_kelas']);
    $deskripsi    = trim($_POST['deskripsi']);
    $hari         = trim($_POST['hari']);
    $jam          = trim($_POST['jam']);
    $kuota        = trim($_POST['kuota']);
    $nama_trainer = trim($_POST['nama_trainer']);

    // Validasi
    if (
        $nama_kelas != "" &&
        $hari != "" &&
        $jam != "" &&
        $kuota != "" &&
        $nama_trainer != ""
    ) {
        try {
            $result = $kelasObj->update(
                $id,
                $nama_kelas,
                $deskripsi,
                $hari,
                $jam,
                $kuota,
                $nama_trainer
            );

            if ($result) {
                // Redirect setelah berhasil
                header("Location: index_kelas.php?update=1");
                exit;
            } else {
                $error = "Gagal mengubah data kelas.";
            }
        } catch (Exception $e) {
            $error = "Gagal mengubah data: " . $e->getMessage();
        }
    } else {
        $error = "Semua data wajib diisi (kecuali deskripsi).";
    }

    // Update data yang ditampilkan jika terjadi error
    $kelas_ditemukan['nama_kelas']   = $nama_kelas;
    $kelas_ditemukan['deskripsi']    = $deskripsi;
    $kelas_ditemukan['hari']         = $hari;
    $kelas_ditemukan['jam']          = $jam;
    $kelas_ditemukan['kuota']        = $kuota;
    $kelas_ditemukan['nama_trainer'] = $nama_trainer;
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
            max-width: 650px;
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
        input[type=time],
        select,
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
                value="<?= htmlspecialchars($kelas_ditemukan['nama_kelas'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi"><?= htmlspecialchars($kelas_ditemukan['deskripsi'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Hari</label>
            <select name="hari" required>
                <option value="">-- Pilih Hari --</option>
                <?php
                $hariList = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
                foreach($hariList as $h){
                    $selected = (($kelas_ditemukan['hari'] ?? '') == $h) ? "selected" : "";
                    echo "<option value=\"$h\" $selected>$h</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jam</label>
            <input
                type="time"
                name="jam"
                value="<?= htmlspecialchars($kelas_ditemukan['jam'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Kuota</label>
            <input
                type="number"
                name="kuota"
                min="1"
                value="<?= htmlspecialchars($kelas_ditemukan['kuota'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Nama Trainer</label>
            <input
                type="text"
                name="nama_trainer"
                value="<?= htmlspecialchars($kelas_ditemukan['nama_trainer'] ?? '') ?>"
                required>
        </div>

        <div class="btn-group">
            <a href="index_kelas.php" class="btn btn-kembali">Batal</a>
            <button type="submit" class="btn btn-update">Update Kelas</button>
        </div>
    </form>
</div>

</body>
</html>