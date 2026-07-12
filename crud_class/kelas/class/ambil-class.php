<?php

require_once __DIR__ . '/class/Kelas.php';

// SEMENTARA
// Ganti menjadi $_SESSION['member_id'] setelah login selesai
$memberId = 1;

// Cek apakah id kelas dikirim
if (!isset($_GET['id'])) {
    header("Location: member_kelas.php");
    exit;
}

$kelasId = (int) $_GET['id'];

$kelas = new Kelas();

// Proses ambil kelas
$result = $kelas->ambilKelas($memberId, $kelasId);

// Redirect kembali dengan pesan
if ($result['status']) {

    header("Location: member_kelas.php?success=" . urlencode($result['pesan']));

} else {

    header("Location:member_kelas.php?error=" . urlencode($result['pesan']));

}

exit;