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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'withdraw_sentReq') {
    // Sanitize the input
    $interest_id = mysqli_real_escape_string($conn, $_POST['interest_id']);
    
    // Check if the interest ID is valid
    if (!empty($interest_id)) {
        // Option 1: Delete the interest from the database (if you want to completely remove it)
        $delete_sql = "DELETE FROM interests WHERE id = '$interest_id'";
        $delete_result = mysqli_query($conn, $delete_sql);
        
        if ($delete_result) {
            echo "<script>alert('Interest successfully withdrawn.');</script>";
        } else {
            echo "<script>alert('Error withdrawing interest. Please try again.');</script>";
        }
        
        // Option 2: Soft delete (change status to 'withdrawn') if you prefer not to delete the entry
        // $update_sql = "UPDATE interests SET status = 'withdrawn' WHERE id = '$interest_id'";
        // $update_result = mysqli_query($conn, $update_sql);
        
        // if ($update_result) {
        //     echo '<p class="success-message">Interest successfully withdrawn.</p>';
        // } else {
        //     echo '<p class="error-message">Error withdrawing interest. Please try again.</p>';
        // }
    }
}


// Handle accept/reject actions for received interests
// Handle accept/reject actions for received interests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $interest_id = $_POST['interest_id'];
    $action = $_POST['action'];
    
    if ($action == 'accept') {
        $update_sql = "UPDATE interests SET status = 'accepted' WHERE id = '$interest_id'";
        mysqli_query($conn, $update_sql);

        // Store message in a session variable
        $_SESSION['accept_message'] = "You accepted an interest! Check matched section for contact info.";

    } elseif($action == 'reject') {
        $update_sql = "UPDATE interests SET status = 'rejected' WHERE id = '$interest_id'";
        mysqli_query($conn, $update_sql);
    } else {
        $update_sql = "UPDATE interests SET status = 'pending' WHERE id = '$interest_id'";
        mysqli_query($conn, $update_sql);
    }

    // Redirect to the same page
    header("Location: match2.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches - Vows and Values</title>
    <link rel="stylesheet" href="../css/match2.css"> <!-- Link to your CSS file -->
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
<?php
// Display accept message if available
if (isset($_SESSION['accept_message'])) {
    echo "<script>alert('" . $_SESSION['accept_message'] . "');</script>";
    // Unset the session variable after displaying the message
    unset($_SESSION['accept_message']);
}
?>


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
                    echo '    <a href="matched_profile.php?username=' . urlencode($profile['username']) . '" class="profile-link">';
                    echo '    <div class="profile-container">';
                    echo '        <div class="profile-pic">';
                    echo '            <img src="../users/' . htmlspecialchars($profile['profilePic']) . '" alt="' . htmlspecialchars($profile['fullName']) . '">';
                    echo '        </div>';
                    echo '        <div class="profile-details">';
                    echo '            <strong>' . htmlspecialchars($profile['fullName']) . '</strong>';
                    echo '            <p>Age: ' . htmlspecialchars($profile['age']) . '</p>';
                    echo '            <p>Religion: ' . htmlspecialchars($profile['religion']) . '</p>';
                    echo '        </div>';
                   
                    echo '    </div>';
                    echo '    </a>';
                    echo '</li>';
                }
            } else {
                echo '<li>No matches found.</li>';
            }
            ?>
        </ul>
    </div>

    <div class="tabs">
        <div class="tab-links active" onclick="showTab('sentTab')">Sent Interests</div>
        <div class="tab-links" onclick="showTab('receivedTab')">Received Interests</div>
<div id="sentTab" class="tab active">
    <h2>Sent Interests</h2>
    <ul class="matches-list">
        <?php
        if ($sent_result && mysqli_num_rows($sent_result) > 0) {
            while ($sent = mysqli_fetch_assoc($sent_result)) {
                $receiver_sql = "SELECT * FROM user WHERE username = '{$sent['receiver']}'";
                $receiver_result = mysqli_query($conn, $receiver_sql);
                $receiver = mysqli_fetch_assoc($receiver_result);

                echo '<li>';
                echo '    <a href="view_profile.php?username=' . urlencode($receiver['username']) . '" class="profile-link">';
                echo '    <div class="profile-container">';
                echo '        <div class="profile-pic">';
                echo '            <img src="../users/' . htmlspecialchars($receiver['profilePic']) . '" alt="' . htmlspecialchars($receiver['fullName']) . '">';
                echo '        </div>';  
                echo '        <div class="profile-details">';
                echo '            <strong>' . htmlspecialchars($receiver['fullName']) . '</strong>';
                echo '            <p>Status: ' . htmlspecialchars($sent['status']) . '</p>';

                // Action: Show the "Withdraw" button if the status is "pending" or "accepted"
                if ($sent['status'] === 'pending' || $sent['status'] === 'accepted') {
                    echo '            <form method="POST" style="display:inline;">';
                    echo '                <input type="hidden" name="interest_id" value="' . $sent['id'] . '">';
                    echo '                <button type="submit" name="action" value="withdraw_sentReq" class="button withdraw">Withdraw</button>';
                    echo '            </form>';
                } else {
                    echo '            <p>Action: Cannot withdraw (status: ' . htmlspecialchars($sent['status']) . ')</p>';
                }

                echo '        </div>';
                echo '    </div>';
                echo '    </a>'; // Closing the anchor tag
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
            <ul class="matches-list">
                <?php
                if ($received_result && mysqli_num_rows($received_result) > 0) {
                    while ($received = mysqli_fetch_assoc($received_result)) {
                        $sender_sql = "SELECT * FROM user WHERE username = '{$received['sender']}'";
                        $sender_result = mysqli_query($conn, $sender_sql);
                        $sender = mysqli_fetch_assoc($sender_result);
                        echo '<li>';
                        echo '    <a href="view_profile.php?username=' . urlencode($sender['username']) . '" class="profile-link">';

                        echo '    <div class="profile-container">';
                        echo '        <div class="profile-pic">';
                        echo '            <img src="../users/' . htmlspecialchars($sender['profilePic']) . '" alt="' . htmlspecialchars($sender['fullName']) . '">';
                        echo '        </div>';
                        echo '        <div class="profile-details">';
                        echo '            <strong>' . htmlspecialchars($sender['fullName']) . '</strong>';
                        echo '            <p>Status: ' . htmlspecialchars($received['status']) . '</p>';
                        if ($received['status'] === 'accepted') {
                            echo '            <button class="button accepted" disabled>Accepted</button>';
                            echo '            <form method="POST" style="display:inline;">';
                            echo '                <input type="hidden" name="interest_id" value="' . $received['id'] . '">';
                            echo '                <button type="submit" name="action" value="withdraw" class="button withdraw">Withdraw</button>';
                            echo '            </form>';
                        } elseif ($received['status'] === 'rejected') {
                            echo '            <button class="button rejected" disabled>Rejected</button>';
                        }elseif ($received['status'] === 'pending') {
                            echo '            <form method="POST" style="display:inline;" onsubmit="return handleAction(this);">';
                            echo '                <input type="hidden" name="interest_id" value="' . htmlspecialchars($received['id']) . '">';
                            echo '                <button type="submit" name="action" value="accept" class="button">Accept</button>';
                            echo '                <button type="submit" name="action" value="reject" class="button">Reject</button>';
                            echo '            </form>';
                        }
                        echo '        </div>';
                        echo '    </div>';
                        echo '    </a>';
                        echo '</li>';
                    }
                } else {
                    echo '<li>No received interests found.</li>';
                }
                ?>
            </ul>
        </div>
        <script>
            function handleAction(form) {
                if (form.action.value === 'reject') {
                   return confirm("Are you sure you want to reject this interest?");
                  }
                  // No confirmation needed for "Accept", just proceed with the form submission
                   return true;
                 }
         </script>
    </div>
</div>
</body>
</html>
