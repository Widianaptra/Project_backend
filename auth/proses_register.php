<?php

include "../config/koneksi.php";

$nama_lengkap = trim($_POST['nama_lengkap']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo "<script>
    alert('Format email tidak valid!');
    window.location='register.php';
    </script>";

    exit;
}

// Validasi password minimal 6 karakter
if (strlen($password) < 6) {

    echo "<script>
    alert('Password minimal 6 karakter!');
    window.location='register.php';
    </script>";

    exit;
}

// Validasi konfirmasi password
if ($password != $confirm_password) {

    echo "<script>
    alert('Konfirmasi password tidak sama!');
    window.location='register.php';
    </script>";

    exit;
}

// Cek email sudah ada atau belum
$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($cek) > 0) {

    echo "<script>
    alert('Email sudah digunakan!');
    window.location='register.php';
    </script>";

    exit;
}

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO users(nama_lengkap, email, password, role)
VALUES('$nama_lengkap', '$email', '$password', '$role')");

if ($query) {

    echo "<script>
    alert('Register berhasil!');
    window.location='login.php';
    </script>";

} else {

    echo "<script>
    alert('Register gagal!');
    window.location='register.php';
    </script>";

}

?>