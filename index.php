<?php 
include_once 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SupplyEase</title>
    <link rel="stylesheet" type="text/css" href="static/styles/style-home.css">
    <link rel="stylesheet" type="text/css" href="static/styles/style-splash.css">
    <link rel="stylesheet" type="text/css" href="static/styles/style-categories.css">
    <link rel="stylesheet" type="text/css" href="static/styles/style-products.css">
    <link rel="stylesheet" type="text/css" href="static/styles/style-sidecart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="static/scripts/script-splash.js"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <!-- header -->
    <div class="header-container">
        <div class="logo">
            <img src="static/images/SupplyEase-Logo.png" alt="">
            <h1>SupplyEase</h1>
        </div>

        <!-- <button type="submit"><img src="static/images/image-search.png" alt="Search">></button>
        <li><a href="#"><img src="static/images/image-home.png" alt="Home">Home</a></li>
        <li><a href="#"><img src="static/images/image-account.png" alt="About Us">About Us</a></li>
        <li><a href="#"><img src="static/images/image-account.png" alt="Message Us">Message Us</a></li>
        <li><a href="#"><img src="static/images/image-addToCart.png" alt="Shopping Cart">Shopping Cart</a></li>
        <li><a href="#"><img src="static/images/image-account.png" alt="Profile">Profile</a></li> -->

        <ul class="navbar">
            <!-- <div class="searchbar">
                <input type="text" placeholder="Search...">
                <button type="submit">></button>
            </div> -->
         
        <?php
                //if user is logged in display profile and logout
                if(isset($_SESSION['loggedin'])){
                    echo '
                    <span><a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home</a></span>
                    <li><a href="customer-dashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 
                    0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Profile</a></li>
                    <li><a id="open_cart_btn" href="#"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 
                    1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 
                    0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                          Shopping Cart</a></li>
                    <li><a href="page-signout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>                  
                    Logout</a></li>';
                }else{
                    echo '
                    <span><a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home</a></span>
                    <li><a href="page-signin.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 
                    0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    login</a>
                    </li>
                    ';
                }

            ?>
        </ul>
        <label class="small-icon" id="icon">=</label>
        </div>
        <!-- header -->

        <!-- categories -->
        <div class="categories-container">
        <h3>CATEGORIES</h3>

        <ul class="categories">
            <li class="button active" data-category="All Products">All Products</li>
            <?php

            // Fetch categories from the database
            $query = "SELECT * FROM categories";
            $result = mysqli_query($conn, $query);

            // Check if categories exist
            if (mysqli_num_rows($result) > 0) {
                // Loop through categories and generate list items
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="button" data-category="' . $row['category_id'] . '">' . $row['name'] . '</li>';
                }
            } else {
                echo '<li>No categories found</li>';
            }

            mysqli_close($conn);
            ?>
        </ul>

         <!-- products -->
    <div class="products" style="background-color:white;">
        <div class="products-container">
            <div class="product-header" style="margin-top: 40px;">
                <h3 style="color:black;">Product Lists</h3>
            </div>
            <div class="product-lists">

              
            </div>
        </div>
    </div>
    <!-- products -->

    </div>

    <!-- categories -->

    <!-- splash body -->
    <!-- <section class="splash">
        <div class="splash-container">
            <div class="images">
                <img src="static/images/slideshow/t1.jpg" alt="">
                <img src="static/images/slideshow/t2.jpg" alt="">
                <img src="static/images/slideshow/t3.jpg" alt="">
                <img src="static/images/slideshow/t4.jpg" alt="">
                <img src="static/images/slideshow/t5.jpg" alt="">
            </div>
        </div>
    </section> -->
    <!-- splash body -->


   

    <!-- <button id="open_cart_btn">
        <img src="static/images/image-addToCart.png" alt="" style="width: 30px;">
    </button> -->


    <div class="backdrop"></div>

    <!-- sidecart -->
    <div id="sidecart" class="sidecart">
        <div class="cart_content">

            <div class="cart_header">
                <img src="static/images/image-addToCart.png" alt="" style="width: 30px; " />
                <div class="header_title">
                    <h2>Your Cart</h2>
                    <span id="items_num"><?php
                     if(isset($_SESSION['cart_count']))
                     {
                    echo $_SESSION['cart_count'];
                     }else{
                         echo '0';
                     }
                    ?></span>
                </div>
                <span id="close_btn" class="close_btn">&times;</span>
            </div>

            <div class="cart_items">
                <div class="remove_item">
                     <span type="button" id="cartId">x</span>
                </div>
            </div>
            <div class="cart_actions"> 
                
                <div class="subtotal">
                    <p>SUBTOTAL:</p>
                    <p>₱<span id="subtotal_price"><?php 
                    if(isset($_SESSION['subtotal']))
                    {
                        echo number_format($_SESSION['subtotal'], 2);
                    }else{
                        echo '0.00';
                    }
                   
                    
                    ?></span></p>
                </div>
                <!-- <button>View Cart</button> -->
                <a href="page-checkout.html">
                    <button>Check Out</button>
                  </a>
            </div>
        </div>
    </div>
    <!-- sidecart -->


    <!-- javascript -->
    <script src="static/scripts/script-home.js"></script>
    <!-- <script src="static/scripts/script-splash.js"></script> -->
    <script src="static/scripts/script-sidecart.js"></script>
    <script>
    $(document).ready(function() {
        // Initially, display all products when the page loads
        displayProducts('All Products');
        displayCartItems();
        // Add click event listener to category buttons
        $('.categories .button').click(function() {
            // Remove active class from all buttons
            $('.categories .button').removeClass('active');
            // Add active class to the clicked button
            $(this).addClass('active');
            // Get the category ID from the data attribute
            var categoryId = $(this).data('category');
            // Call the displayProducts function with the selected category ID
            displayProducts(categoryId);
        });
    });

    function displayProducts(categoryId) {
        // Fetch products via AJAX based on the selected category
        $.ajax({
            type: 'POST',
            url: 'get_products.php', // Replace with the URL of your PHP script to fetch products
            data: { categoryId: categoryId },
            success: function(response) {
                // Display the fetched products in the product list container
                $('.product-lists').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    $('.products-container').on('click', '.product-card button', function() {
        var productId = $(this).data('product-id');
        // Add the selected product to the cart
        addToCart(productId);

        // Update the number of items in the cart
        // updateCartItems();


    });

    $('.cart_content').on('click', '.remove_item span', function() {
        var cartId = $(this).data('product-id');
        // Remove the selected product from the cart
        removeFromCart(cartId);
    });

    function removeFromCart(cartId) {
        // Remove product from the cart via AJAX based on the selected product ID
        $.ajax({
            type: 'POST',
            url: 'remove_from_cart.php',
            data: { cartId: cartId },
            success: function(response) {
                alert('Product removed to your cart!');
                window.setTimeout(function() { window.location.href = 'index.php'; }, 100);
                $('.cart_items').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function displayCartItems()
    {
        $.ajax({
            type: 'POST',
            url: 'get_cart_items.php', // Replace with the URL of your PHP script to fetch the number of items in the cart
            success: function(response) {
                // Update the number of items in the cart
                $('.cart_items').html(response);
                // $('#items_num').text(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function addToCart(productId) {
        console.log(productId);
        // Fetch product details via AJAX based on the selected product ID
        $.ajax({
            type: 'POST',
            url: 'add_to_cart.php', // Replace with the URL of your PHP script to add products to the cart
            data: { productId: productId },
            success: function(response) {
                if(response === 'false')
                {
                    alert('You must log in first before adding items to your cart');
                   window.setTimeout(function() { window.location.href = 'page-signin.php'; }, 100);
                }else{
                    alert('Product added to your cart!');
                    window.setTimeout(function() { window.location.href = 'index.php'; }, 100);
                    $('.cart_items').html(response);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>


</body>

</html>