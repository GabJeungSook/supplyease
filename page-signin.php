<?php 
include_once 'config.php';
session_start();

// Check if user is already logged in (i.e., session variable is set)
if (isset($_SESSION['loggedin'])) {
    // Redirect to dashboard
    header("Location: customer-dashboard.html");
    exit(); // Ensure script stops here to prevent further execution
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SupplyEase Sign In</title>
    <link rel="stylesheet" type="text/css" href="static/styles/style-signin.css">
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
            <a href="index.php">
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

    <div class="signin-container">
        <div class="signin-form">
            <h2>SIGN IN</h2>
            <?php
                // Check if form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve form data
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Perform SQL select query to check credentials
                    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                    $result = $conn->query($sql);

                    // Check if result contains any rows
                    if ($result->num_rows > 0) {
                        $_SESSION['loggedin'] = true;
                     
                        // User is authenticated, redirect to dashboard or another page
                        echo "<script>showAlert('Successfully logged in!', 'success');</script>";
                        // Redirect to login page after a delay
                        
                        $row = $result->fetch_assoc();
                        $_SESSION['user_id'] = $row['user_id'];
                        if($row['role_id'] === '1')
                        {
                            echo "<script>window.setTimeout(function() { window.location.href = 'page-adminpanel.php'; }, 100);</script>";
                        }else{
                            echo "<script>window.setTimeout(function() { window.location.href = 'index.php'; }, 100);</script>";
                        }
                      
                        exit();
                    } else {
                        // Authentication failed, display error message
                        echo "<script>showAlert('Invalid username or password.', 'error');</script>";
                    }
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label>
                    <span>USERNAME</span>
                    <input type="text" name="username" required>
                </label>
                <label>
                    <span>PASSWORD</span>
                    <input type="password" name="password" required>
                </label>

                <p class="forgot-password">Forgot password?</p>
                <button class="btn-Signin" type="submit">Sign In</button>
                <p class="create-account">Don't have an account? <a href="page-signup.php">Create one now.</a></p>
            </form>
        </div>
    </div>
</body>

</html>
