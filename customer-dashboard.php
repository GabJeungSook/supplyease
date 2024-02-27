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
  $query = "SELECT * FROM users WHERE user_id = $userId";
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
            <img src="profile-picture.jpg" alt="">
            <p><?php echo $row['name']?></p>
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
        <label for="name">Name</label>
        <input type="text" id="name" value="<?php echo $row['name']; ?>">
        <label for="username">Username</label>
        <input type="text" id="username" value="<?php echo $row['username']; ?>">
        <label for="password">Password</label>
        <input type="password" id="password" value="<?php echo $row['password']; ?>">
        <label for="email">Email</label>
        <input type="email" id="email" value="<?php echo $row['email']; ?>">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" value="">
        <label for="gender">Gender</label>
        <select id="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
</select>
<label for="address">Address</label>
<textarea id="address"></textarea>

        <button onclick="saveProfile()">Save</button>
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
        profileCard.style.display = profileCard.style.display === "none" ? "block" : "none";
      }
      function togglePurchaseCard() {
      const purchaseCard = document.getElementById("purchase-card");
      purchaseCard.style.display = purchaseCard.style.display === "none" ? "block" : "none";
    }

    function toggleLogout(){
      window.location.href = "page-signout.php";
    }
    function toggleHome(){
      window.location.href = "index.php";
    }
 //-------------------To Save Profile----------------------//
    function saveProfile() {
         // Get the values from the input fields
         var phone = document.getElementById("phone").value;
        var gender = document.getElementById("gender").value;
        var address = document.getElementById("address").value;

        // Make an AJAX request to save the profile data
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "save_profile.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                console.log(xhr.responseText);
                  // Display an alert message
        alert("Information saved successfully!");
            }
        };
        xhr.send("phone=" + encodeURIComponent(phone) + "&gender=" + encodeURIComponent(gender) + "&address=" + encodeURIComponent(address));
    }

    </script>
  </body>
</html>