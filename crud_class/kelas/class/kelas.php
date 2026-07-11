<?php

include '../config/con-db.php';

class Kelas extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create($nama,$deskripsi,$kuota,$trainer)
    {
        $sql = "INSERT INTO kelas
                (nama_kelas,deskripsi,kuota,nama_trainer)
                VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssis",
            $nama,
            $deskripsi,
            $kuota,
            $trainer
        );

        return $stmt->execute();
    }

    public function read()
    {
        return $this->conn->query("SELECT * FROM kelas");
    }

}