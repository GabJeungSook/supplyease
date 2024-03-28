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
    <title>Products</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="static/styles/style-products.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="grid-container">


      <!--<header class="header">
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
        <div class="main-title" style="margin-top:-20px;">
          <p class="font-weight-bold" style="font-size:60px;">PRODUCTS</p>
        </div>
        <?php
        $query = "SELECT p.product_id, c.name AS category, p.name, p.description, p.price, p.available_quantity
        FROM products p
        INNER JOIN categories c ON p.category_id = c.category_id";
        $result = mysqli_query($conn, $query);
        ?>
         <button type="button" class="btn-add" data-toggle="modal" data-target="#addProductModal"><span>Add Product</span></button>
       <table id="categoriesTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th> <!--ADDED-->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['available_quantity']; ?></td>
                    <td></td>
                    <td>
            <button onclick="deleteCategory(<?php echo $row['product_id']; ?>)" class="btn btn-danger">Delete</button>
          </td>

                    <!-- Add more cells for other category attributes -->
                </tr>
            <?php } ?>
            </tbody>
        </table>

      </main>
      <!-- End Main -->
         <!-- Add Product Modal -->
         <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                  <div class="form-group">
                          <label for="category">Category:</label>
                          <select class="form-control" id="category" name="category" required>
                            <option selected>--SELECT--</option>
                              <!-- Populate options dynamically from PHP -->
                              <?php
                              // Fetch categories from the database
                              $query = "SELECT * FROM categories";
                              $result = mysqli_query($conn, $query);
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
                              }
                              ?>
                          </select>
                      </div>
                      <!--ADDED-->
                      <div class="form-group">
                        <label for="productImage">Add Image:</label>
                        <input type="file" class="form-control-file" id="productImage" name="productImage" accept="image/*" required>
                      </div>
                     
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Product Description:</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price:</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="productQuantity">Quantity:</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" required>
                    </div>
                    <!-- You can add more fields for additional product attributes if needed -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script> -->
    <!-- Custom JS -->
    <!-- <script src="../SupplyEase/static/scripts/script-admin.js"></script> -->
        <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#categoriesTable').DataTable();
        });
    </script>
    <script>
    $(document).ready(function() {
        // Submit form via AJAX
        $('#addProductForm').submit(function(event) {
           
            event.preventDefault(); // Prevent default form submission

            // Get form data
            var formData = $(this).serialize();
           
            // Submit form data via AJAX
            $.ajax({
                type: 'POST',
                url: 'add_product_process.php',
                data: formData,
                success: function(response) {
                  console.log(formData);
                    // Handle response (e.g., show success message, update category list)
                    // window.setTimeout(function() { window.location.href = 'page-categories.php'; }, 100);
                    // Close modal
                    $('#addProductModal').modal('hide');
                    // Reload or update category list
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
  </body>
</html>