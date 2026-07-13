<?php
// Proses hapus data
require_once __DIR__ . '/class/kelas.php';

$error = "";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Validasi
    if (!empty($id)) {

        try {
            $kelas = new Kelas();
            $result = $kelas->delete($id);

            if ($result) {
                // Redirect setelah berhasil
                header("Location: index_kelas.php?delete=1");
                exit;
            } else {
                $error = "Gagal menghapus data kelas.";
            }
        } catch (Exception $e) {
            $error = "Gagal menghapus data: " . $e->getMessage();
        }

    } else {
        $error = "ID kelas tidak valid.";
    }
} else {
    $error = "Data yang akan dihapus tidak ditemukan.";
}
// Tampilkan error jika ada
if (!empty($error)) {
    echo "<p style='color:red; text-align:center; margin-top:20px;'>"
        . htmlspecialchars($error) .
        "</p>";
    echo "<div style='text-align:center; margin-top:10px;'><a href='index_kelas.php'>Kembali</a></div>";
}
?>