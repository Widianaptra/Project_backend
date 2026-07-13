<?php
require_once __DIR__ . '/../db_gym/config/con-db.php';

$database = new Database();
$conn = $database->getConnection();

if (isset($_POST['submit'])) {

    $nama_alat = $_POST['nama_alat'];
    $kategori = $_POST['kategori'];
    $jumlah_stok = $_POST['jumlah_stok'];
    
    // Paksa nilai kondisi menjadi huruf kecil total demi keamanan ENUM database
    $kondisi = strtolower($_POST['kondisi']); 

    $query = "INSERT INTO alat_gym (nama_alat, kategori, jumlah_stok, kondisi) 
              VALUES ('$nama_alat', '$kategori', '$jumlah_stok', '$kondisi')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Barang berhasil ditambahkan!'); window.location='barang.php';</script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
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
        <select name="kategori" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
            <option value="kardio">Kardio</option>
            <option value="beban">Beban</option>
            <option value="lainnya">Lainnya</option>
        </select><br>

        <label>Jumlah Stok:</label><br>
        <input type="number" name="jumlah_stok" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Status Kondisi:</label><br>
        <select name="kondisi" required style="width: 100%; padding: 8px; margin-bottom: 20px;">
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
        </select><br>

        <button type="submit" name="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px;">Simpan Barang</button>
    </form>

</body>
</html>