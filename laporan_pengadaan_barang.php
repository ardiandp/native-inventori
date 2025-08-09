<?php
// Koneksi ke database

require 'config/database.php';
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel pengadaan_barang
$sql = "SELECT *FROM pengadaan_barang LEFT JOIN barang ON pengadaan_barang.`barang_id`=barang.`id`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengadaan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pengadaan Barang</h2>
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tanggal Pengadaan</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?php echo $row['jumlah']; ?></td>
                        <td><?php echo htmlspecialchars($row['satuan']); ?></td>
                        <td><?php echo $row['tanggal_pengadaan']; ?></td>
                        <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                         <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $conn->close(); ?>
</body>
</html>

