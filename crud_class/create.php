<?php

require_once __DIR__ . '/class/kelas.php';

$error = "";

$nama_kelas   = "";
$deskripsi    = "";
$hari         = "";
$jam          = "";
$kuota        = "";
$nama_trainer = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_kelas   = trim($_POST['nama_kelas']);
    $deskripsi    = trim($_POST['deskripsi']);
    $hari         = trim($_POST['hari']);
    $jam          = trim($_POST['jam']);
    $kuota        = trim($_POST['kuota']);
    $nama_trainer = trim($_POST['nama_trainer']);

    if (
        $nama_kelas != "" &&
        $hari != "" &&
        $jam != "" &&
        $kuota != "" &&
        $nama_trainer != ""
    ) {

        $kelas = new Kelas();

        if ($kelas->create(
            $nama_kelas,
            $deskripsi,
            $hari,
            $jam,
            $kuota,
            $nama_trainer
        )) {

            header("Location: index_kelas.php?success=1");
            exit;

        } else {

            $error = "Gagal menyimpan data.";

        }

    } else {

        $error = "Semua data wajib diisi.";

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Kelas Gym</title>

<style>

body{
    font-family:Arial,sans-serif;
    margin:30px;
    background:#f4f7f6;
}

.container{
    max-width:650px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:8px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

h2{
    margin-top:0;
    color:#34495e;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

input[type=text],
input[type=number],
input[type=time],
select,
textarea{

    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:4px;
    box-sizing:border-box;

}

textarea{
    height:100px;
    resize:vertical;
}

.btn-group{
    display:flex;
    gap:10px;
}

.btn{

    padding:12px 20px;
    border:none;
    border-radius:5px;
    color:white;
    cursor:pointer;
    text-decoration:none;
    text-align:center;
    font-weight:bold;

}

.btn-simpan{
    background:#2ecc71;
    flex:2;
}

.btn-kembali{
    background:#95a5a6;
    flex:1;
}

.error-msg{
    color:red;
    margin-bottom:15px;
}

</style>

</head>

<body>

<div class="container">

<h2>Tambah Kelas Gym</h2>

<?php if($error!=""){ ?>

<div class="error-msg">

<?= htmlspecialchars($error); ?>

</div>

<?php } ?>

<form method="POST">

<div class="form-group">

<label>Nama Kelas</label>

<input
type="text"
name="nama_kelas"
value="<?= htmlspecialchars($nama_kelas); ?>"
required>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"><?= htmlspecialchars($deskripsi); ?></textarea>

</div>

<div class="form-group">

<label>Hari</label>

<select name="hari" required>

<option value="">-- Pilih Hari --</option>

<?php

$hariList = [
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
    "Minggu"
];

foreach($hariList as $h){

?>

<option
value="<?= $h; ?>"
<?= ($hari==$h) ? "selected" : ""; ?>>

<?= $h; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Jam</label>

<input
type="time"
name="jam"
value="<?= htmlspecialchars($jam); ?>"
required>

</div>

<div class="form-group">

<label>Kuota</label>

<input
type="number"
name="kuota"
min="1"
value="<?= htmlspecialchars($kuota); ?>"
required>

</div>

<div class="form-group">

<label>Nama Trainer</label>

<input
type="text"
name="nama_trainer"
value="<?= htmlspecialchars($nama_trainer); ?>"
required>

</div>

<div class="btn-group">
<a href="index_kelas.php" class="btn btn-kembali">Batal</a>

<button type="submit" class="btn btn-simpan">Simpan Kelas</button>
</div>
</form>
</div>
</body>
</html>