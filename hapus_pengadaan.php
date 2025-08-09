<?php
// Koneksi ke database
require 'config/database.php';

// Ambil id dari parameter GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query hapus data
    $sql = "DELETE FROM pengadaan_barang WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='?page=tampil_pengadaan_barang';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak valid.";
}

$conn->close();
?>
