<?php

// Get the product ID from the request
$productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;


include_once 'config.php';

  // Delete the product from the database
  $sql = "DELETE FROM products WHERE product_id = {$productId}";
  $result = $conn->query($sql);

  // Check if the deletion was successful
  if ($result) {
    echo 'Product deleted successfully.';
  } else {
    echo 'Error deleting product: ' . $conn->error;
  }

  // Close the database connection
  $conn->close();


?>