<?php
session_start();
include '../config/db.php'; // Include your database connection

if (isset($_SESSION['username'])) { // Assuming the username is stored in session
    $username = $_SESSION['username']; // Get the username from session

    // Sanitize username to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);

    // Delete the user from the database
    $query = "DELETE FROM user WHERE username='$username'";

    if (mysqli_query($conn, $query)) {
        // Successfully deleted
        session_destroy(); // Destroy session
        header("Location:../users/login.html"); // Redirect to login page
        exit();
    } else {
        // Handle error
        echo "<script>alert('Error deleting account: " . mysqli_error($conn) . "'); window.location.href='../users/index.php';</script>";
    }
} else {
    // Handle case where username is not set
    echo "<script>alert('No user is logged in.'); window.location.href='login.html';</script>";
}
?>
//handler sheri aayilla. delete cheyyan pettalla