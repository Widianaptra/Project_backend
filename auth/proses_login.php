<?php

session_start();
include "../config/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($query) > 0){

    $user = mysqli_fetch_assoc($query);

    if($password == $user['password']){

        $_SESSION['id'] = $user['id_user'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['nama_lengkap']; // For dashboard compatibility
        $_SESSION['role'] = $user['role'];

        header("Location: ../admin/dashboard.php");
        exit;

    }else{

        echo "<script>
        alert('Password salah!');
        window.location='login.php';
        </script>";

    }

}else{

    echo "<script>
    alert('Email tidak ditemukan!');
    window.location='login.php';
    </script>";

}