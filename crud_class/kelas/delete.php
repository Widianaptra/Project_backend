<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    /* Logika DB Asli nanti:
    include '../config/koneksi.php';
    $stmt = $pdo->prepare("DELETE FROM kelas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    */
    
    echo "<script>
            alert('Simulasi: Kelas dengan ID " . htmlspecialchars($id) . " berhasil dihapus!');
            window.location = 'index.php';
          </script>";
}
?>