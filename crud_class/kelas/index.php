<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas Gym</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f7f6; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn-tambah { background-color: #2ecc71; color: white; }
        .btn-edit { background-color: #f39c12; color: white; padding: 5px 10px; font-size: 12px; }
        .btn-hapus { background-color: #e74c3c; color: white; padding: 5px 10px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #34495e; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .aksi-buttons { display: flex; gap: 5px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Daftar Kelas Gym</h2>
        <!-- Tombol mengarah ke file create.php di folder yang sama -->
        <a href="create.php" class="btn btn-tambah">+ Tambah Kelas Baru</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Kelas</th>
                <th style="width: 45%;">Deskripsi</th>
                <th style="width: 10%;">Durasi</th>
                <th style="width: 15%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($list_kelas as $kelas): 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><strong><?= htmlspecialchars($kelas['nama_kelas']); ?></strong></td>
                <td><?= htmlspecialchars($kelas['deskripsi']); ?></td>
                <td><?= htmlspecialchars($kelas['durasi']); ?></td>
                <td>
                    <div class="aksi-buttons">
                        <!-- Mengirimkan ID lewat URL untuk proses Edit dan Delete -->
                        <a href="edit.php?id=<?= $kelas['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $kelas['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>