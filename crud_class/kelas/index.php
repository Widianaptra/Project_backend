<?php

include 'class/Kelas.php';

$kelas = new Kelas();
$dataKelas = $kelas->read();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas Gym</title>

    <style>

        body{
            font-family:Arial,sans-serif;
            margin:30px;
            background:#f4f7f6;
        }

        .container{
            max-width:1100px;
            margin:auto;
            background:#fff;
            padding:20px;
            border-radius:8px;
            box-shadow:0 2px 5px rgba(0,0,0,.1);
        }

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .btn{
            padding:10px 15px;
            text-decoration:none;
            border-radius:5px;
            color:white;
            font-weight:bold;
        }

        .btn-tambah{
            background:#2ecc71;
        }

        .btn-edit{
            background:#f39c12;
            padding:5px 10px;
            font-size:12px;
        }

        .btn-hapus{
            background:#e74c3c;
            padding:5px 10px;
            font-size:12px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #ddd;
            padding:12px;
            text-align:left;
        }

        th{
            background:#34495e;
            color:white;
        }

        tr:nth-child(even){
            background:#f9f9f9;
        }

        .aksi-buttons{
            display:flex;
            gap:5px;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:12px;
            border-radius:5px;
            margin-bottom:20px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h2>Daftar Kelas Gym</h2>

        <a href="/kelas/create.php" class="btn btn-tambah">
            + Tambah Kelas Baru
        </a>

    </div>

    <?php if(isset($_GET['success'])){ ?>

        <div class="success">
            Data berhasil disimpan.
        </div>

    <?php } ?>

    <table>

        <thead>

            <tr>

                <th width="5%">No</th>
                <th>Nama Kelas</th>
                <th>Deskripsi</th>
                <th width="10%">Kuota</th>
                <th width="20%">Trainer</th>
                <th width="15%">Aksi</th>

            </tr>

        </thead>

        <tbody>

        <?php

        if($dataKelas->num_rows > 0){

            $no = 1;

            while($row = $dataKelas->fetch_assoc()){

        ?>

            <tr>

                <td><?= $no++; ?></td>

                <td>
                    <strong><?= htmlspecialchars($row['nama_kelas']); ?></strong>
                </td>

                <td>
                    <?= htmlspecialchars($row['deskripsi']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['kuota']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['nama_trainer']); ?>
                </td>

                <td>

                    <div class="aksi-buttons">

                        <a
                            href="edit.php?id=<?= $row['id']; ?>"
                            class="btn btn-edit">

                            Edit

                        </a>

                        <a
                            href="delete.php?id=<?= $row['id']; ?>"
                            class="btn btn-hapus"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">

                            Hapus

                        </a>

                    </div>

                </td>

            </tr>

        <?php

            }

        }else{

        ?>

            <tr>

                <td colspan="6" style="text-align:center">

                    Belum ada data kelas.

                </td>

            </tr>

        <?php

        }

        ?>

        </tbody>

    </table>

</div>

</body>
</html>