<?php
//if the user is not logged in, redirect to the sign-in page
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: page-signin.php");
    exit();
}
$name = $_SESSION['name'];
$address = $_SESSION['address'];
$phone = $_SESSION['phone_number'];
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<!-- Populate the form fields with the retrieved customer information -->

   
        <div class="left-column">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="left-column">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
        </div>
        <div class="right-column">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>">
            <a href="#">Change</a>
        </div>
    
    </div>

    <div class="product-container">
        <h4>Products Ordered</h4>
        <!------------------------SAMPLE DISPLAY OF PRODUCTS ORDERED-------------------------->
        <table>
        <tr>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Amount</th>
            <th>Item Subtotal</th>
        </tr>
        <tr>
            <td><a href="#">Product 1</a></td>
            <td>$15</td>
            <td>4</td>
            <td>$60</td>
        </tr>
        <tr>
            <td><a href="#">Product 2</a></td>
            <td>$5</td>
            <td>2</td>
            <td>$10</td>
        </tr>
        <tr>
            <td><a href="#">Product 3</a></td>
            <td>$8</td>
            <td>3</td>
            <td>$24</td>
        </tr>
        <tr>
            <td><a href="#">Product 4</a></td>
            <td>$2</td>
            <td>5</td>
            <td>$10</td>
        </tr>
    </table>
    <hr>
      <p>Total:  <span class="price" style="color:black"><b>$30</b></span></p>
      <!----------------------------------------------------------------------------->
    </div>

    <div class="payment-container">
        <h4>Payment Method</h4>
        <button class="payment-button">Complete Payment</button>
    </div>
  
</body>

</html>
