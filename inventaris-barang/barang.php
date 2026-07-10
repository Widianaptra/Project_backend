<?php
include 'koneksi.php';

$query = "SELECT * FROM inventaris";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Inventaris Gym</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px;">

    <h2>Sistem Manajemen Inventaris Barang Gym</h2>
    
    <a href="tambah.php" style="padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Tambah Barang Baru</a>
    <a href="laporan.php" style="padding: 8px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px;">Lihat Laporan Status</a>
    
    <br><br><br>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <tr style="background-color: #f2f2f2;">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Status Kondisi</th>
            <th>Lokasi Ruangan</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1;
        if(mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='6' align='center'>Belum ada data barang. Silakan tambah barang terlebih dahulu.</td></tr>";
        } else {
            while($row = mysqli_fetch_assoc($result)) { 
            ?>
            <tr>
                <td align="center"><?= $no++; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td align="center"><?= $row['jumlah']; ?></td>
                <td align="center"><strong><?= $row['status']; ?></strong></td>
                <td><?= $row['lokasi']; ?></td>
                <td align="center">
                    <a href="edit.php?id=<?= $row['id']; ?>" style="color: #ffc107; text-decoration: none; font-weight: bold;">Edit</a> | 
                    <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')" style="color: #dc3545; text-decoration: none; font-weight: bold;">Hapus</a>
                </td>
            </tr>
            <?php 
            } 
        }
        ?>
    </table>
</body>
</html>