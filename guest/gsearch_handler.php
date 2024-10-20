
<?php
// Start session to access session variables
session_start();

// Database connection
include '../config/db.php';

// Initialize error message
$error_message = '';

// Check if search parameters are submitted via POST or are already stored in the session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve search parameters from POST and store them in session
    $_SESSION['gender'] = $_POST['gender'] ?? '';
    $_SESSION['age_range'] = $_POST['age_range'] ?? '';
    $_SESSION['state'] = $_POST['state'] ?? '';
    $_SESSION['district'] = $_POST['district'] ?? '';
    $_SESSION['religion'] = $_POST['religion'] ?? '';
    $_SESSION['hashtags'] = $_POST['hashtags'] ?? '';
} else {
    // Retrieve search parameters from the session
    $_POST['gender'] = $_SESSION['gender'] ?? '';
    $_POST['age_range'] = $_SESSION['age_range'] ?? '';
    $_POST['state'] = $_SESSION['state'] ?? '';
    $_POST['district'] = $_SESSION['district'] ?? '';
    $_POST['religion'] = $_SESSION['religion'] ?? '';
    $_POST['hashtags'] = $_SESSION['hashtags'] ?? '';
}

// Get logged-in username from session
$logged_in_username = $_SESSION['username'] ?? null;

// Build the dynamic SQL query
$sql = "SELECT * FROM user WHERE username != '$logged_in_username'";

// Dynamically append conditions based on non-empty fields
if (!empty($_POST['gender'])) {
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $sql .= " AND gender = '$gender'";
}

if (!empty($_POST['age_range'])) {
    list($age_from, $age_to) = explode('-', $_POST['age_range']);
    $sql .= " AND age BETWEEN $age_from AND $age_to";
}

if (!empty($_POST['state'])) {
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $sql .= " AND state = '$state'";
}

if (!empty($_POST['district'])) {
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $sql .= " AND district = '$district'";
}

if (!empty($_POST['religion'])) {
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $sql .= " AND religion = '$religion'";
}

if (!empty($_POST['hashtags'])) {
    // Split the hashtags into an array (assuming they are separated by # or spaces)
    $hashtag_array = preg_split('/[\s#]+/', $_POST['hashtags']);
    
    // Build a query for matching any of the provided hashtags
    $hashtag_conditions = array();
    foreach ($hashtag_array as $hashtag) {
        $hashtag = trim($hashtag);
        if (!empty($hashtag)) {
            $hashtag_conditions[] = "hashtags LIKE '%" . mysqli_real_escape_string($conn, $hashtag) . "%'";
        }
    }

    // Add the hashtag conditions to the SQL query
    if (count($hashtag_conditions) > 0) {
        $sql .= " AND (" . implode(" OR ", $hashtag_conditions) . ")";
    }
}

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error: " . mysqli_error($conn);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #1b1b1b; /* Main background color */
            color: #ffffff; /* Text color */
            font-family: Arial, sans-serif;
            padding: 20px;
        }
      
        .profile-container {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid var(--accent-color); /* Neon accent border */
            border-radius: 10px;
            background-color: rgba(51, 51, 51, 0.9); /* Slightly transparent dark background */
            box-shadow: 0 0 15px rgba(192, 97, 105, 0.8); /* Neon glow effect around container */
            transition: transform 0.3s ease; /* Smooth transition for any hover effect */
        }

        .profile-container:hover {
            transform: scale(1.02); /* Slight scale on hover to emphasize interaction */
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            background-color: #2b2b2b; /* Darker background for profile picture */
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%; /* Circular profile picture */
            margin-right: 20px; /* Space between the picture and details */
            box-shadow: 0 0 10px rgba(192, 97, 105, 0.8); /* Neon glow around profile picture */
        }

        .profile-pic img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }

        .profile-details {
            flex-grow: 1; /* Makes the details section take the remaining width */
            color: var(--text-color);
        }

        .profile-details p {
            margin: 5px 0; /* Adds spacing between the text details */
        }

        /* Ensure the entire profile container is clickable */
        .profile-link {
            text-decoration: none; /* Remove default underline from links */
            color: inherit; /* Inherit the default text color */
            display: block; /* Make the entire div clickable */
        }

        /* Styling for hover effect */
        .profile-link:hover .profile-container {
            transform: scale(1.03); /* Slightly increase size on hover */
            box-shadow: 0 0 20px rgba(192, 97, 105, 1); /* Enhance neon glow on hover */
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>    

<h1 style="text-align: center;">Search Results</h1>
<script>
    console.log('Page loaded successfully.');
</script>

<?php
// Display error message if any
if (!empty($error_message)) {
    echo '<div class="error">' . htmlspecialchars($error_message) . '</div>';
} elseif (isset($result) && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        echo "<script>console.log('User ID: " . htmlspecialchars($user_id) . "');</script>";
      
        // Open the anchor tag to link to the profile page
        echo '<a href="gsearch_profile.php?user_id=' . $user_id . '" class="profile-link" onclick="console.log(\'Clicked User ID: ' . htmlspecialchars($user_id) . '\');">';
        echo '<div class="profile-container">';
        echo '    <div class="profile-pic">'; // Profile picture onleft
        echo '        <img src="../users/' . htmlspecialchars($row['profilePic']) . '" alt="' . htmlspecialchars($row['fullName']) . '">';
        echo '    </div>';
        echo '    <div class="profile-details">'; // Profile details onright
        echo '        <strong>' . htmlspecialchars($row['fullName']) . '</strong>';
        echo '        <p>Gender: ' . htmlspecialchars($row['gender']) . '</p>';
        echo '        <p>Location: ' . htmlspecialchars($row['state']) . ', ' . htmlspecialchars($row['district']) . '</p>';
        echo '        <p>Age: ' . htmlspecialchars($row['age']) . '</p>';
        echo '        <p>Religion: ' . htmlspecialchars($row['religion']) . '</p>';
        echo '    </div>';
        echo '</div>';
        echo '</a>';
    }
} elseif (isset($result)) {
    echo '<p>No profiles found.</p>';
}

// Close the database connection
mysqli_close($conn);
?>
<?php include '../homepage/footer.php'; ?>
</body>
</html>
