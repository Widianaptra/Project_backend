<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../db_gym/config/con-db.php';

$database = new Database();
$conn = $database->getConnection();

$method = $_SERVER["REQUEST_METHOD"];

function sendResponse($status, $data = null)
{
    http_response_code($status);
    echo json_encode($data);
}

if ($method == "GET") {
    // Mengambil seluruh data inventaris alat gym
    $query = "SELECT * FROM alat_gym";
    $result = mysqli_query($conn, $query);
    
    $dataAlat = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataAlat[] = $row;
        }
    }
    sendResponse(200, $dataAlat);

} elseif ($method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $nama_alat   = $data['nama_alat'] ?? null;
    $kategori    = $data['kategori'] ?? null;
    $jumlah_stok = $data['jumlah_stok'] ?? null;
    
    // Trik Pengaman Kondisi: Paksa jadi huruf kecil ('baik' / 'rusak') sesuai ENUM database
    $input_kondisi = isset($data['kondisi']) ? strtolower(trim($data['kondisi'])) : null;
    if ($input_kondisi == 'baik' || $input_kondisi == 'bagus') {
        $kondisi = 'baik';
    } else {
        $kondisi = 'rusak';
    }

    if (!$nama_alat || !$kategori || $jumlah_stok === null) {
        sendResponse(400, ["message" => "Data tidak lengkap untuk menambah alat gym"]);
        exit;
    }

    $query = "INSERT INTO alat_gym (nama_alat, kategori, jumlah_stok, kondisi) 
              VALUES ('$nama_alat', '$kategori', '$jumlah_stok', '$kondisi')";
              
    if (mysqli_query($conn, $query)) {
        sendResponse(201, ["message" => "Data alat gym berhasil disimpan"]);
    } else {
        sendResponse(500, ["message" => "Data alat gym gagal disimpan: " . mysqli_error($conn)]);
    }

} elseif ($method == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id          = $data['id'] ?? null;
    $nama_alat   = $data['nama_alat'] ?? null;
    $kategori    = $data['kategori'] ?? null;
    $jumlah_stok = $data['jumlah_stok'] ?? null;
    
    // Trik Pengaman Kondisi untuk Update
    $input_kondisi = isset($data['kondisi']) ? strtolower(trim($data['kondisi'])) : null;
    if ($input_kondisi == 'baik' || $input_kondisi == 'bagus') {
        $kondisi = 'baik';
    } else {
        $kondisi = 'rusak';
    }

    if (!$id || !$nama_alat || !$kategori || $jumlah_stok === null) {
        sendResponse(400, ["message" => "Data tidak lengkap untuk mengubah alat gym"]);
        exit;
    }

    $query = "UPDATE alat_gym SET 
              nama_alat = '$nama_alat', 
              kategori = '$kategori', 
              jumlah_stok = '$jumlah_stok', 
              kondisi = '$kondisi' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        sendResponse(200, ["message" => "Alat Gym ID " . $id . " berhasil diperbarui"]);
    } else {
        sendResponse(500, ["message" => "Alat Gym ID " . $id . " gagal diperbarui: " . mysqli_error($conn)]);
    }

} elseif ($method == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = isset($data['id']) ? (int)$data['id'] : null;

    if (!$id) {
        sendResponse(400, ["message" => "ID alat gym wajib diisi"]);
        exit;
    }

    $query = "DELETE FROM alat_gym WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        sendResponse(200, ["message" => "Alat Gym ID " . $id . " berhasil dihapus"]);
    } else {
        sendResponse(500, ["message" => "Alat Gym ID " . $id . " gagal dihapus: " . mysqli_error($conn)]);
    }

} else {
    sendResponse(405, ["message" => "Method invalid"]);
}
?>