<?php
//get cart items
session_start();
include_once 'config.php';
// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the sign-in page
    echo 'false';
    // header("Location: page-signin.php");
    exit();
}
$userId = $_SESSION['user_id'];
$select_query = "SELECT carts.cart_id, carts.user_id, carts.quantity, products.name, products.image_path, products.price FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE carts.user_id = $userId";
$result = mysqli_query($conn, $select_query);
$cart_count = mysqli_num_rows($result);
$_SESSION['cart_count'] = $cart_count;
if (mysqli_num_rows($result) > 0) {
    // Loop through products and generate product cards
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="cart_item">';
        echo '<div class="remove_item">';
        echo '<span type="button" data-product-id="' . $row['cart_id'] . '">&times;</span>';
        echo '</div>';
        echo '<div class="item_img">';
        if($row["image_path"] === null)
        {
            echo '<img src="static/images/slideshow/t3.jpg" alt="Product Image">';
        }else{
            echo '<img src="'.$row["image_path"].'" alt="Product Image" />';
        }
        echo '</div>';
        echo '<div class="item_details">';
        echo '<p>'.$row['name'].'</p>';
        echo '<strong>'.number_format($row['price'] * $row['quantity'], 2).'</strong>';
        echo '<div class="qty">';
        echo ' <span>-</span>';
        echo ' <strong>'.$row['quantity'].'</strong>';
        echo '<span>+</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    //add subtotal of all items in the cart
    $select_query = "SELECT SUM(products.price * carts.quantity) as total FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE carts.user_id = $userId";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['subtotal'] = $result == null ? 0 : $row['total'];
} else {
    echo '<p style="font-size: 22px; margin-top: 10px; color: white;">-- No products found in this cart --</p>';
}

?>