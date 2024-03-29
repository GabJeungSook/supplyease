<?php
//if the user is not logged in, redirect to the sign-in page
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: page-signin.php");
    exit();
}
 $id = $_SESSION['user_id'];
 $name = $_SESSION['name'];
 $address = $_SESSION['address'];
 include_once 'config.php';
 
//$phone = $_SESSION['phone_number'];



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="Stylesheet" href="./static/styles/style-checkout.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <!-- <div class="header-container">
        <div class="logo">
            <img src="static/images/SupplyEase-Logo.png" alt="">
            <h1>SupplyEase</h1>
        </div>
    </div> -->

    <div class="default-container">
        <h4>Delivery Details</h4>
<!-- Populate the form fields with the retrieved customer information -->

   
        <div class="left-column">
            <label for="name">Name : </label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        </div>
      <!--  <div class="left-column">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
        </div> -->
        <div class="right-column" style="padding-top: 23px">
            <label for="address">Address : </label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>">
            <?php
                if($_SESSION['address'] === null)
                {
                echo '<button onclick="addAddress('.$id.')">Add</button>';
                }else{
                    echo '<button onclick="addAddress('.$id.')">Change</button>';
                }
            ?>
        </div>
    
    </div>

    <div class="product-container">
        <h4>Products Ordered</h4>
        <!------------------------SAMPLE DISPLAY OF PRODUCTS ORDERED-------------------------->
        <table>
        <tr>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Item Subtotal</th>
        </tr>
        <tr>
        <?php 
             $total = 0;
             $query = "SELECT a.cart_id, a.user_id, b.name, b.price, a.quantity FROM carts a 
             LEFT JOIN products b ON a.product_id = b.product_id WHERE a.user_id = '$id'";
             $result = mysqli_query($conn, $query);
             if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<td><a href="#">'.$row['name'].'</a></td>';
                    echo '<td>₱ '.$row['price'].'</td>';
                    echo '<td>'.$row['quantity'].'</td>';
                    echo '<td>₱ '.($row['price'] * $row['quantity']).'</td>';
                    $total += ($row['price'] * $row['quantity']);
                }
            
            }
        ?>
        </tr>
    </table>
    <hr>
      <p>Total:  <span class="price" style="color:black"><b><?php echo '₱ '. number_format($total, 2)?></b></span></p>
      <!----------------------------------------------------------------------------->
    </div>

    <div class="payment-container">
    <h4>Payment</h4>
    <small>All payment are processed through COD (Cash on delivery) only.</small>
    <button class="payment-button">Complete Checkout</button>
</div>
  
</body>

<script>
    function addAddress(id)
    {
        if (confirm("Are you sure you want to add this address?")) {
    
            var address = document.getElementById('address');
            // console.log(address.value);
            var data = {
                user_id: id,
                address: address.value
            }
            $.ajax({
              url: 'add_address.php',
              type: 'POST',
              data: data,
              success: function(response) {
                // If the request was successful, hide the button
                console.log(response);
                alert('Address successfully added!');
                window.location.reload();
              },
              error: function(xhr, status, error) {
                // If there was an error, show an error message
                alert('Error deleting product: ' + xhr.responseText);
              }
            });
          }   
    }
</script>

</html>
