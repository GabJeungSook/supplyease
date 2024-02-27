<?php
// Ensure that the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once 'config.php';

    // Retrieve form data
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $categoryId = $_POST['category'];

    // Insert product into database
    $query = "INSERT INTO products (name, description, price, available_quantity, category_id) VALUES ('$productName', '$productDescription', '$productPrice', '$productQuantity', '$categoryId')";
    
    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Product added successfully
        echo "Product added successfully!";
    } else {
        // Error handling if insertion fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If the request method is not POST, redirect or handle the situation accordingly
    echo "Invalid request method.";
}
?>