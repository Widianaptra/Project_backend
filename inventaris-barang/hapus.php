<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM alat_gym WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Barang berhasil dihapus!'); window.location='barang.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>