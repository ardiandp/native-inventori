<!DOCTYPE html>
<html>
<head>
    <title>Form Input Pengadaan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Form Input Pengadaan Barang</h2>
        <form action="" method="post">
            <?php
            // Koneksi ke database
            $conn = new mysqli("localhost", "root", "", "winkur"); // Ganti nama_database sesuai kebutuhan
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Ambil data barang
            $barang = [];
            $sql = "SELECT id, nama_barang FROM barang ORDER BY nama_barang ASC";
            $result = $conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $barang[] = $row;
                }
            }
            $conn->close();
            ?>
            <div class="mb-3">
                <label class="form-label" for="nama_barang">Nama Barang</label>
                <select id="nama_barang" name="nama_barang" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($barang as $b): ?>
                        <option value="<?= htmlspecialchars($b['id']) ?>"><?= htmlspecialchars($b['nama_barang']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="satuan">Satuan</label>
                <input type="text" id="satuan" name="satuan" class="form-control" maxlength="20" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="tanggal_pengadaan">Tanggal Pengadaan</label>
                <input type="date" id="tanggal_pengadaan" name="tanggal_pengadaan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="diproses">Diproses</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
    $conn = new mysqli("localhost", "root", "", "winkur");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama_barang = $conn->real_escape_string($_POST['nama_barang']);
    $jumlah = (int)$_POST['jumlah'];
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $tanggal_pengadaan = $conn->real_escape_string($_POST['tanggal_pengadaan']);
    $keterangan = isset($_POST['keterangan']) ? $conn->real_escape_string($_POST['keterangan']) : null;
    $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : null;

    $sql = "INSERT INTO pengadaan_barang 
        (nama_barang, jumlah, satuan, tanggal_pengadaan, keterangan, status, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sissss",
        $nama_barang,
        $jumlah,
        $satuan,
        $tanggal_pengadaan,
        $keterangan,
        $status
    );

    if ($stmt->execute()) {
        echo "<script>
            alert('Data pengadaan barang berhasil disimpan.');
            window.location.href='?page=tampil_pengadaan_barang';
        </script>";
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menyimpan data: ' . htmlspecialchars($stmt->error) . '</div>';
    }

    $stmt->close();
    $conn->close();
}
?>