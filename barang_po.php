<?php
// Koneksi database
$conn = new mysqli("localhost", "dev", "terserah", "winkur");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah id barang ada
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM barang WHERE id = $id";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $barang = $result->fetch_assoc();
    } else {
        header("Location: barang.php");
        exit();
    }
} else {
    header("Location: barang.php");
    exit();
}

// Proses tambah PO
if (isset($_POST['tambah_po'])) {
    $order_id = intval($_POST['order_id']);
    $supplier = $conn->real_escape_string($_POST['supplier']);
    $order_date = date('Y-m-d', strtotime($_POST['order_date']));
    $total_amount = floatval($_POST['total_amount']);
    $status = $conn->real_escape_string($_POST['status']);
    $notes = $conn->real_escape_string($_POST['notes']);

    if ($order_id > 0 && !empty($supplier) && $total_amount > 0) {
        $query = "INSERT INTO po (order_id, supplier, order_date, total_amount, status, notes) 
                 VALUES ($order_id, '$supplier', '$order_date', $total_amount, '$status', '$notes')";
        $conn->query($query);
        header("Location: barang.php");
        exit();
    }
}

// Ambil data PO terakhir
$query = "SELECT * FROM po WHERE order_id = $id ORDER BY order_date DESC LIMIT 1";
$result = $conn->query($query);
$po_terakhir = $result->fetch_assoc();

// Ambil data stok awal
$query = "SELECT stok_awal FROM barang WHERE id = $id";
$result = $conn->query($query);
$stok_awal = $result->fetch_assoc()['stok_awal'];

// Hitung stok saat ini
$stok_saat_ini = $stok_awal;
if (isset($po_terakhir['total_amount'])) {
    $stok_saat_ini += $po_terakhir['total_amount'];
}

// Tampilan
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah PO Barang</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data PO Barang</h6>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-row">
                    <div class="col-md-2">
                        <input type="hidden" name="order_id" value="<?= $id ?>">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" readonly value="<?= $barang['nama_barang'] ?>">
                    </div>
                    <div class="col-md-2">
                        <label>Supplier</label>
                        <input type="text" name="supplier" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label>Tanggal PO</label>
                        <input type="date" name="order_date" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label>Total Amount</label>
                        <input type="number" name="total_amount" class="form-control" placeholder="Total Amount" min="0.01" step="0.01" required>
                    </div>
                    <div class="col-md-2">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Stok Awal</label>
                        <input type="text" class="form-control" readonly value="<?= number_format($stok_awal, 0, ',', '.') ?>">
                    </div>
                    <div class="col-md-2">
                        <label>Stok Saat Ini</label>
                        <input type="text" class="form-control" readonly value="<?= number_format($stok_saat_ini, 0, ',', '.') ?>">
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" name="tambah_po" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

