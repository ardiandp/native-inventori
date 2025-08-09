<?php
require 'config/database.php';

$id = intval($_GET['id']);
$conn->query("DELETE FROM menus WHERE id = $id");
header("Location: ?page=menus");
exit();
