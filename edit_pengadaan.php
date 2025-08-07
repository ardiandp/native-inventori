<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "winkur");

// Ambil data pengadaan berdasarkan id
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pengadaan = [];
if ($id > 0) {
    $result = $conn->query("SELECT * FROM pengadaan_barang WHERE id = $id");
    $pengadaan = $result->fetch_assoc();
}

// Proses update pengadaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $conn->real_escape_string($_POST['nama_barang']);
    $jumlah = (int)$_POST['jumlah'];
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $tanggal_pengadaan = $conn->real_escape_string($_POST['tanggal_pengadaan']);
    $keterangan = isset($_POST['keterangan']) ? $conn->real_escape_string($_POST['keterangan']) : null;
    $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : null;

    $sql = "UPDATE pengadaan_barang SET 
            nama_barang='$nama_barang', 
            jumlah=$jumlah, 
            satuan='$satuan', 
            tanggal_pengadaan='$tanggal_pengadaan', 
            keterangan='$keterangan', 
            status='$status', 
            updated_at=CURRENT_TIMESTAMP 
            WHERE id=$id";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Data pengadaan berhasil diupdate');window.location='?page=tampil_pengadaan_barang';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal update pengadaan: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengadaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Pengadaan Barang</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label" for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?= htmlspecialchars($pengadaan['nama_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jumlah">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" class="form-control" value="<?= htmlspecialchars($pengadaan['jumlah']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="satuan">Satuan</label>
            <input type="text" id="satuan" name="satuan" class="form-control" value="<?= htmlspecialchars($pengadaan['satuan']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="tanggal_pengadaan">Tanggal Pengadaan</label>
            <input type="date" id="tanggal_pengadaan" name="tanggal_pengadaan" class="form-control" value="<?= htmlspecialchars($pengadaan['tanggal_pengadaan']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="form-control"><?= htmlspecialchars($pengadaan['keterangan']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="draft" <?= $pengadaan['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                <option value="diproses" <?= $pengadaan['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="disetujui" <?= $pengadaan['status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                <option value="ditolak" <?= $pengadaan['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                <option value="selesai" <?= $pengadaan['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>

