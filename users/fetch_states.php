<?php
// fetch_states.php
include '../config/db.php'; // Your database connection file
global $conn;
$query = "SELECT state_id, state_name FROM states";
$result = mysqli_query($conn, $query);

echo '<option value="">Select State</option>'; // Default option
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['state_name'] . '">' . $row['state_name'] . '</option>';
}
?>