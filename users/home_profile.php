<?php
session_start();
// Include the database connection file
include('../config/db.php');
include('../homepage/header.php');

// Get user_id from the URL
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Fetch user data from the database
$query = "SELECT * FROM user WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle the case where the user is not found
    echo "<p>User not found.</p>";
    exit;
}

// Fetch personality data from the personality table
$personality_query = "SELECT personality_type, personality_description FROM personality WHERE user_id = $user_id";
$personality_result = mysqli_query($conn, $personality_query);
if ($personality_result && mysqli_num_rows($personality_result) > 0) {
    $personality = mysqli_fetch_assoc($personality_result);
} else {
    $personality = ['personality_type' => 'N/A', 'personality_description' => 'N/A']; // Default values if not found
}

$sender = $_SESSION['username'];
$receiver = htmlspecialchars($user['username']);

// Check if the form (send interest button) has been submitted
if (isset($_POST['send_interest'])) {
    // Check if the current user has already sent an interest to the receiver
    $checkSentQuery = "SELECT * FROM interests WHERE sender='$sender' AND receiver='$receiver'";
    $sentResult = mysqli_query($conn, $checkSentQuery);
    
    if (mysqli_num_rows($sentResult) > 0) {
        // Interest already sent by the current user
        echo "<script>alert('Already sent an interest');</script>";
    } else {
        // Check if the receiver has already sent an interest to the current user
        $checkReceivedQuery = "SELECT * FROM interests WHERE sender='$receiver' AND receiver='$sender'";
        $receivedResult = mysqli_query($conn, $checkReceivedQuery);
        
        if (mysqli_num_rows($receivedResult) > 0) {
            // Interest already received from the other user
            echo "<script>alert('User has sent an interest already. Accept or decline in matches section');</script>";
        } else {
            // Prepare the SQL query to insert the interest
            $query = "INSERT INTO interests (sender, receiver) VALUES ('$sender', '$receiver')";
            if (mysqli_query($conn, $query)) {
                // Interest sent successfully
                echo "<script>alert('Interest sent successfully!');</script>";
            } else {
                // Error sending interest
                echo "<script>alert('Error sending interest: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/profile.css"> <!-- Link to your CSS file -->
    <title><?php echo htmlspecialchars($user['fullName']); ?>'s Profile</title>
    <style>
        /* Additional CSS */
        .profile-container {
            width: 100%; /* Adjusted to normal size */
            max-width: 800px; /* Set a max width */
            margin: auto; /* Center the container */
            padding: 20px; /* Padding inside the container */
            background-color: var(--input-bg-color); /* Keep the original background color */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Positioning for glow effect */
        }

        .profile-container:hover {
            box-shadow: 0 0 20px #ff7f50, 0 0 30px #ff7f50; /* Neon glow effect */
        }

        .back-button {
            cursor: pointer;
            margin-bottom: 10px; /* Space between back button and profile container */
            font-size: 20px; /* Adjust size of the back button */
            color: #c06169; /* Accent color for the back button */
        }

        legend {
            border: 2px solid #ff7f50; /* Neon peach color */
            color: #E9B796; /* Legend heading color */
            padding: 10px;
            font-weight: bold;
            border-radius: 5px;
            text-shadow: 0 0 5px #ff7f50, 0 0 10px #ff7f50; /* Glow effect for legend */
        }
        <!-- Include this CSS in your styles -->
        .chat-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background-color: #c06169; /* Main theme color */
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }

  .chat-btn i {
    margin-right: 10px;
    font-size: 18px; /* Icon size */
  }

  .chat-btn:hover {
    background-color: #a9515c; /* Slightly darker shade */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Hover effect */
  }

  .chat-btn:active {
    background-color: #8f4752; /* Even darker shade for click */
    box-shadow: none; /* No shadow on click */
  }

  .chat-btn:focus {
    outline: none; /* Remove default button focus outline */
  }
    </style>
</head>
<body>

<!-- Back Button -->
<a href="../homepage/index.php" class="back-button">
    <i class="fas fa-arrow-left"></i> Back
</a>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-pic">
            <img src="<?php echo htmlspecialchars($user['profilePic']); ?>" alt="<?php echo htmlspecialchars($user['fullName']); ?>">
        </div>
        <h2><?php echo htmlspecialchars($user['fullName']); ?></h2>
    </div>

       <!-- HTML Form for sending interest -->
<!-- HTML Form for sending interest -->
<form method="POST" action="home_profile.php?user_id=<?php echo $user_id; ?>">
    <button type="submit" name="send_interest" class="send-interest">
        <i class="fas fa-heart"></i> 
        <span class="tooltip">Send Interest</span>
    </button>
</form>
<button class="chat-btn" onclick="window.location.href='chat.php?user_id=<?php echo htmlspecialchars($user['user_id']); ?>'">
  <i class="fas fa-comments"></i> Chat Now
</button>
    <div class="tabs">
        <button class="tab-button active" onclick="openTab('about')">
            <i class="fas fa-user"></i> About You
        </button>
        <button class="tab-button" onclick="openTab('family')">
            <i class="fas fa-home"></i> Family
        </button>
        <button class="tab-button" onclick="openTab('career')">
            <i class="fas fa-briefcase"></i> Career
        </button>
        <button class="tab-button" onclick="openTab('expectations')">
            <i class="fas fa-heart"></i> Expectations
        </button>
    </div>

    <div class="tab-content">
        <div id="about" class="tab active">
           <fieldset>
              <legend>About Me</legend>
               <p><?php echo htmlspecialchars($user['bio']); ?></p> <!-- Fetch bio from DB -->
            </fieldset>

           <fieldset>
               <legend>Personality Type</legend>
               <p><?php echo htmlspecialchars($personality['personality_type']); ?></p> <!-- Fetch personality type from DB -->
               <p><?php echo htmlspecialchars($personality['personality_description']); ?></p> <!-- Fetch personality description from DB -->
           </fieldset>
            <fieldset>
                <legend>Personal Details</legend>
                <p>Full Name: <?php echo htmlspecialchars($user['fullName']); ?></p>
                <p>Date of Birth: <?php echo htmlspecialchars($user['dob']); ?></p>
                <p>Age: <?php echo htmlspecialchars($user['age']); ?></p>
                <p>Gender: <?php echo htmlspecialchars($user['gender']); ?></p>
                <p>Profile Video:</p>
                <video width="400" controls>
                    <source src="<?php echo htmlspecialchars($user['profileVideo']); ?>" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </fieldset>
            <fieldset>
                <legend>Location</legend>
                <p><?php echo htmlspecialchars($user['state']); ?>, <?php echo htmlspecialchars($user['district']); ?></p>
            </fieldset>
            <fieldset>
                <legend>Religion</legend>
                <p><?php echo htmlspecialchars($user['religion']); ?></p>
                <p>Sect: <?php echo htmlspecialchars($user['sects']); ?></p>
            </fieldset>
            <fieldset>
                <legend>Hashtags</legend>
                <p><?php echo htmlspecialchars($user['hashtags']); ?></p>
            </fieldset>
        </div>
    <div id="family" class="tab">
    <fieldset>
        <legend>Family</legend>
        <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($user['fatherName']); ?></p>
        <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($user['motherName']); ?></p>
        <p><strong>Siblings:</strong> <?php echo htmlspecialchars($user['siblings']); ?></p>
        <p><strong>Family Values:</strong> <?php echo htmlspecialchars($user['familyValues']); ?></p>
    </fieldset>
   </div>

   <div id="career" class="tab">
      <fieldset>
        <legend>Career</legend>
        <p><strong>Occupation:</strong> <?php echo htmlspecialchars($user['occupation']); ?></p>
        <p><strong>Company Name:</strong> <?php echo htmlspecialchars($user['companyName']); ?></p>
        <p><strong>Annual Income:</strong> <?php echo htmlspecialchars($user['annualIncome']); ?></p>
        <p><strong>Education:</strong> <?php echo htmlspecialchars($user['education']); ?></p>
      </fieldset>
   </div>


   <div id="expectations" class="tab">
      <fieldset>
        <legend>Partner Expectations</legend>
        <p><strong>Minimum Age:</strong> <?php echo htmlspecialchars($user['Min_age']); ?></p>
        <p><strong>Maximum Age:</strong> <?php echo htmlspecialchars($user['Max_age']); ?></p>
        <p><strong>Height Preference:</strong> <?php echo htmlspecialchars($user['heightPreference']); ?></p>
        <p><strong>Religion Preference:</strong> <?php echo htmlspecialchars($user['religionPreference']); ?></p>
        <p><strong>Education Preference:</strong> <?php echo htmlspecialchars($user['educationPreference']); ?></p>
        <p><strong>Other Preferences:</strong> <?php echo htmlspecialchars($user['otherPreference']); ?></p>
      </fieldset>
    </div>

    </div>
</div> <!-- Closing profile-container here -->

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
