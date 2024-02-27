<?php
//remove item from cart
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
$cartId = $_POST['cartId'];
$delete_query = "DELETE FROM carts WHERE cart_id = $cartId";
$result = mysqli_query($conn, $delete_query);
if ($result) {
   //reset the session total
    $select_query = "SELECT SUM(products.price * carts.quantity) as total FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE carts.user_id = $userId";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['subtotal'] = $result == null ? 0 : $row['total'];

    $select_query1 = "SELECT carts.cart_id, carts.user_id, carts.quantity, products.name, products.price FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE carts.user_id = $userId";
    $result1 = mysqli_query($conn, $select_query1);
    $cart_count = mysqli_num_rows($result1);
    $_SESSION['cart_count'] = $cart_count;
} else {
    echo 'false';
}
?>