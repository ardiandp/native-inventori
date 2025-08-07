<?php
$conn = new mysqli("localhost", "dev", "terserah", "winkur");

// Ambil data barang
$query = "SELECT id, nama_barang, kategori, stok_awal, satuan FROM barang ORDER BY id DESC";
$barang_result = $conn->query($query);
?>

<!-- Bootstrap CSS CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jsPDF CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.0/jspdf.plugin.autotable.min.js"></script>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Persediaan Barang</h1>
        <button id="exportPDF" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="barangTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok Awal</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($barang = $barang_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $barang['id']; ?></td>
                            <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                            <td><?php echo htmlspecialchars($barang['kategori']); ?></td>
                            <td><?php echo $barang['stok_awal']; ?></td>
                            <td><?php echo htmlspecialchars($barang['satuan']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- FontAwesome CDN for PDF icon -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
document.getElementById('exportPDF').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF();
    doc.text("Laporan Persediaan Barang", 14, 15);
    doc.autoTable({ 
        html: '#barangTable',
        startY: 25,
        headStyles: { fillColor: [41,128,185] }
    });
    doc.save('laporan_barang.pdf');
});
</script>

<?php $conn->close(); ?>
