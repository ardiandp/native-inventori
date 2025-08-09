<?php

// Koneksi database
require 'config/database.php';

// Query untuk mendapatkan data barang masuk dengan join ke tabel barang
$query = "SELECT 
            bm.id,
            b.nama_barang,
            bm.jumlah,
            bm.tanggal_masuk,
            bm.created_at,
            bm.updated_at
          FROM barang_masuk bm
          JOIN barang b ON bm.barang_id = b.id
          ORDER BY bm.tanggal_masuk DESC";

$result = $conn->query($query);

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Barang</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Masuk</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama_barang'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= $row['tanggal_masuk'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td><?= $row['updated_at'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="exportPdf()">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
        </div>

        <script>
            function exportPdf() {
                var sTable = document.getElementById('dataTable').outerHTML;

                var style = "<style>";
                style = style + "table {width: 100%;font: 17px Calibri;}";
                style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
                style = style + "padding: 2px 3px;text-align: center;}";
                style = style + "</style>";

                // CREATE A WINDOW OBJECT.
                var win = window.open('', '', 'height=700,width=700');

                win.document.write('<html><head>');
                win.document.write('<title>Barang Masuk</title>'); // <title> FOR PDF HEADER.
                win.document.write(style); // ADD STYLE INSIDE THE HEAD TAG.
                win.document.write('</head>');
                win.document.write('<body>');
                win.document.write(sTable); // THE TABLE CONTENTS INSIDE THE BODY TAG.
                win.document.write('</body></html>');

                win.document.close(); // CLOSE THE CURRENT WINDOW.

                win.print(); // PRINT THE CONTENTS.
            }
        </script>
    </div>
</div>
