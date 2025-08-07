<?php
// Koneksi ke database
//$conn = new mysqli("localhost", "root", "", "winkur");
require 'config/database.php';
// Ambil data user berdasarkan id
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user = [];
if ($id > 0) {
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $user = $result->fetch_assoc();
}

// Ambil data role dan divisi
$roles = [];
$divisis = [];
$roleResult = $conn->query("SELECT * FROM roles");
while ($row = $roleResult->fetch_assoc()) {
    $roles[] = $row;
}
$divisiResult = $conn->query("SELECT * FROM divisi");
while ($row = $divisiResult->fetch_assoc()) {
    $divisis[] = $row;
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //  $nama = $conn->real_escape_string($_POST['nama']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $role_id = intval($_POST['role_id']);
    $divisi_id = intval($_POST['divisi_id']);

    $sql = "UPDATE users SET  username='$username', email='$email', role_id=$role_id, divisi_id=$divisi_id WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('User berhasil diupdate');window.location='?page=users';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal update user: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            <form method="post">
               
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">--Pilih Role--</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role['id'] ?>" <?= ($user['role_id'] ?? '') == $role['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($role['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Divisi</label>
                    <select name="divisi_id" class="form-select" required>
                        <option value="">--Pilih Divisi--</option>
                        <?php foreach ($divisis as $divisi): ?>
                            <option value="<?= $divisi['id'] ?>" <?= ($user['divisi_id'] ?? '') == $divisi['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($divisi['nama_divisi']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="?page=users" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>