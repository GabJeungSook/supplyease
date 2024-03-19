<?php 
include_once 'config.php';
session_start();

// Check if user is already logged in (i.e., session variable is set)
if (!isset($_SESSION['loggedin'])) {
    // Redirect to dashboard
    header("Location: page-signin.php");
    exit(); // Ensure script stops here to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="static/styles/style-adminpanel.css">
  </head>
  <body>
    <div class="grid-container">

     <!-- <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          
        </div>
        <div class="header-right">
         
        </div>
      </header> -->
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined"></span>SupplyEase
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="page-adminpanel.php">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="page-categories.php">
              <span class="material-icons-outlined">category</span> Categories
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="page-products.php">
              <span class="material-icons-outlined">inventory_2</span> Products
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#">
              <span class="material-icons-outlined">add_shopping_cart</span> Purchase Orders
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#">
              <span class="material-icons-outlined">settings</span> Settings
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="page-signout.php">
              <span class="material-icons-outlined">logout</span> Logout
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title" style="margin-top:-60px;">
          <p class="font-weight-bold" style=" font-size: 60px;">DASHBOARD</p>
        </div>

        <div class="main-cards">

          <div class="card" onclick="window.location.href='page-products.php';" style="cursor: pointer;">
            <div class="card-inner">
              <p class="text-primary">PRODUCTS</p>
              <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary"> <?php
                // Include the database configuration file
                  include 'config.php';

                  // Execute a query to get the total count of products
                  $query = "SELECT COUNT(*) AS total_products FROM products";
                  $result = mysqli_query($conn, $query);
                  $row = mysqli_fetch_assoc($result);
                  echo $row['total_products'];
                  ?>
              </span>
          </div>

         
          <div class="card" onclick="window.location.href='page-categories.php';" style="cursor: pointer;">
  <div class="card-inner">
    <p class="text-primary">CATEGORIES</p>
    <span class="material-icons-outlined text-green">shopping_cart</span>
  </div>
  <span class="text-primary">
    <?php
    // Execute a query to get the total count of categories
    $query = "SELECT COUNT(*) AS total_categories FROM categories";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['total_categories'];
    ?>
  </span>
</div>

<div class="card">
            <div class="card-inner">
              <p class="text-primary">PURCHASE ORDERS</p>
              <span class="material-icons-outlined text-orange">add_shopping_cart</span>
            </div>
            <span class="text-primary">83</span>
          </div>

        </div>

        <div class="charts">

          <div class="charts-card">
            <p class="chart-title">Top 5 Products</p>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <p class="chart-title">Purchase Orders</p>
            <div id="area-chart"></div>
          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../SupplyEase/static/scripts/script-admin.js"></script>
  </body>
</html>