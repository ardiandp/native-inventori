<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "winkur");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil id dari parameter GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query hapus data
    $sql = "DELETE FROM request_barang WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='?page=user_request_barang';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak valid.";
}

$conn->close();
?>