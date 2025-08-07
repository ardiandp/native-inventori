<?php
 $conn = new mysqli("localhost", "dev", "terserah", "winkur");
if (isset($_POST['edit_menu'])) {
    // Update menu
    $id = intval($_POST['id']);
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
    $name = $conn->real_escape_string($_POST['name']);
    $icon = $conn->real_escape_string($_POST['icon'] ?? '');
    $url = $conn->real_escape_string($_POST['url'] ?? '');
    $order = intval($_POST['order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    $query = "UPDATE menus SET 
             parent_id = ?, name = ?, icon = ?, url = ?, `order` = ?, is_active = ? 
             WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssiii", $parent_id, $name, $icon, $url, $order, $is_active, $id);
    $stmt->execute();
    
    header("Location: menus.php");
    exit();
}


?>

<form method="POST" class="mb-4">
    <?php if (isset($_GET['edit'])): 
        $edit_id = intval($_GET['edit']);
        $edit_data = $conn->query("SELECT * FROM menus WHERE id = $edit_id")->fetch_assoc();
    ?>
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
        <div class="form-row">
            <div class="col-md-3">
                <select name="parent_id" class="form-control">
                    <option value="">-- Menu Utama --</option>
                    <?php while ($menu = $all_menus->fetch_assoc()): 
                        if ($menu['id'] == $edit_id) continue; // Skip diri sendiri
                    ?>
                    <option value="<?= $menu['id'] ?>" <?= $menu['id'] == $edit_data['parent_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($menu['name']) ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="name" class="form-control" placeholder="Nama Menu" 
                       value="<?= htmlspecialchars($edit_data['name']) ?>" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="icon" class="form-control" placeholder="Icon Font Awesome" 
                       value="<?= htmlspecialchars($edit_data['icon']) ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="url" class="form-control" placeholder="URL" 
                       value="<?= htmlspecialchars($edit_data['url']) ?>">
            </div>
            <div class="col-md-1">
                <input type="number" name="order" class="form-control" placeholder="Urutan" 
                       value="<?= $edit_data['order'] ?>">
            </div>
            <div class="col-md-1">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" 
                           <?= $edit_data['is_active'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" name="edit_menu" class="btn btn-warning btn-block">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="menus.php" class="btn btn-secondary btn-block mt-1">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>
    <?php endif; ?>
</form>

