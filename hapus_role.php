<?php
require_once 'config/database.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $result = $conn->query("DELETE FROM roles WHERE id = $id");
        if ($result) {
            echo "<script>alert('Role berhasil dihapus!'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal menghapus role: " . $conn->error . "');</script>";
        }
        $conn->close();
    }

