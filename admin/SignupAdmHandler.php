<?php
session_start();
require_once '../config/db.php'; // Database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password']; 

    // Check if an admin already exists
    $query = "SELECT * FROM admin";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Admin already exists, show alert and redirect
        echo "<script>alert('Admin already exists. Please log in.'); window.location.href='adminlogin.php';</script>";
        exit();
    } else {
        // Insert new admin
        $insert_query = "INSERT INTO admin (username, password) VALUES ('$admin_username', '$admin_password')";
        if (mysqli_query($conn, $insert_query)) {
            // Successful signup, show alert and redirect
            echo "<script>alert('Admin account created successfully.'); window.location.href='adminlogin.php';</script>";
            exit();
        } else {
            // Insertion failed, show alert and redirect
            echo "<script>alert('Signup failed. Please try again.'); window.location.href='admin_signup.php';</script>";
            exit();
        }
    }

    mysqli_close($conn); // Close the database connection
}
?>
