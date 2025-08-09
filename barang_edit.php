<?php
require 'config/database.php';

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $nama_barang = $conn->real_escape_string($_POST['nama_barang']);
    $kategori = $conn->real_escape_string($_POST['kategori']);
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $stok_awal = intval($_POST['stok_awal']);

    $conn->query("UPDATE barang SET nama_barang = '$nama_barang', kategori = '$kategori', satuan = '$satuan', stok_awal = $stok_awal WHERE id = $id");

    echo "<script>  
        alert('Data berhasil disimpan!');
        window.location.href = '?page=barang';
    </script>";
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM barang WHERE id = $id");
    $row = $result->fetch_assoc();
} else {
    echo "<script>  
        alert('Data tidak ditemukan!');
        window.location.href = 'barang.php';
    </script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header bg-primary text-white">
                        Edit Barang
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" value="<?= htmlspecialchars($row['nama_barang']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <input type="text" class="form-control" name="kategori" value="<?= htmlspecialchars($row['kategori']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="<?= htmlspecialchars($row['satuan']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Stok Awal</label>
                                <input type="number" class="form-control" name="stok_awal" value="<?= $row['stok_awal'] ?>">
                            </div>
                            <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
