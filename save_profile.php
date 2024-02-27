<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in and retrieve the user ID from the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Retrieve the profile data from the AJAX request
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Perform necessary validation and sanitization on the data

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "supplyease_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to insert/update the profile data
    $sql = "INSERT INTO user_profile (user_id, phone_number, gender, address) VALUES ('$user_id', '$phone', '$gender', '$address')
            ON DUPLICATE KEY UPDATE phone_number = '$phone', gender = '$gender', address = '$address'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User is not logged in"; // Handle the case where the user is not logged in
}
?>
