<?php
// Koneksi database
//$conn = new mysqli("localhost", "dev", "terserah", "winkur");
require 'config/database.php';
// Ambil data divisi
$query = "SELECT d.id, d.nama_divisi, d.created_at, d.updated_at 
          FROM divisi d 
          ORDER BY d.id DESC";
$result = $conn->query($query);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Divisi</h1>
        
    </div>

    <!-- Modal Tambah Divisi -->
    <div class="modal fade" id="tambahDivisiModal" tabindex="-1" role="dialog" aria-labelledby="tambahDivisiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDivisiModalLabel">Tambah Divisi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                       
                        <div class="form-group">
                            <label for="nama_divisi">Nama Divisi</label>
                            <input type="text" class="form-control" id="nama_divisi" name="nama_divisi" required>
                        </div>                       
                        <button type="submit" name="tambah_divisi" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Divisi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDivisiModal">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Divisi</th>
                            <th>Dibuat Pada</th>
                          
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($divisi = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $divisi['id'] ?></td>
                            <td><?= htmlspecialchars($divisi['nama_divisi']) ?></td>
                            <td><?= $divisi['created_at'] ? date('d/m/Y H:i', strtotime($divisi['created_at'])) : '-' ?></td>
                            
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editDivisiModal<?= $divisi['id'] ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <div class="modal fade" id="editDivisiModal<?= $divisi['id'] ?>" tabindex="-1" aria-labelledby="editDivisiModalLabel<?= $divisi['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editDivisiModalLabel<?= $divisi['id'] ?>">Edit Nama Divisi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?= $divisi['id'] ?>">
                                                        <label for="nama_divisi_<?= $divisi['id'] ?>">Nama Divisi</label>
                                                        <input type="text" class="form-control" id="nama_divisi_<?= $divisi['id'] ?>" name="nama_divisi" value="<?= htmlspecialchars($divisi['nama_divisi']) ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_divisi">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="?page=hapus_divisi&id=<?= $divisi['id'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
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
<?php
if (isset($_POST['edit_divisi'])) {
    $id = intval($_POST['id']);
    $nama_divisi = $conn->real_escape_string($_POST['nama_divisi']);
    $updated_at = date('Y-m-d H:i:s');
    $query = "UPDATE divisi SET nama_divisi = '$nama_divisi', updated_at = '$updated_at' WHERE id = $id";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='main.php?page=divisi';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}
?>

<?php
if (isset($_POST['tambah_divisi'])) {
    $nama_divisi =$_POST['nama_divisi'];
    $creted_at = date('Y-m-d H:i:s');
    $query = "INSERT INTO divisi (nama_divisi, created_at) VALUES ('$nama_divisi', '$creted_at')";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='main.php?page=divisi';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<?php $conn->close(); ?>
