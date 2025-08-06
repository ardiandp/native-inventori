<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM roles WHERE id = $id");
    echo "<script>alert('Role berhasil dihapus!'); window.history.back();</script>";
    exit();
}
