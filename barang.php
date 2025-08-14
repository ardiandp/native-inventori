<?php
// Koneksi database
//$conn = new mysqli("localhost", "dev", "terserah", "winkur");
require 'config/database.php';
// Proses tambah barang
if  (isset($_POST['tambah_barang'])) {
    $nama_barang = $conn->real_escape_string($_POST['nama_barang']);
    $kategori = $conn->real_escape_string($_POST['kategori'] ?? '');
    $stok_awal = intval($_POST['stok_awal']);
    $satuan = $conn->real_escape_string($_POST['satuan']);

    if (!empty($nama_barang) && !empty($satuan)) {
        $query = "INSERT INTO barang (nama_barang, kategori, stok_awal, satuan) 
                 VALUES ('$nama_barang', '$kategori', $stok_awal, '$satuan')";
        $conn->query($query);
    }
   // header("Location: barang.php");
    echo "<script>
        alert('Data berhasil disimpan!');
        window.location.href = '?page=barang';
    </script>";
    exit();
}

// Proses hapus barang
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $conn->query("DELETE FROM barang WHERE id = $id");
   echo "<script>
        alert('Data berhasil Dihpus!');
        window.location.href = '?page=barang';
    </script>";
    exit();
}

// Ambil data barang
$query = "SELECT
    b.*,
    COALESCE(SUM(bm.jumlah), 0) - COALESCE(SUM(bk.jumlah), 0) AS jml_real
FROM
    barang b
LEFT JOIN
    barang_masuk bm ON b.id = bm.barang_id
LEFT JOIN
    barang_keluar bk ON b.id = bk.barang_id
GROUP BY
    b.id, b.nama_barang, b.kategori";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Barang</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
        </div>
         <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="exportPdf()">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
        </div>
        <div class="card-body">
            <!-- Form Tambah Barang -->
            <form method="POST" class="mb-4">
                <div class="form-row">
                    <div class="col-md-3">
                        <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kategori" class="form-control" placeholder="Kategori">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="stok_awal" class="form-control" placeholder="Stok Awal" min="0" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="satuan" class="form-control" placeholder="Satuan (pcs, kg, etc)" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="tambah_barang" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabel Daftar Barang -->
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok Awal</th>
                            <th width="10%">Stok Real</th>
                            <th>Satuan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                            <td><?= !empty($row['kategori']) ? htmlspecialchars($row['kategori']) : '-' ?></td>
                            <td class="text-right"><?= number_format($row['stok_awal'], 0, ',', '.') ?></td>
                            <td class="text-right">
                               <?php echo number_format($row['jml_real'], 0, ',', '.'); ?>
                            </td>
                            <td><?= htmlspecialchars($row['satuan']) ?></td>
                            <td class="text-center">
                                <a href="?page=barang_edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="main.php?page=barang&hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin hapus barang ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

 <script>
    function exportPdf() {
        var sTable = document.querySelector('.table-responsive table').outerHTML;

        var style = "<style>";
        style += "table {width: 100%;font: 17px Calibri;}";
        style += "table, th, td {border: solid 1px #DDD; border-collapse: collapse;}";
        style += "th, td {padding: 2px 3px;text-align: center;}";
        style += "</style>";

        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Daftar Barang</title>');
        win.document.write(style);
        win.document.write('</head><body>');
        win.document.write(sTable);
        win.document.write('</body></html>');

        win.document.close();

        win.print();
    }
</script>

<?php $conn->close(); ?>