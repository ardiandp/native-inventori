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
         require 'config/database.php';
            //$conn = new mysqli("localhost", "root", "", "winkur"); // Ganti nama_database sesuai kebutuhan
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
                <select id="nama_barang" name="barang_id" class="form-control" required>
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
                <input type="text" id="status" name="status" class="form-control" value="draft" readonly>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
    require 'config/database.php';
   
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $barang_id = $conn->real_escape_string($_POST['barang_id']);
    $jumlah = (int)$_POST['jumlah'];
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $tanggal_pengadaan = $conn->real_escape_string($_POST['tanggal_pengadaan']);
    $keterangan = isset($_POST['keterangan']) ? $conn->real_escape_string($_POST['keterangan']) : null;
    $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : null;

    $sql = "INSERT INTO pengadaan_barang 
        (barang_id, jumlah, satuan, tanggal_pengadaan, keterangan, status, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sissss",
        $barang_id,
        $jumlah,
        $satuan,
        $tanggal_pengadaan,
        $keterangan,
        $status
    );

    if ($stmt->execute()) {
        echo "<script>
            alert('Data pengadaan barang berhasil disimpan.');
            window.location.href='?page=tampil_pengadaan_barang_bu';
        </script>";
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menyimpan data: ' . htmlspecialchars($stmt->error) . '</div>';
    }

    $stmt->close();
    $conn->close();
}
?>