<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "winkur");

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
        <button id="exportPDF" class="btn btn-danger">Export PDF</button>
    </div>
    <div class="table-responsive">
        <table id="requestTable" class="table table-bordered table-striped" width="100%" cellspacing="0">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Divisi</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($req = $request_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $req['id']; ?></td>
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
    </div>
</div>

<script>
$(document).ready(function() {
    $('#requestTable').DataTable();
    $('#exportPDF').on('click', function() {
        html2canvas(document.querySelector("#requestTable")).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new window.jspdf.jsPDF('l', 'pt', 'a4');
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            const imgWidth = pageWidth - 40;
            const imgHeight = canvas.height * imgWidth / canvas.width;
            pdf.addImage(imgData, 'PNG', 20, 20, imgWidth, imgHeight);
            pdf.save("laporan_permintaan_barang.pdf");
        });
    });
});
</script>
