<?php
// Start session at the beginning
session_start();

// Include the database connection file
require_once '../config/db.php';

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Retrieve form input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    global $conn;

    // Query to check if the username exists
    $sql = "SELECT * FROM user WHERE username='$username'";
    
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<script> alert('Username exists!'); </script>";
            $row = mysqli_fetch_assoc($result);

            // Verify the password (consider using password_hash in production)
            if ($password === $row['password']) {
                if ($email == $row['email']) {
                   
                    $_SESSION['user_id'] = $row['user_id']; // Store user_id
                    $_SESSION['username'] = $row['username']; // Store username
                    $_SESSION['email'] = $row['email']; // Store email (if needed)

                    echo "<script> alert('Login successful!'); </script>";
                    
                    // Redirect to the homepage after successful login
                    header("Location: ../homepage/index.php");
                    exit(); 
                    echo "<script> alert('Incorrect email'); </script>";
                }
            } else {
                echo "<script> alert('Incorrect password'); </script>";
            }
        } else {
            echo "<script>alert('Username does not exist. Enter a valid username.');</script>";
        }
    } else {
        echo "<script> alert('Error connecting to the database'); </script>";
    }
} else {
    echo "<script> alert('No login form has been submitted'); </script>";
}
?>
