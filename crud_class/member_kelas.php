<?php

require_once __DIR__ . '/kelas/class/Kelas.php';
$kelas = new Kelas();
$dataKelas = $kelas->read();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kelas Gym</title>

    <style>

        body{
            font-family:Arial,sans-serif;
            background:#f4f7f6;
            margin:30px;
        }

        .container{
            max-width:1100px;
            margin:auto;
        }

        h2{
            text-align:center;
            margin-bottom:25px;
        }

        .card{
            background:white;
            border-radius:8px;
            padding:20px;
            margin-bottom:20px;
            box-shadow:0 2px 5px rgba(0,0,0,.1);
        }

        .card h3{
            margin:0 0 10px;
            color:#2c3e50;
        }

        .info{
            margin:6px 0;
        }

        .btn{
            display:inline-block;
            margin-top:15px;
            padding:10px 18px;
            background:#2ecc71;
            color:white;
            text-decoration:none;
            border-radius:5px;
            font-weight:bold;
        }

        .btn:hover{
            background:#27ae60;
        }

        .penuh{
            background:#e74c3c;
            cursor:not-allowed;
        }

    </style>

<?php if(isset($_GET['success'])){ ?>

    <div style="
        background:#d4edda;
        color:#155724;
        padding:15px;
        margin-bottom:20px;
        border-radius:5px;
    ">

        <?= htmlspecialchars($_GET['success']) ?>

    </div>

<?php } ?>


<?php if(isset($_GET['error'])){ ?>

    <div style="
        background:#f8d7da;
        color:#721c24;
        padding:15px;
        margin-bottom:20px;
        border-radius:5px;
    ">

        <?= htmlspecialchars($_GET['error']) ?>

    </div>

<?php } ?>
</head>

<body>

<div class="container">

<h2>Daftar Kelas Gym</h2>

<?php

if($dataKelas && $dataKelas->num_rows > 0){

    while($row = $dataKelas->fetch_assoc()){

?>

<div class="card">

    <h3><?= htmlspecialchars($row['nama_kelas']) ?></h3>

    <div class="info">
        <strong>Trainer :</strong>
        <?= htmlspecialchars($row['nama_trainer']) ?>
    </div>

    <div class="info">
        <strong>Hari :</strong>
        <?= htmlspecialchars($row['hari']) ?>
    </div>

    <div class="info">
        <strong>Jam :</strong>
        <?= htmlspecialchars($row['jam']) ?>
    </div>

    <div class="info">
        <strong>Kuota :</strong>
        <?= htmlspecialchars($row['kuota']) ?>
    </div>

    <div class="info">
        <strong>Deskripsi :</strong><br>
        <?= htmlspecialchars($row['deskripsi']) ?>
    </div>

<?php if($row['kuota'] > 0){ ?>
<a href="kelas//class/ambil.php?id=<?= $row['id']; ?>"class="btn">Ambil Kelas</a>

<?php } else { ?>
<button class="btn penuh"disabled>Kelas Penuh</button>

<?php } ?>

</div>

<?php

    }

}else{

    echo "<p>Tidak ada kelas tersedia.</p>";

}

?>

</div>

</body>
</html>