<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the sign-in page
    echo 'false';
    // header("Location: page-signin.php");
    exit();
}


if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    include_once 'config.php';

    // Retrieve the user ID from the session
    $userId = $_SESSION['user_id'];
    //Check if the product is already in the cart
    $query = "SELECT * FROM carts WHERE user_id = $userId AND product_id = $productId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the product is already in the cart, update the quantity
        $row = mysqli_fetch_assoc($result);
        $newQuantity = $row['quantity'] + 1;
        $updateQuery = "UPDATE carts SET quantity = $newQuantity WHERE user_id = $userId AND product_id = $productId";
        mysqli_query($conn, $updateQuery);
    } else {
        // If the product is not in the cart, insert a new row
        $insertQuery = "INSERT INTO carts (user_id, product_id, quantity) VALUES ($userId, $productId, 1)";
        mysqli_query($conn, $insertQuery);
    }
    $select_query = "SELECT carts.user_id, carts.quantity, products.name, products.price FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE carts.user_id = $userId";
    $result = mysqli_query($conn, $select_query);
    $cart_count = mysqli_num_rows($result);

    $_SESSION['cart_count'] = $cart_count;
    if (mysqli_num_rows($result) > 0) {
        // Loop through products and generate product cards
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="cart_item>';
            echo '<div class="item_details">';
            echo '<p>'.$row['name'].'</p>';
            echo '<strong>₱550</strong>';
            echo '<div class="qty">';
            echo ' <span>-</span>';
            echo ' <strong>'.$row['quantity'].'</strong>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // No products found
        echo '<p style="font-size: 22px; margin-top: 10px; color: white;">-- No products found in this category --</p>';
    }
    // Close the database connection
    mysqli_close($conn);

    // Return a success message (or any other response as needed)
    echo "Product added to cart successfully";
} else {
    // Return an error message if the product ID is not provided or the user is not logged in
    echo "Error: Product ID not provided or user not logged in";
}


?>
