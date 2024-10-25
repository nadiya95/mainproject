<?php
include '../config/db.php';

// Start session to access logged-in user details
session_start();

// Get the logged-in user's username
$username = $_SESSION['username'];

// Fetch the logged-in user's gender
$sql = "SELECT gender FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$logged_in_gender = $row['gender'];

// Determine the opposite gender
$opposite_gender = ($logged_in_gender == 'Male') ? 'Female' : 'Male';

// Fetch profiles of the opposite gender for the profile section
$sql_profiles = "SELECT * FROM user WHERE gender = '$opposite_gender'";
$profiles_result = mysqli_query($conn, $sql_profiles);

// Fetch received interests
$sql_received = "SELECT * FROM interests WHERE receiver = '$username'";
$received_result = mysqli_query($conn, $sql_received);

// Fetch sent interests
$sql_sent = "SELECT * FROM interests WHERE sender = '$username'";
$sent_result = mysqli_query($conn, $sql_sent);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vows and Values</title>
    <link rel="stylesheet" href="frontpg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .profile-container a {
    text-decoration: none; /* Removes underline */
    color: inherit; /* Inherits color from the parent element */
}

        nav {
            background-color: #f4c2ac; /* Example background color */
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            text-decoration: none;
            color: #333; /* Text color */
            padding: 10px 15px;
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #a05257; /* Hover color */
        }
        /* Optional styles for profile container */
        .profile-container {
            margin: 10px 0;
        }
        .profile-container img {
            width: 50px; /* Adjust size as needed */
            height: 50px; /* Adjust size as needed */
            border-radius: 50%; /* Circular image */
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="homepage-banner">
        <div class="banner-content">
            <h1>At Vows and Values, we connect hearts with meaning. Find your match now!</h1>
            <a href="search.php" class="find-button">Find</a>
        </div>
</section>
<main>
   
    <!-- Activity Log Section -->
    <div class="activity-log">
        <h2>Activity Logs</h2>
        <div class="tabs">
            <button id="sentBtn" onclick="showSent()">Sent</button>
            <button id="receivedBtn" onclick="showReceived()">Received</button>
        </div>

      <!-- Sent Interests (Visible by default) -->
<div id="sentRequests" class="requests">
    <?php
    if (mysqli_num_rows($sent_result) > 0) {
        while ($row_sent = mysqli_fetch_assoc($sent_result)) {
            $receiver = $row_sent['receiver'];
            $sql_receiver_profile = "SELECT * FROM user WHERE username = '$receiver'";
            $receiver_profile_result = mysqli_query($conn, $sql_receiver_profile);
            $receiver_profile = mysqli_fetch_assoc($receiver_profile_result);
            echo '<div class="profile-container">';
            echo '<a href="view_profile3.php?username=' . $receiver_profile['username'] . '">';
            echo '<img src="../users/' . $receiver_profile['profilePic'] . '" alt="' . $receiver_profile['fullName'] . '">';
            echo 'You have sent an interest to ' . htmlspecialchars($receiver_profile['fullName']) . '.';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo '<p>No sent interests yet.</p>';
    }
    ?>
</div>

<!-- Received Interests (Initially hidden) -->
<div id="receivedRequests" class="requests" style="display:none;">
    <?php
    if (mysqli_num_rows($received_result) > 0) {
        while ($row_received = mysqli_fetch_assoc($received_result)) {
            $sender = $row_received['sender'];
            $sql_sender_profile = "SELECT * FROM user WHERE username = '$sender'";
            $sender_profile_result = mysqli_query($conn, $sql_sender_profile);
            $sender_profile = mysqli_fetch_assoc($sender_profile_result);
            echo '<div class="profile-container">';
            echo '<a href="view_profile3.php?username=' . $sender_profile['username'] . '">';
            echo '<img src="../users/' . $sender_profile['profilePic'] . '" alt="' . $sender_profile['fullName'] . '">';
            echo '<span>' . htmlspecialchars($sender_profile['fullName']) . ' has sent an interest.</span>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo '<p>No received interests yet.</p>';
    }
    ?>
</div>

    </div>
    <!-- Profiles Section -->
    <div class="profiles-section">
        <h2>Profiles</h2>
        
        <?php
        if (mysqli_num_rows($profiles_result) > 0) {
            while ($profile = mysqli_fetch_assoc($profiles_result)) {
                // Fetch user_id and state
                $user_id = $profile['user_id'];
                $state = $profile['state']; // Fetching state
                echo '<div class="profile-card" onclick="window.location.href=\'../users/home_profile.php?user_id=' . $user_id . '\'">';
                // Adjusted path for profilePic
                echo '<img class="profile-pic" src="../users/' . $profile['profilePic'] . '" alt="' . $profile['fullName'] . '">';
                echo '<div class="profile-details">';
                echo '<span class="username">' . htmlspecialchars($profile['fullName']) . '</span>';
                echo '<span class="age-state">' . $profile['age'] . ' years old, ' . htmlspecialchars($state) . '</span>'; // Displaying state instead of location
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No profiles found.</p>';
        }
        ?>
    </div>

</main>

<script>
    function showReceived() {
        document.getElementById('receivedRequests').style.display = 'block';
        document.getElementById('sentRequests').style.display = 'none';
    }

    function showSent() {
        document.getElementById('receivedRequests').style.display = 'none';
        document.getElementById('sentRequests').style.display = 'block';
    }
</script>

<?php include 'footer.php'; ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
