<?php
session_start();
include_once 'config.php';
// Get the product ID from the request
$user_id = $_SESSION['user_id'];
$address = $_POST['address'];

    $query = "SELECT * FROM user_profile WHERE user_id = {$user_id}";

    $res = $conn->query($query);
    if ($res->num_rows > 0) {
        echo "updated";
        $sql = "UPDATE user_profile SET address='$address' WHERE user_id='$user_id'";
        $result = $conn->query($sql);
      
        if ($result) {
          echo 'Address successfully added.';
          $_SESSION['address'] = $address;
        } else {
          echo 'Error adding of address: ' . $conn->error;
        }
    }else{
        echo "added";
        $sql = "INSERT INTO user_profile (`user_id`, `phone_number`, `gender`, `address`, `profile_picture`)
        VALUES ($user_id, NULL, NULL, '$address', NULL)";
        $result = $conn->query($sql);

        if ($result) {
            echo 'Address successfully updated.';
            $_SESSION['address'] = $address;
          } else {
            echo 'Error adding of address: ' . $conn->error;
          }
    }
  
  

  // Close the database connection
  $conn->close();


?>