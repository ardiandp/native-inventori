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
    <h2 class="mb-4">Laporan Pengadaan Barang</h2>
    
   
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
                        <td><?php static $counter = 1; echo $counter++; ?></td>
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

 <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="exportPdf()">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
        </div>

        <script>
            function exportPdf() {
                var sTable = document.querySelector('.table-bordered').outerHTML;

                var style = "<style>";
                style += "table {width: 100%;font: 17px Calibri;}";
                style += "table, th, td {border: solid 1px #DDD; border-collapse: collapse;}";
                style += "th, td {padding: 2px 3px;text-align: center;}";
                style += "</style>";

                var win = window.open('', '', 'height=700,width=700');

                win.document.write('<html><head>');
                win.document.write('<title>Daftar Pengadaan Barang</title>');
                win.document.write(style);
                win.document.write('</head><body>');
                win.document.write(sTable);
                win.document.write('</body></html>');

                win.document.close();

                win.print();
            }
        </script>
<?php $conn->close(); ?>
</body>
</html>

