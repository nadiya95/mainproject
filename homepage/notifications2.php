<?php
session_start();
include '../config/db.php';

$logged_in_username = $_SESSION['username'] ?? null;



// Fetch notifications for the logged-in user
$sql = "SELECT * FROM interests WHERE receiver = '$logged_in_username' AND status = 'pending'";
echo "Executing query: " . $sql; // Debug line

$result = mysqli_query($conn, $sql);
echo "Number of rows returned: " . mysqli_num_rows($result) . "<br>"; // Debug line

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Vows and Values</title>
    <style>
        /* Adjust the styles to match your color theme */
        body {
            background-color: #1b1b1b; /* Main background color */
            color: #ffffff; /* Text color */
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        #notifications {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(51, 51, 51, 0.9); /* Slightly transparent dark background */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(192, 97, 105, 0.8); /* Neon glow effect */
        }
        .notification {
            display: block;
            padding: 10px;
            border-bottom: 1px solid #c06169;
            color: #ffffff;
            text-decoration: none;
        } 
    

        .notification:hover {
            background-color: rgba(192, 97, 105, 0.2); /* Hover effect */
        }
        .timestamp {
            font-size: 0.8em;
            color: #cccccc;
        }
        .no-notifications {
            text-align: center;
            color: #cccccc;
        }
    </style>
</head>
<body>
<?php include '../homepage/header.php'; ?>

 <div id="notifications">
    <h3>Notifications</h3>
    <div id="notification-list">
    <?php
if (mysqli_num_rows($result) > 0) {
    echo "Fetching notifications..."; // Debug line
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Notification found.<br>";
        print_r($row); // Display the contents of the current row
        echo "<br>"; // Line break for better readability
    }
    
} else {
    echo "<div class='no-notifications'>No notifications yet.</div>";
}



?>

    </div>
</div>

<script>
   

// Function to mark a notification as read
function markAsRead(notificationId) {
    console.log('Marking notification as read with ID:', notificationId); // Log the notification ID being marked

    fetch('../homepage/mark_as_read.php?id=' + notificationId, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Notification successfully marked as read');
                // Optionally update the notification count here
            } else {
                console.error('Failed to mark notification as read:', data.message);
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
}

// Function to fetch and update the notification count
function updateNotificationCount() {
    console.log('Fetching notification count...'); // Log when fetching starts

    fetch('../homepage/fetch_notification_count.php')
        .then(response => {
            console.log('Response received from fetch_notification_count.php'); // Log when response is received
            return response.text();
        })
        .then(data => {
            console.log('Notification count received:', data); // Log the count received
            const notificationCountElement = document.getElementById('notification-count');
            notificationCountElement.textContent = data > 0 ? data : ''; // Update the notification count bubble
        })
        .catch(error => console.error('Error fetching notification count:', error));
}

// Fetch notification count every 2 seconds
setInterval(() => {
    console.log('Triggering periodic update for notification count'); // Log every 2 seconds when the update is triggered
    updateNotificationCount();
}, 2000);

// Initial fetch when the page loads
document.addEventListener('DOMContentLoaded', () => {
    console.log('Page loaded, fetching initial notification count'); // Log when the page loads
    updateNotificationCount();
});


</script>

<?php include '../homepage/footer.php'; ?>
</body>
</html>
