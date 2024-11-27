<?php
$servername = "146.190.85.108";
$username = "supplyease_user";
$password = "supplyease_password";
$dbname = "supplyease_new";

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
