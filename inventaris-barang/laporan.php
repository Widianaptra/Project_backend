<?php
include 'koneksi.php';

$query = "SELECT * FROM alat_gym";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Inventaris Alat Gym</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN DATA INVENTARIS ALAT GYM</h2>
        <p>Sistem Manajemen Gym - Laporan Seluruh Alat</p>
        <hr style="border: 1px solid black;">
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th class="text-center">Jumlah Stok</th>
                <th class="text-center">Kondisi</th>
                <th class="text-center">Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada data inventaris.</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $row['nama_alat']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td class="text-center"><?= $row['jumlah_stok']; ?></td>
                        <td class="text-center"><?= $row['kondisi']; ?></td>
                        <td class="text-center"><?= $row['tanggal_pembelian']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>
</html>