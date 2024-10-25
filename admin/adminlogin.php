<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminlogin.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="login-container">
    <h2>Admin Login</h2>
      
            
        <form class="login-form" action="login_handler.php" method="POST">
            <input type="text" name="admin_username" placeholder="Admin Username" required>
            <input type="password" name="admin_password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="or-divider">
            <span>OR</span>
        </div>
        <div class="login-options">
            <a href="../users/login.html">Login as User</a>
            <a href="../guest/guest_page.php">Continue as Guest</a>
        </div>
        <div class="sign-up-link">
            <p>Don't have an account? <a href="admin_signup.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>
