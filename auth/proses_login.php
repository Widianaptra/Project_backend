<?php

session_start();
include "../config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($query) > 0){

    $user = mysqli_fetch_assoc($query);

    if($password == $user['password']){

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
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
    alert('Username tidak ditemukan!');
    window.location='login.php';
    </script>";

}