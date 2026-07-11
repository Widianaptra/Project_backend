<?php
// Proses hapus data
include '../config/con-db.php';

$error = "";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Validasi
    if (!empty($id)) {

        try {

            $sql = "DELETE FROM kelas WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            // Redirect setelah berhasil
            header("Location: index.php?delete=1");
            exit;
        } catch (PDOException $e) {
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
}
?>