<?php
session_start();
require_once '../config/db.php'; // Database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password']; // Assuming passwords are stored in plain text (not recommended)

    // Query to check if admin exists
    $query = "SELECT * FROM admin WHERE username = '$admin_username' AND password = '$admin_password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        // Successful login, start the admin session
        $admin = mysqli_fetch_assoc($result);
        // Store the admin id and username in the session
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        // Show success message and redirect
        echo "<script>
            alert('Login successful!');
            window.location.href = 'admin_dashboard.php'; // Redirect to admin dashboard
        </script>";
        exit();
    } else {
        // Invalid username or password
        echo "<script>alert('Invalid username or password.');   window.location.href = 'adminlogin.php'; // Redirect to admin dashboard</script>";
        
    }

    mysqli_close($conn); // Close the database connection
}
?>
