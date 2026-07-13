<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM alat_gym WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_alat = $_POST['nama_alat'];
    $kategori = $_POST['kategori'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $kondisi = $_POST['kondisi'];

    $update_query = "UPDATE alat_gym SET 
                     nama_alat = '$nama_alat', 
                     kategori = '$kategori', 
                     jumlah_stok = '$jumlah_stok', 
                     kondisi = '$kondisi' 
                     WHERE id = '$id'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Data barang berhasil diubah!'); window.location='barang.php';</script>";
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Inventaris Barang</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px;">

    <h2>Form Edit Barang Inventaris</h2>
    <a href="barang.php" style="text-decoration: none; color: #007bff;"><- Kembali</a>
    <br><br>

    <form action="" method="POST" style="width: 400px;">
        <label>Nama Alat Gym:</label><br>
        <input type="text" name="nama_alat" value="<?= $row['nama_alat']; ?>" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Kategori Alat:</label><br>
    <select name="kategori" style="width: 100%; padding: 8px; margin-bottom: 15px;">
    <option value="kardio" <?= $row['kategori'] == 'kardio' ? 'selected' : ''; ?>>Kardio</option>
    <option value="beban" <?= $row['kategori'] == 'beban' ? 'selected' : ''; ?>>Beban</option>
    <option value="lainnya" <?= $row['kategori'] == 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
    </select><br>

        <label>Jumlah Stok:</label><br>
        <input type="number" name="jumlah_stok" value="<?= $row['jumlah_stok']; ?>" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Status Kondisi:</label><br>
        <select name="kondisi" style="width: 100%; padding: 8px; margin-bottom: 20px;">
            <option value="Baik" <?= $row['kondisi'] == 'Baik' ? 'selected' : ''; ?>>Baik</option>
            <option value="Rusak" <?= $row['kondisi'] == 'Rusak' ? 'selected' : ''; ?>>Rusak</option>
        </select><br>

        <button type="submit" name="update" style="padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; border-radius: 4px;">Simpan Perubahan</button>
    </form>

</body>
</html>