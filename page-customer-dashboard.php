<?php
//if the user is not logged in, redirect to the sign-in page
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: page-signin.php");
    exit();
}

           //query the user name from the database
  
  include_once 'config.php';
  $userId = $_SESSION['user_id'];
  $query = "SELECT users.*, user_profile.* FROM users 
            LEFT JOIN user_profile ON users.user_id = user_profile.user_id 
            WHERE users.user_id = $userId";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Customer Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./static/styles/customer-dash.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined">search</span>
        </div>
      
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
        <div class="profile-info">
  <img id="profile_picture" src="profile-picture.jpg" alt="">
  <p><?php echo $row['name']?></p>
  <input type="file" id="profilePictureInput" accept="image/*" onchange="updateProfilePicture(event)">
  </div>
    

          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-nav">
        <li class="sidebar-nav-link">
              <span id="home" class="clickable" onclick="toggleHome()">Home</span>
          </li>
          <li class="sidebar-nav-link">
              <span id="account" class="clickable" onclick="toggleProfileCard()">My Account</span>
          </li>
          <li class="sidebar-nav-link" id="purchase">
            <span class="clickable" onclick="togglePurchaseCard()">My Purchase</span>
          </li>
          <li class="sidebar-nav-link" id="contact">
      <span>Contact Seller</span>
    </li>
            <li class="sidebar-nav-link" id="logout">
              <span class="clickable" onclick="toggleLogout()">Logout</span>
            </li>
      </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <h2> Welcome, <?php echo $row['name']?></h2>

        <div class="card" id="profile-card">
        <h2>My Profile</h2>
        <form id="saveProfileForm">
        <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
        <label for="username">Username</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $row['username']; ?>">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $row['phone_number']; ?>">
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
        <option value="male" <?php echo $row['gender'] == "male" ? "selected" : ""; ?>>Male</option>
        <option value="female" <?php echo $row['gender'] == "female" ? "selected" : ""; ?>>Female</option>
        <option value="other" <?php echo $row['gender'] == "other" ? "selected" : ""; ?>>Other</option>
        </select>
        <label for="address">Address</label>
        <textarea id="address" name="address"><?php echo $row['address'];?></textarea>
        <button type="submit">Save</button>
        </div>
        </form>
        </div>

        <div class="card" id="purchase-card">
          <h2>My purchase</h2>
          <table>
            <thead>
              <tr>
                <th>To Receive</th>
                <th>To Ship</th>
                <th>Complete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Item 1</td>
                <td>Item 1</td>
                <td>Item 1</td>
              </tr>
              <!-- Additional rows can be added here -->
            </tbody>
          </table>
        </div>
      </main>
      <!-- End Main -->

    </div>

<script>// SIDEBAR TOGGLE

  let sidebarOpen = false;
  const sidebar = document.getElementById('sidebar');
  
  function openSidebar() {
    if (!sidebarOpen) {
      sidebar.classList.add('sidebar-responsive');
      sidebarOpen = true;
    }
  }
  
  function closeSidebar() {
    if (sidebarOpen) {
      sidebar.classList.remove('sidebar-responsive');
      sidebarOpen = false;
    }
  }
  
  function toggleProfileCard() {
  const profileCard = document.getElementById("profile-card");
  const purchaseCard = document.getElementById("purchase-card");

  // Toggle the visibility of the profile card
  profileCard.style.display = profileCard.style.display === "none" ? "block" : "none";

  // Hide the purchase card when the profile card is open
  if (profileCard.style.display === "block") {
    purchaseCard.style.display = "none";
  }
}
//contact seller
    document.getElementById("contact").addEventListener("click", function() {
      window.open("page-contactseller.html");
    });

    function toggleLogout(){
      window.location.href = "page-signout.php";
    }
    function toggleHome(){
      window.location.href = "index.php";
    }
 //-------------------To Save Profile----------------------//
      $('#saveProfileForm').submit(function(event) {
           
           event.preventDefault(); // Prevent default form submission

           // Get form data
           var formData = $(this).serialize();
          
           // Submit form data via AJAX
           $.ajax({
               type: 'POST',
               url: 'save_profile.php',
               data: formData,
               success: function(response) {
                 console.log(formData);
                   // Handle response (e.g., show success message, update category list)
                   // window.setTimeout(function() { window.location.href = 'page-categories.php'; }, 100);
                   // Close modal
                  //  $('#addProductModal').modal('hide');
                  alert('Profile updated successfully');
                  window.location.reload();
               },
               error: function(xhr, status, error) {
                   // Handle errors
                   console.error(xhr.responseText);
               }
           });
       });
// add profile picture
function updateProfilePicture(event) {
    var profilePicture = document.getElementById("profile_picture");
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
      profilePicture.src = e.target.result;
    };

    reader.readAsDataURL(file);
  }

    </script>
  </body>
</html>