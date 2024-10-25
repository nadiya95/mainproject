<?php
session_start();
include '../config/db.php';

// Ensure the session variable is set
$logged_in_username = $_SESSION['username'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Vows and Values</title>
    <link rel="stylesheet" href="../css/match2.css"> <!-- Link to your CSS file -->
    <style>
        body {
            background-color: #1b1b1b; /* Main background color */
            color: #ffffff; /* Text color */
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        #notifications {
            width: 50%; /* Increased width for the notification container */
            margin: 20px auto;
            background-color: rgba(51, 51, 51, 0.9); /* Slightly transparent dark background */
            padding: 20px; /* Increased padding for more space */
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(192, 97, 105, 0.8); /* Neon glow effect */
        }
        h3 {
            margin-bottom: 10px;
        }
        .notification {
            background-color: #c06169; /* Notification background color */
            color: #fff; /* Text color for notification */
            padding: 15px; /* Increased padding for notifications */
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(192, 97, 105, 0.8); /* Neon glow effect */
            text-decoration: none; /* Remove underline from anchor */
            display: block; /* Make the entire notification clickable */
        }
        .notification:hover {
            background-color: #b0535b; /* Darker background on hover */
        }
        .no-notifications {
            color: #777; /* Color for 'No notifications yet' message */
            text-align: center; /* Center the message */
            padding: 10px;
            font-weight: bold; /* Make it bold */
        }
        .timestamp {
            font-size: 0.8em;
            color: #ccc; /* Lighter color for timestamp */
        }

        /* Pop-up notification styles */
        #popup-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #c06169; /* Notification background color */
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(192, 97, 105, 0.8);
            display: none; /* Hidden by default */
            z-index: 1000; /* Make sure it's on top */
        }
    </style>
</head>
<body>

<?php include '../homepage/header.php'; ?>

<div id="notifications">
    <h3>Notifications</h3>
    <div id="notification-list">
        <?php
        if ($logged_in_username) {
            // Initial fetch for notifications on page load
            $sql = "
                SELECT id, sender, created_at
                FROM interests
                WHERE receiver = '$logged_in_username' AND status = 'pending'
                ORDER BY created_at DESC
            ";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo "Error in query: " . mysqli_error($conn); // Debugging line
            }

           

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a class='notification' href='view_profile2.php?username=" . urlencode($row['sender']) . "&notification_id=" . $row['id'] . "'>
                    <strong>" . htmlspecialchars($row['sender']) . "</strong> has sent an interest to you.
                    <div class='timestamp'>Requested at: " . date('Y-m-d H:i:s', strtotime($row['created_at'])) . "</div>
                  </a>";
            
                }
            } else {
                echo "<div class='no-notifications'>No notifications yet.</div>";
            }
        }
        ?>
    </div>
</div>

<div id="popup-notification"></div>

<?php include '../homepage/footer.php'; ?>

<script>
let existingNotifications = []; // Store existing notifications to prevent overwriting

function fetchNewRequests() {
    fetch('fetch_new_requests.php')
        .then(response => response.json())
        .then(data => {
            const notificationList = document.getElementById('notification-list');

            // Append new notifications to the existing list
            if (data.newRequests && data.newRequests.length > 0) {
                data.newRequests.forEach(notification => {
                    // Create a new notification element
                    const notificationElement = document.createElement('a');
                    notificationElement.className = 'notification';
                    notificationElement.href = 'view_profile.php?username=' + encodeURIComponent(notification.sender);
                    notificationElement.innerHTML = `
                        <strong>${notification.sender}</strong> has sent an interest to you.
                        <div class='timestamp'>Requested at: ${notification.created_at}</div>
                    `;
                    notificationList.appendChild(notificationElement);

                    // Show pop-up notification
                    showPopupNotification(notification.sender);
                });
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

// Call fetchNewRequests every 2 seconds
setInterval(fetchNewRequests, 2000);

function showPopupNotification(username) {
    const popupNotification = document.getElementById('popup-notification');
    popupNotification.innerText = `${username} has sent an interest to you.`;
    popupNotification.style.display = 'block';

    // Hide the notification after 3 seconds
    setTimeout(() => {
        popupNotification.style.display = 'none';
    }, 3000);
}
</script>

</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>
