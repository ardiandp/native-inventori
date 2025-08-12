<?php
// Koneksi ke database

require 'config/database.php';
// Query data dari tabel request_barang beserta relasi divisi dan barang
$sql = "SELECT rb.id, d.nama_divisi AS divisi_nama, b.nama_barang AS barang_nama, rb.jumlah, rb.status
    FROM request_barang rb
    LEFT JOIN divisi d ON rb.divisi_id = d.id
    LEFT JOIN barang b ON rb.barang_id = b.id";
$request_result = $conn->query($sql);
?>


<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Laporan Permintaan Barang</h2>
         <button type="button" class="btn btn-primary" onclick="exportPdf()">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
    </div>
    <div class="table-responsive">
        <table id="requestTable" class="table table-bordered table-striped" width="100%" cellspacing="0">
            <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Bagian</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($req = $request_result->fetch_assoc()): ?>
            <tr>
                <td><?php static $counter = 1; echo $counter++; ?></td>
                <td><?php echo htmlspecialchars($req['divisi_nama']); ?></td>
                <td><?php echo htmlspecialchars($req['barang_nama']); ?></td>
                <td><?php echo $req['jumlah']; ?></td>
                <td>
                    <?php
                    $status = $req['status'];
                    $badgeClass = '';
                    switch ($status) {
                        case 'draft':
                            $badgeClass = 'badge bg-secondary';
                            break;
                        case 'diproses':
                            $badgeClass = 'badge bg-info text-dark';
                            break;
                        case 'disetujui':
                            $badgeClass = 'badge bg-success';
                            break;
                        case 'ditolak':
                            $badgeClass = 'badge bg-danger';
                            break;
                        case 'selesai':
                            $badgeClass = 'badge bg-primary';
                            break;
                        default:
                            $badgeClass = 'badge bg-light text-dark';
                    }
                    ?>
                    <span class="<?php echo $badgeClass; ?>">
                        <?php echo htmlspecialchars($status); ?>
                    </span>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <div class="card-footer">
          
        </div>

        <script>
            function exportPdf() {
                var sTable = document.getElementById('requestTable').outerHTML;

                var style = "<style>";
                style = style + "table {width: 100%;font: 17px Calibri;}";
                style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
                style = style + "padding: 2px 3px;text-align: center;}";
                style = style + "</style>";

                // CREATE A WINDOW OBJECT.
                var win = window.open('', '', 'height=700,width=700');

                win.document.write('<html><head>');
                win.document.write('<title>Laporan Permintaan Barang</title>'); // <title> FOR PDF HEADER.
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

