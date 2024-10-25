<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Content-Type: application/json'); // Set the content type to JSON
    echo json_encode(['newRequests' => []]); // Return an empty array for new requests
    exit; // Exit if not logged in
}

$username = $_SESSION['username']; // Get the logged-in user's username

// Database connection
include '../config/db.php';

// Query to fetch new 'pending' requests for the logged-in user
$sql = "
    SELECT id, sender, receiver, created_at
    FROM interests
    WHERE receiver = '$username' AND status = 'pending'
    ORDER BY created_at DESC
";

$result = $conn->query($sql);

// Prepare an array to hold new requests
$newRequests = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each request to the array
        $newRequests[] = [
            'id' => $row['id'],
            'sender' => $row['sender'],
            'created_at' => date('Y-m-d H:i:s', strtotime($row['created_at'])),
        ];
    }
}

// Set the content type to JSON
header('Content-Type: application/json');

// Return the new requests as JSON
echo json_encode(['newRequests' => $newRequests]);

$conn->close();
?>
