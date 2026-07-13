<?php
session_start();
require_once __DIR__ . '/../db_gym/config/con-db.php';

$database = new Database();
$conn = $database->getConnection();

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../vendor/autoload.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = $_SESSION['id'];
$paket_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($paket_id == 0) {
    die("Paket tidak valid.");
}

// Ambil detail paket
$qPaket = mysqli_query($conn, "SELECT * FROM paket WHERE id = $paket_id");
if(mysqli_num_rows($qPaket) == 0) {
    die("Paket tidak ditemukan.");
}
$paket = mysqli_fetch_assoc($qPaket);

// Cek apakah user sudah ada di tabel members
$qMember = mysqli_query($conn, "SELECT * FROM members WHERE user_id = $user_id");
if (mysqli_num_rows($qMember) == 0) {
    // Jika belum ada, tambahkan ke tabel members
    $nama_lengkap = $_SESSION['username']; // Kita simpan nama_lengkap di session username
    mysqli_query($conn, "INSERT INTO members (user_id, nama_lengkap, tanggal_gabung) VALUES ($user_id, '$nama_lengkap', CURDATE())");
    $member_id = mysqli_insert_id($conn);
} else {
    $member = mysqli_fetch_assoc($qMember);
    $member_id = $member['id'];
}

// Catat transaksi
$tgl_bayar = date('Y-m-d');
$qTransaksi = mysqli_query($conn, "INSERT INTO transaksi (member_id, paket_id, tanggal_bayar, status) VALUES ($member_id, $paket_id, '$tgl_bayar', 'pending')");
$transaksi_id = mysqli_insert_id($conn);

if ($qTransaksi) {
    // Kirim Email Invoice menggunakan PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Pengaturan Server Email (SMTP)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'emailanda@gmail.com';                  // SMTP username (GANTI DENGAN EMAIL ANDA)
        $mail->Password   = 'gltn zvgm bmsm rcoi';               // SMTP password (GANTI DENGAN APP PASSWORD)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable implicit TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to

        // Penerima
        $mail->setFrom('emailanda@gmail.com', 'Gym Management');
        $mail->addAddress($_SESSION['email'], $_SESSION['username']); // Tambahkan penerima (member)

        // Konten Email
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Invoice Pembelian Paket Gym - Transaksi #' . $transaksi_id;
        
        $harga_format = 'Rp ' . number_format($paket['harga'], 0, ',', '.');
        
        $mail->Body    = "
            <h2>Halo, {$_SESSION['username']}!</h2>
            <p>Terima kasih telah melakukan pemesanan paket member di Gym kami.</p>
            <p>Berikut adalah detail pesanan Anda:</p>
            <ul>
                <li><strong>No. Transaksi:</strong> #$transaksi_id</li>
                <li><strong>Paket:</strong> {$paket['nama_paket']}</li>
                <li><strong>Durasi:</strong> {$paket['durasi_bulan']} Bulan</li>
                <li><strong>Total Pembayaran:</strong> $harga_format</li>
                <li><strong>Status:</strong> Menunggu Pembayaran (Pending)</li>
            </ul>
            <br>
            <p><strong>Instruksi Pembayaran:</strong></p>
            <p>Silakan lakukan transfer sebesar <strong>$harga_format</strong> ke rekening berikut:</p>
            <p><strong>Bank BCA: 1234567890 a.n Gym Management</strong></p>
            <p>Setelah transfer, mohon konfirmasi ke admin kami atau tunjukkan bukti transfer di resepsionis.</p>
            <br>
            <p>Terima kasih,<br>Tim Gym Management</p>
        ";

        $mail->send();
        
        header("Location: index.php?success=Pembelian berhasil! Silakan cek email Anda untuk instruksi pembayaran.");
        exit;
    } catch (Exception $e) {
        // Jika email gagal, transaksi tetap sukses, namun kita beritahu errornya
        header("Location: index.php?error=Pembelian berhasil dicatat, namun gagal mengirim email invoice. Error: {$mail->ErrorInfo}");
        exit;
    }

} else {
    header("Location: index.php?error=Gagal mencatat transaksi.");
    exit;
}