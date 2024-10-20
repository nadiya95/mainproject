
<?php
session_start();
include '../config/db.php';

$logged_in_username = $_SESSION['username'] ?? null;

// Fetch matched users
$matched_sql = "SELECT * FROM interests 
                WHERE (sender = '$logged_in_username' OR receiver = '$logged_in_username') 
                AND status = 'accepted'";
$matched_result = mysqli_query($conn, $matched_sql);

// Fetch sent interests
$sent_sql = "SELECT * FROM interests WHERE sender = '$logged_in_username'";
$sent_result = mysqli_query($conn, $sent_sql);

// Fetch received interests
$received_sql = "SELECT * FROM interests WHERE receiver = '$logged_in_username'";
$received_result = mysqli_query($conn, $received_sql);

// Handle accept/reject actions for received interests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $interest_id = $_POST['interest_id'];
    $action = $_POST['action'];
    
    if ($action == 'accept') {
        $update_sql = "UPDATE interests SET status = 'accepted' WHERE id = '$interest_id'";
    } else {
        $update_sql = "UPDATE interests SET status = 'rejected' WHERE id = '$interest_id'";
    }
    mysqli_query($conn, $update_sql);
    header("Location: matches.php"); // Refresh the page to see changes
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches - Vows and Values</title>
    <link rel="stylesheet" href="../css/match.css"> <!-- Link to your CSS file -->
    <script>
        function showTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";  
            }
            tablinks = document.getElementsByClassName("tab-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";  
            event.currentTarget.classList.add("active");
        }
    </script>
</head>
<body>
<?php include '../homepage/header.php'; ?>    

<h1 style="text-align: center;">Matches</h1>

<div class="container">
    <div class="matched-section">
        <h2>Matched</h2>
        <ul class="matches-list">
            <?php
            if ($matched_result && mysqli_num_rows($matched_result) > 0) {
                while ($match = mysqli_fetch_assoc($matched_result)) {
                    $matched_username = ($match['sender'] == $logged_in_username) ? $match['receiver'] : $match['sender'];
                    $profile_sql = "SELECT * FROM user WHERE username = '$matched_username'";
                    $profile_result = mysqli_query($conn, $profile_sql);
                    $profile = mysqli_fetch_assoc($profile_result);
                    echo '<li>';
                    echo '    <div class="profile-container">';
                    echo '        <div class="profile-pic">';
                    echo '            <img src="' . htmlspecialchars($profile['profilePic']) . '" alt="' . htmlspecialchars($profile['fullName']) . '">';
                    echo '        </div>';
                    echo '        <div class="profile-details">';
                    echo '            <strong>' . htmlspecialchars($profile['fullName']) . '</strong>';
                    echo '            <p>Age: ' . htmlspecialchars($profile['age']) . '</p>';
                    echo '            <p>Religion: ' . htmlspecialchars($profile['religion']) . '</p>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</li>';
                }
            } else {
                echo '<li>No matches found.</li>';
            }
            ?>
        </ul>
    </div>

    <div class="tabs">
        <div class="tab-links" onclick="showTab('sentTab')">Sent Interests</div>
        <div class="tab-links" onclick="showTab('receivedTab')">Received Interests</div>

        <div id="sentTab" class="tab active">
            <h2>Sent Interests</h2>
            <ul>
                <?php
                if ($sent_result && mysqli_num_rows($sent_result) > 0) {
                    while ($sent = mysqli_fetch_assoc($sent_result)) {
                        $receiver_sql = "SELECT * FROM user WHERE username = '{$sent['receiver']}'";
                        $receiver_result = mysqli_query($conn, $receiver_sql);
                        $receiver = mysqli_fetch_assoc($receiver_result);

                        echo '<li>';
                        echo '    <div class="profile-container">';
                        echo '        <div class="profile-pic">';
                        echo '            <img src="' . htmlspecialchars($receiver['profilePic']) . '" alt="' . htmlspecialchars($receiver['fullName']) . '">';
                        echo '        </div>';  
                        echo '        <div class="profile-details">';
                        echo '            <strong>' . htmlspecialchars($receiver['fullName']) . '</strong>';
                        echo '            <p>Status: ' . htmlspecialchars($sent['status']) . '</p>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</li>';
                    }
                } else {
                    echo '<li>No sent interests found.</li>';
                }
                ?>
            </ul>
        </div>

        <div id="receivedTab" class="tab">
            <h2>Received Interests</h2>
            <ul>
                <?php
                if ($received_result && mysqli_num_rows($received_result) > 0) {
                    while ($received = mysqli_fetch_assoc($received_result)) {
                        $sender_sql = "SELECT * FROM user WHERE username = '{$received['sender']}'";
                        $sender_result = mysqli_query($conn, $sender_sql);
                        $sender = mysqli_fetch_assoc($sender_result);

                        echo '<li>';
                        echo '    <div class="profile-container">';
                        echo '        <div class="profile-pic">';
                        echo '            <img src="' . htmlspecialchars($sender['profilePic']) . '" alt="' . htmlspecialchars($sender['fullName']) . '">';
                        echo '        </div>';
                        echo '        <div class="profile-details">';
                        echo '            <strong>' . htmlspecialchars($sender['fullName']) . '</strong>';
                        echo '            <p>Status: ' . htmlspecialchars($received['status']) . '</p>';
                        echo '            <form method="POST">';
                        echo '                <input type="hidden" name="interest_id" value="' . $received['id'] . '">';
                        echo '                <button type="submit" name="action" value="accept">Accept</button>';
                        echo '                <button type="submit" name="action" value="reject">Reject</button>';
                        echo '            </form>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</li>';
                    }
                } else {
                    echo '<li>No received interests found.</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
