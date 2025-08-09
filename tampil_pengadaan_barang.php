<?php
// Koneksi ke database
// $koneksi = new mysqli("localhost", "root", "", "winkur");
require 'config/database.php';
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tabel pengadaan_barang
$sql = " select pengadaan_barang.id AS idpengadaan,
  pengadaan_barang.*,
  barang.*
FROM pengadaan_barang
LEFT JOIN barang
  ON pengadaan_barang.barang_id = barang.id";
$result = $conn->query($sql);
?>
<div class="container-fluid">
    <div class="card shadow mb-4"></div>
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengadaan Barang</h6>
            <a href="?page=input_pengadaan_barang" class="btn btn-primary btn-sm">Tambah Pengadaan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pengadaan</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td> {$row['idpengadaan']}</td>
                                    <td>{$row['nama_barang']}</td>
                                    <td>{$row['jumlah']}</td>
                                    <td>{$row['tanggal_pengadaan']}</td>
                                    <td>{$row['keterangan']}</td>
                                    <td>{$row['status']}</td>
                                    <td>
                                        <a href='?page=edit_pengadaan&id={$row['idpengadaan']}' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='?page=hapus_pengadaan&id={$row['idpengadaan']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$conn->close();
?>
