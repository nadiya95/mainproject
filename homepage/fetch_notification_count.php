<?php
session_start();
include '../config/db.php';

$logged_in_username = $_SESSION['username'] ?? null;

// Fetch unread notifications count
$sql = "SELECT COUNT(*) as count FROM interests WHERE receiver = '$logged_in_username' AND status = 'pending' AND is_read = 0";
$result = mysqli_query($conn, $sql);
$count = mysqli_fetch_assoc($result)['count'];

echo $count;
?>
