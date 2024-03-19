<?php
include_once 'config.php';
// add_category_process.php

// Assuming you have a database connection established
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $categoryName = $_POST['categoryName'];

    // Insert category into database
    $query = "INSERT INTO categories (name) VALUES ('$categoryName')";
    
    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Category added successfully
        echo "<script>showAlert('Successfully added!', 'success');</script>";
    } else {
        // Error handling if insertion fails
        echo "Error: " . mysqli_error($conn);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['deleteCategory'])) {
    // Validate input
    $categoryId = $_GET['deleteCategory'];

    // Delete category from database
    $deleteQuery = "DELETE FROM categories WHERE category_id = $categoryId";
    
    // Execute the delete query
    if (mysqli_query($conn, $deleteQuery)) {
        // Category deleted successfully
        echo "<script>showAlert('Category deleted!', 'success');</script>";
    } else {
        // Error handling if deletion fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>