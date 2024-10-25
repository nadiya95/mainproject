<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <link rel="stylesheet" href="../css/signup.css"> <!-- Linking the CSS file -->
</head>
<body>
    <div class="signup-container">
        <h2>Admin Sign Up</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <form action="SignupAdmHandler.php" method="POST">
            <input type="text" name="admin_username" placeholder="Admin Username" required>
            <input type="password" name="admin_password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <div>
            <p>Already have an account? <a href="adminlogin.php">Login</a></p>
        </div>
    </div>
</body>
</html>
