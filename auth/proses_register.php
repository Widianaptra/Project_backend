<?php

include "../config/koneksi.php";

$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

// Validasi username minimal 4 karakter
if (strlen($username) < 4) {

    echo "<script>
    alert('Username minimal 4 karakter!');
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

// Cek username sudah ada atau belum
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {

    echo "<script>
    alert('Username sudah digunakan!');
    window.location='register.php';
    </script>";

    exit;
}

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO users(username, password, role)
VALUES('$username', '$password', '$role')");

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