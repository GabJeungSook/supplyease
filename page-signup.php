<?php 
include_once 'config.php'; 
session_start();

// Check if user is already logged in (i.e., session variable is set)
if (isset($_SESSION['loggedin'])) {
    // Redirect to dashboard
    header("Location: page-adminpanel.php");
    exit(); // Ensure script stops here to prevent further execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SupplyEase Sign Up</title>
    <link rel="stylesheet" type="text/css" href="static/styles/style-signup.css">
    <script>
        // JavaScript function to display alerts
        function showAlert(message, type) {
            alert(message);
        }
    </script>
</head>

<body>
    <div class="header-container">
        <div class="logo">
            <a href="page-home.html">
                <img src="static/images/SupplyEase-Logo.png" alt="">
            </a>
            <!-- <h1><a href="page-home.html">SupplyEase</a></h1> -->
            <h1>SupplyEase</h1>
        </div>
    </div>

    <div class="side">
        <p>Supplying Simplicity, One Click at a Time.</p>
        <img src="static/images/SupplyEase-Logo.png" alt="">
    </div>

    <div class="signup-container">
        <div class="signup-form">
            <?php
            // Define variables for error and success messages
            $error = $success = "";

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];

                // Check if passwords match
                $confirm_password = $_POST['confirm_password'];
                if ($password !== $confirm_password) {
                    echo "<script>showAlert('Passwords do not match.', 'error');</script>";
                } else {
                    // Check if username already exists
                    $check_username = "SELECT * FROM users WHERE username='$username'";
                    $result_username = $conn->query($check_username);
                    // Check if email already exists
                    $check_email = "SELECT * FROM users WHERE email='$email'";
                    $result_email = $conn->query($check_email);
                    if ($result_username->num_rows > 0) {
                        echo "<script>showAlert('Username already exists.', 'error');</script>";
                    }
                    elseif($result_email->num_rows > 0)
                    {
                        echo "<script>showAlert('Email already exists.', 'error');</script>";
                    }
                     else {
                        // Perform SQL insert query
                        $sql = "INSERT INTO users (role_id, name, username, email, password) VALUES ('2', '$name', '$username', '$email', '$password')";
                        if ($conn->query($sql) === TRUE) {
                            // Success message
                            echo "<script>showAlert('Account created successfully! You can now sign in.', 'success');</script>";
                            // Redirect to login page after a delay
                            echo "<script>window.setTimeout(function() { window.location.href = 'page-signin.php'; }, 100);</script>";
                        } else {
                            echo "<script>showAlert('Error: " . $sql . "<br>" . $conn->error . "', 'error');</script>";
                        }
                    }
                }
            }
            ?>

            <h2>Sign Up</h2>
            <form action="page-signup.php" method="POST">
                <label>
                    <span>NAME</span>
                    <input type="text" id="name" name="name" required>
                </label>
                <label>
                    <span>USERNAME</span>
                    <input type="text" id="username" name="username" required>
                </label>
                <label>
                    <span>EMAIL</span>
                    <input type="email" id="email" name="email" required>
                </label>
                <label>
                    <span>PASSWORD</span>
                    <input type="password" id="password" name="password" required>
                </label>
                <label>
                    <span>CONFIRM PASSWORD</span>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </label>
                <?php 
                    // Display error message if exists
                    if ($error != "") {
                        echo "<div class='error'>$error</div>";
                    }
                    // Display success message if exists
                    if ($success != "") {
                        echo "<div class='alert alert-success' role='alert'>
                        This is a success alert—check it out!
                      </div>";
                    }
                ?>
                <button class="btn-Signup" type="submit">Sign Up</button>
                <p class="signin-account">Already have an account? <a href="page-signin.php">Sign in now.</a></p>
        </div>
        </form>
    </div>
</body>

</html>
