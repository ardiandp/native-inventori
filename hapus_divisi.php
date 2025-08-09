<?php
// Koneksi database

require 'config/database.php';
// Proses hapus divisi
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM divisi WHERE id = $id";
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Divisi berhasil dihapus!'); window.location.href='?page=divisi';</script>";
    } else {
        echo "<script>alert('Gagal menghapus divisi: " . $conn->error . "');</script>";
    }
    $conn->close();
}
