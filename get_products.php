<?php
// Include database connection
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"]) {
    // Check if the selected category is "All Products"
    if ($_POST['categoryId'] == "All Products") {
        // Fetch all products
        $query = "SELECT * FROM products";
    } else {
        // Fetch products based on the selected category
        $category = $_POST['categoryId'];
        $query = "SELECT * FROM products WHERE category_id = '$category'";
    }

    $result = mysqli_query($conn, $query);

    // Check if products exist
    if (mysqli_num_rows($result) > 0) {
        // Loop through products and generate product cards
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product-card">';
            echo '<img src="static/images/SupplyEase-Logo.png" alt="" />';
            echo '<h4 style="font-size: 14px;">' . $row['name'] . '</h4>';
            echo '<p class="description-trigger" style="color:black;" onclick="toggleDescription(this)">More Details</p>';
            echo '<div class="description-popup" style="display: none; color: black; font-weight: bold; text-align:center;">';
            echo '<p>' . $row['description'] . '</p>';
       
            echo '</div>';
            
            echo '<div>';
            echo '<span>₱' . $row['price'] . '</span>';
            echo '<button class="add-to-cart-btn" data-product-id="' . $row['product_id'] . '">Add to Cart</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // No products found
        echo '<p style="font-size: 22px; margin-top: 40px; color: #0d0c0c;">-- No products found in this category --</p>';
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Invalid request
    echo "Invalid request";
}
?>
