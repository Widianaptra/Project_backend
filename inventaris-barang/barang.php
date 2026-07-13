<?php
include 'koneksi.php';

$query = "SELECT * FROM alat_gym";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Manajemen Inventaris Barang Gym</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px;">

    <h2>Sistem Manajemen Inventaris Barang Gym</h2>

    <a href="tambah.php" style="padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Tambah Barang</a>
    <a href="laporan.php" style="padding: 8px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px;">Cetak Laporan</a>

    <br><br><br>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <tr style="background-color: #f2f2f2;">
            <th>No</th>
            <th>Nama Alat</th>
            <th>Kategori</th>
            <th>Jumlah Stok</th>
            <th>Kondisi</th>
            <th>Tanggal Pembelian</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='7' align='center'>Belum ada data barang. Silakan tambah data baru.</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td><?= $row['nama_alat']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td align="center"><?= $row['jumlah_stok']; ?></td>
                    <td align="center"><strong><?= $row['kondisi']; ?></strong></td>
                    <td align="center"><?= $row['tanggal_pembelian']; ?></td>
                    <td align="center">
                        <a href="edit.php?id=<?= $row['id']; ?>" style="color: #007bff; text-decoration: none;">Edit</a> | 
                        <a href="hapus.php?id=<?= $row['id']; ?>" style="color: #dc3545; text-decoration: none;" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>

</body>
</html>