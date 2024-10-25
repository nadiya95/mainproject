<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $notification_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Update the notification to mark it as read
    $update_sql = "UPDATE interests SET is_read = 1 WHERE id = '$notification_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
