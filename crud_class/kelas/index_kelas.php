<?php
// Menampilkan daftar kelas
include '../config/con-db.php';

$error = "";

try {

    $sql = "SELECT * FROM kelas ORDER BY id ASC";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $list_kelas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    $error = "Gagal mengambil data: " . $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas Gym</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f7f6;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #34495e;
        }

        .btn {
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        .btn-tambah {
            background: #2ecc71;
        }

        .btn-detail {
            background: #3498db;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-edit {
            background: #f39c12;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-hapus {
            background: #e74c3c;
            padding: 5px 10px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .aksi-buttons {
            display: flex;
            gap: 5px;
        }

        .error-msg {
            color: red;
            margin-bottom: 15px;
        }

        .success-msg {
            color: green;
            margin-bottom: 15px;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="header">
        <h2>Daftar Kelas Gym</h2>

        <a href="create.php" class="btn btn-tambah">
            + Tambah Kelas Baru
        </a>
    </div>

    <?php if (isset($_GET['success'])) : ?>
        <div class="success-msg">
            Data berhasil ditambahkan.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['update'])) : ?>
        <div class="success-msg">
            Data berhasil diubah.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['delete'])) : ?>
        <div class="success-msg">
            Data berhasil dihapus.
        </div>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>

        <div class="error-msg">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php else : ?>

        <table>

            <thead>

                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Kelas</th>
                    <th width="40%">Deskripsi</th>
                    <th width="10%">Durasi</th>
                    <th width="20%">Aksi</th>
                </tr>

            </thead>

            <tbody>

                <?php if (count($list_kelas) > 0) : ?>

                    <?php
                    $no = 1;
                    foreach ($list_kelas as $kelas) :
                    ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <?= htmlspecialchars($kelas['nama_kelas']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($kelas['deskripsi']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($kelas['durasi']) ?>
                            </td>

                            <td>

                                <div class="aksi-buttons">

                                    <a href="read.php?id=<?= $kelas['id'] ?>" class="btn btn-detail">
                                        Detail
                                    </a>

                                    <a href="edit.php?id=<?= $kelas['id'] ?>" class="btn btn-edit">
                                        Edit
                                    </a>

                                    <a href="delete.php?id=<?= $kelas['id'] ?>"
                                       class="btn btn-hapus"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>
                        <td colspan="5" style="text-align:center;">
                            Data kelas belum tersedia.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

</body>
</html>