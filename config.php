<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "supplyease_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("SET FOREIGN_KEY_CHECKS = 0;");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//testr
// echo "Connected successfully";
?>