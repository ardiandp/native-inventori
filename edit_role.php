<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "winkur");

// Ambil data role berdasarkan id
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$role = ['name' => '', 'description' => ''];
if ($id > 0) {
    $result = $conn->query("SELECT * FROM roles WHERE id=$id");
    if ($result && $result->num_rows > 0) {
        $role = $result->fetch_assoc();
    }
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : null;
    $update = $conn->query("UPDATE roles SET name='$name', description=" . ($description !== null ? "'$description'" : "NULL") . " WHERE id=$id");
    if ($update) {
        echo "<script>alert('Role berhasil diupdate');window.location='?page=roles';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal update role</div>";
    }
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Menu</h1>
    </div>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Role</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Role</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($role['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($role['description']); ?>">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="?page=roles" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>