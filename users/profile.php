<?php 
// Include the database connection file
include('includes/db.php'); 
include('includes/header.php'); 

// Get user_id from the URL
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Fetch user data from the database
$query = "SELECT * FROM Users WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle the case where the user is not found
    echo "<p>User not found.</p>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css"> <!-- Link to your CSS file -->
    <title><?php echo htmlspecialchars($user['fullName']); ?>'s Profile</title>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-pic">
            <img src="<?php echo htmlspecialchars($user['profilePic']); ?>" alt="<?php echo htmlspecialchars($user['fullName']); ?>">
        </div>
        <h2><?php echo htmlspecialchars($user['fullName']); ?></h2>
    </div>

    <button class="send-interest">Send Interest</button>

    <div class="tabs">
        <button class="tab-button active" onclick="openTab('about')">About You</button>
        <button class="tab-button" onclick="openTab('family')">Family</button>
        <button class="tab-button" onclick="openTab('career')">Career</button>
        <button class="tab-button" onclick="openTab('expectations')">Expectations</button>
    </div>

    <div class="tab-content">
        <div id="about" class="tab active">
            <h3>About You</h3>
            <p><?php echo htmlspecialchars($user['about']); ?></p>
        </div>
        <div id="family" class="tab">
            <h3>Family</h3>
            <p><?php echo htmlspecialchars($user['family']); ?></p>
        </div>
        <div id="career" class="tab">
            <h3>Career</h3>
            <p><?php echo htmlspecialchars($user['career']); ?></p>
        </div>
        <div id="expectations" class="tab">
            <h3>Expectations</h3>
            <p><?php echo htmlspecialchars($user['expectations']); ?></p>
        </div>
    </div>
</div>

<script>
    function openTab(tabName) {
        // Hide all tabs
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => tab.classList.remove('active'));

        // Remove active class from all buttons
        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(button => button.classList.remove('active'));

        // Show the selected tab
        document.getElementById(tabName).classList.add('active');
        
        // Mark the button as active
        event.currentTarget.classList.add('active');
    }
</script>

<?php include('../homepage/footer.php'); ?>
</body>
</html>
