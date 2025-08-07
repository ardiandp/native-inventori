<?php
require 'config/database.php';
// Fetch edit data based on the provided 'id' parameter
if (isset($_GET['id'])) {
    $edit_id = intval($_GET['id']);
    $query = "SELECT * FROM menus WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_data = $stmt->get_result()->fetch_assoc();
} else {
    $edit_data = [
        'id' => '',
        'parent_id' => '',
        'name' => '',
        'icon' => '',
        'url' => '',
        'order' => '',
        'is_active' => ''
    ];
}
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Menu</h1>
    </div>
<form action="" method="post">
    <div class="form-group">
        <label for="parent_id">Parent Menu</label>
        <select name="parent_id" id="parent_id" class="form-control">
            <option value="">-- Pilih Parent Menu --</option>
            <?php
            $query = "SELECT id, name FROM menus WHERE id != ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $edit_data['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $selected = ($row['id'] == $edit_data['parent_id']) ? 'selected' : '';
                echo "<option value=\"{$row['id']}\" $selected>{$row['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id">ID Menu</label>
        <input type="number" name="id" id="id" class="form-control" value="<?= $edit_data['id'] ?>" readonly>
    </div>
    <div class="form-group">
        <label for="name">Nama Menu</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= $edit_data['name'] ?>">
    </div>
    <div class="form-group">
        <label for="icon">Icon</label>
        <input type="text" name="icon" id="icon" class="form-control" value="<?= $edit_data['icon'] ?>">
    </div>
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" name="url" id="url" class="form-control" value="<?= $edit_data['url'] ?>">
    </div>
    <div class="form-group">
        <label for="order">Urutan</label>
        <input type="number" name="order" id="order" class="form-control" value="<?= $edit_data['order'] ?>">
    </div>
    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" <?= $edit_data['is_active'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>
    </div>
    <button type="submit" name="edit_menu" class="btn btn-warning">Update</button>
    <a href="?page=menus" class="btn btn-secondary">Batal</a>
</form>

<?php
if (isset($_POST['edit_menu'])) {
    $id = intval($_POST['id']);
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
    $name = $conn->real_escape_string($_POST['name']);
    $icon = $conn->real_escape_string($_POST['icon'] ?? '');
    $url = $conn->real_escape_string($_POST['url'] ?? '');
    $order = intval($_POST['order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $query = "UPDATE menus SET parent_id = ?, name = ?, icon = ?, url = ?, `order` = ?, is_active = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssiii", $parent_id, $name, $icon, $url, $order, $is_active, $id);
    $stmt->execute();

    echo "<script>
        alert('Data berhasil diupdate!');
        window.location.href = '?page=menus';
    </script>";
    exit();
}

