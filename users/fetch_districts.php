<?php

include '../config/db.php'; // Your database connection file

// Get the state_name from the URL and sanitize it
$state_name = mysqli_real_escape_string($conn, $_GET['state_name']);

// First Query: Get the state_id based on the state_name
$query1 = "SELECT state_id FROM states WHERE state_name = '$state_name'";
$result1 = mysqli_query($conn, $query1);

if ($result1 && mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $state_id = $row['state_id'];

    // Second Query: Get the districts based on the state_id
    $query2 = "SELECT district_id, district_name FROM districts WHERE state_id = $state_id";
    $result2 = mysqli_query($conn, $query2);

    if ($result2) {
        echo '<option value="">Select District</option>'; // Default option
        while ($row = mysqli_fetch_assoc($result2)) {
            echo '<option value="' . $row['district_name'] . '">' . $row['district_name'] . '</option>';
        }
    } else {
        echo 'Error fetching districts: ' . mysqli_error($conn);
    }
} else {
    echo 'Error fetching state ID or state not found: ' . mysqli_error($conn);
}
?>
