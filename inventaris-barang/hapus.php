<?php
require_once __DIR__ . '/../db_gym/config/con-db.php';

$database = new Database();
$koneksi = $database->getConnection();

$id = $_GET['id'];

$query = "DELETE FROM alat_gym WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Barang berhasil dihapus!'); window.location='barang.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>