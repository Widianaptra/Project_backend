<?php

require_once __DIR__ . '/../../../db_gym/config/con-db.php';

class Kelas extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // Menambah data kelas
    public function create($nama, $deskripsi, $hari, $jam, $kuota, $trainer)
    {
        $sql = "INSERT INTO kelas
                (nama_kelas, deskripsi, hari, jam, kuota, nama_trainer)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param(
            "ssssis",
            $nama,
            $deskripsi,
            $hari,
            $jam,
            $kuota,
            $trainer
        );

        return $stmt->execute();
    }

    // Menampilkan semua data kelas
    public function read()
    {
        $sql = "SELECT * FROM kelas ORDER BY hari, jam";

        return $this->conn->query($sql);
    }

    // Mengambil satu data berdasarkan ID
   public function getById($id)
{
    $stmt = $this->conn->prepare("
        SELECT *
        FROM kelas
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}
    // Mengubah data kelas
    public function update($id, $nama, $deskripsi, $hari, $jam, $kuota, $trainer)
    {
        $sql = "UPDATE kelas SET
                nama_kelas=?,
                deskripsi=?,
                hari=?,
                jam=?,
                kuota=?,
                nama_trainer=?
                WHERE id=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssssisi",
            $nama,
            $deskripsi,
            $hari,
            $jam,
            $kuota,
            $trainer,
            $id
        );

        return $stmt->execute();
    }

    // Menghapus data kelas
    public function delete($id)
    {
        $sql = "DELETE FROM kelas WHERE id=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }


    //cek kelas
    public function sudahAmbil($memberId, $kelasId)
{
    $stmt = $this->conn->prepare("
        SELECT id
        FROM member_kelas
        WHERE member_id = ?
        AND kelas_id = ?
    ");

    $stmt->bind_param("ii", $memberId, $kelasId);
    $stmt->execute();

    return $stmt->get_result()->num_rows > 0;
}

//cek kuota kelas
public function cekKuota($kelasId)
{
    $stmt = $this->conn->prepare("
        SELECT kuota
        FROM kelas
        WHERE id = ?
    ");

    $stmt->bind_param("i", $kelasId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['kuota'];
    }

    return 0;
}

//pengurangan kuota
public function kurangiKuota($kelasId)
{
    $stmt = $this->conn->prepare("
        UPDATE kelas
        SET kuota = kuota - 1
        WHERE id = ?
    ");

    $stmt->bind_param("i", $kelasId);

    return $stmt->execute();
}

//ambil kelas
public function ambilKelas($memberId, $kelasId)
{
    // Cek apakah sudah mengambil kelas
    if ($this->sudahAmbil($memberId, $kelasId)) {
        return [
            'status' => false,
            'pesan' => 'Anda sudah mengambil kelas ini.'
        ];
    }

    // Cek kuota
    $kuota = $this->cekKuota($kelasId);

    if ($kuota <= 0) {
        return [
            'status' => false,
            'pesan' => 'Kuota kelas sudah penuh.'
        ];
    }

    // Simpan ke tabel member_kelas
    $stmt = $this->conn->prepare("
        INSERT INTO member_kelas
        (member_id, kelas_id)
        VALUES (?, ?)
    ");

    $stmt->bind_param("ii", $memberId, $kelasId);

    if ($stmt->execute()) {

        // Kurangi kuota
        $this->kurangiKuota($kelasId);

        return [
            'status' => true,
            'pesan' => 'Berhasil mengambil kelas.'
        ];
    }

    return [
        'status' => false,
        'pesan' => 'Gagal mengambil kelas.'
    ];
}
}