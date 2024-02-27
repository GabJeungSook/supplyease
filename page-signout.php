<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or any other appropriate page
header("Location: page-signin.php");
exit(); // Ensure script stops here to prevent further execution
?>