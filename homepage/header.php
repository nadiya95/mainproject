<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config/db.php';

// Ensure the session variable is set
$logged_in_username = $_SESSION['username'] ?? null;

// Initialize the count variable
$count = 0; // Default to zero

// Fetch unread notifications count
if ($logged_in_username) {
    $sql = "SELECT COUNT(*) as count FROM interests WHERE receiver = '$logged_in_username' AND status = 'pending' AND is_read = 0";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($result)['count'] ?? 0; // Get the count, default to 0 if not found
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #c06169;
        position: relative; /* This ensures that the child elements are positioned relative to the header */
    }

    .logo img {
        width: 100px; /* Adjust the width to a reasonable size */
        height: auto; /* Maintains the aspect ratio */
    }

    nav ul {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    nav ul li {
    margin-right: 30px; /* Increased from 20px to 30px for more space */
    position: relative;
}


    nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    .menu-icon {
        display: block;
        cursor: pointer;
    }

    .menu-popup {
        display: none;
        position: absolute;
        top: 50px;
        right: 20px;
        background-color: #333;
        padding: 10px;
        border-radius: 5px;
    }

    .menu-popup ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .menu-popup ul li {
        margin-bottom: 10px;
    }

    .menu-popup ul li a {
        color: #fff;
        text-decoration: none;
    }

    .notification-bubble {
        background-color: #ffffff;
        color: #c06169;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 50%;
        position: absolute;
        top: -3px; /* Adjusted to make it sit closer to the bell */
        right: -24px; /* Adjusted to position relative to the bell */
        display: inline-block;
    }

    </style>
    <script>
        // JavaScript for toggling the menu
        function toggleMenu() {
            var menu = document.getElementById("menuPopup");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }
    </script>
</head>
<body>
<header>
    <div class="logo">
        <img src="" alt="Vows and Values Logo">
    </div>
    <nav>
        <ul>
            <li><a href="../homepage/index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="../homepage/search.php"><i class="fas fa-search"></i> Search</a></li>
            <li><a href="../homepage/match2.php"><i class="fas fa-heart"></i> Matches</a></li>
            <li>
                <a href="../homepage/notifications.php">
                    <i class="fas fa-bell"></i> Notifications
                    <span id="notification-count" class="notification-bubble"></span> <!-- Bubble for count -->
                </a>
            </li>
            <li><a href="../homepage/about.php"><i class="fas fa-info-circle"></i>About Us</a></li>
            <li><a href="../homepage/profile_update.php"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </nav>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    <div class="menu-popup" id="menuPopup"> 
        <ul>
            <li><a href="profile_update.php">Update Account</a></li>
            <li><a href="#" onclick="confirmDelete()">Delete Account</a></li>
            <li><a href="../homepage/logout.php">Log Out</a></li>
        </ul>
    </div>
    <script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this account?")) {
            window.location.href = "../handlers/delete_handler.php"; // Redirect to delete handler
        }
    }
    
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
                
                if (data > 0) {
                    notificationCountElement.textContent = data; // Update the notification count bubble
                    notificationCountElement.style.display = 'inline-block'; // Ensure it is visible
                } else {
                    notificationCountElement.style.display = 'none'; // Hide the bubble if there are no notifications
                }
            })
            .catch(error => console.error('Error fetching notification count:', error));
    }

    // Fetch notification count every 2 seconds
    setInterval(updateNotificationCount, 2000);

    // Initial fetch when the page loads
    document.addEventListener('DOMContentLoaded', updateNotificationCount);
    </script>
</header>
</body>
</html>
