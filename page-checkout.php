<?php
//if the user is not logged in, redirect to the sign-in page
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: page-signin.php");
    exit();
}
// Retrieve customer information from the session
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout Page</title>
    <link rel="Stylesheet" href="../static/styles/style-checkout.css">
</head>

<body>
    <div class="header-container">
        <div class="logo">
            <img src="static/images/SupplyEase-Logo.png" alt="">
            <h1>SupplyEase</h1>
        </div>
    </div>

    <div class="default-container">
        <h4>Delivery Details</h4>
        <p>Name: <?php echo $name; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Address: <?php echo $address; ?></p> 
    </div>

    <div class="product-container">
        <h4>Products Ordered</h4>
    </div>

    <div class="payment-container">
        <h4>Payment Method</h4>
        <button class="payment-button">Complete Payment</button>
    </div>
   
</body>

</html>
