<?php
/*
$servername = "153.92.15.58";
$username = "u284292842_winkur";
$password = "Database-2025";
$dbname = "u284292842_winkur";
*/
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "wininventori";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>

