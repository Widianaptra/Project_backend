<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {

    $nama_alat = $_POST['nama_alat'];
    $kategori = $_POST['kategori'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $kondisi = $_POST['kondisi'];
    $tanggal_pembelian = date('Y-m-d');

    $query = "INSERT INTO alat_gym (nama_alat, kategori, jumlah_stok, kondisi, tanggal_pembelian) 
              VALUES ('$nama_alat', '$kategori', '$jumlah_stok', '$kondisi', '$tanggal_pembelian')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Barang berhasil ditambahkan!'); window.location='barang.php';</script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Inventaris Baru</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px;">

    <h2>Form Tambah Barang Inventaris</h2>
    <a href="barang.php" style="text-decoration: none; color: #007bff;"><- Kembali ke Daftar Barang</a>
    <br><br>

    <form action="" method="POST" style="width: 400px;">
        <label>Nama Alat Gym:</label><br>
        <input type="text" name="nama_alat" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Kategori Alat:</label><br>
        <input type="text" name="kategori" placeholder="Contoh: Kardio, Beban, Aksesoris" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Jumlah Stok:</label><br>
        <input type="number" name="jumlah_stok" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Status Kondisi:</label><br>
        <select name="kondisi" style="width: 100%; padding: 8px; margin-bottom: 20px;">
            <option value="Bagus">Bagus</option>
            <option value="Rusak">Rusak</option>
            <option value="Perawatan">Perawatan</option>
        </select><br>

        <button type="submit" name="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px;">Simpan Barang</button>
    </form>

</body>
</html>