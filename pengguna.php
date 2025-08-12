<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT users.id, users.username, users.password, users.email, users.full_name, users.role_id, users.divisi_id, users.is_active, users.created_at, users.updated_at, divisi.nama_divisi 
        FROM users 
        LEFT JOIN divisi ON users.divisi_id = divisi.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["username"]. " - Email: " . $row["email"]. " - Division: " . $row["nama_divisi"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

