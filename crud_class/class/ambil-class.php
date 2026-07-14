<?php

session_start();

require_once __DIR__ . '/kelas.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../../auth/login.php?error=" . urlencode('Silakan login terlebih dahulu.'));
    exit;
}

$memberId = (int) $_SESSION['id'];

// Cek apakah id kelas dikirim dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../member_kelas.php?error=" . urlencode('ID kelas tidak valid.'));
    exit;
}

$kelasId = (int) $_GET['id'];

$kelas = new Kelas();

// Proses ambil kelas
$result = $kelas->ambilKelas($memberId, $kelasId);

// Redirect kembali dengan pesan
$redirect = '../member_kelas.php';

if ($result['status']) {
    header("Location: {$redirect}?success=" . urlencode($result['pesan']));
} else {
    header("Location: {$redirect}?error=" . urlencode($result['pesan']));
}

exit;