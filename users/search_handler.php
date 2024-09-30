<?php
// Database connection
include '../config/db.php';

// Initialize error message
$error_message = '';

// Retrieve search parameters from POST
$age_range = $_POST['age_range'] ?? ''; // Default to an empty string if not set
$gender = $_POST['gender'] ?? '';
$state = $_POST['state'] ?? '';
$district = $_POST['district'] ?? '';
$religion = $_POST['religion'] ?? '';

// Check if any required fields are empty
if (empty($age_range) || empty($gender) || empty($state) || empty($district) || empty($religion)) {
    $error_message = 'All fields are required.';
}

// Proceed with the query if there are no errors
if (empty($error_message)) {
    // Extract age_from and age_to from the age_range input
    list($age_from, $age_to) = explode('-', $age_range);
    
    // SQL query to search for profiles
    $sql = "SELECT * FROM user WHERE gender = '$gender' AND state = '$state' AND district = '$district' AND religion = '$religion' AND age BETWEEN $age_from AND $age_to";
    $result = mysqli_query($conn, $sql);
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
    width: 100%;
    height: auto;
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
<?php include '../homepage/header.php'; ?>    

<h1 style="text-align: center;">Search Results</h1>

<?php
// Display error message if any
if (!empty($error_message)) {
    echo '<div class="error">' . htmlspecialchars($error_message) . '</div>';
} elseif (isset($result) && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
      // Open the anchor tag to link to the profile page
        echo '<a href="profile.php?user_id=' . $user_id . '" class="profile-link">';
        echo '<div class="profile-container">';
        echo '    <div class="profile-pic">'; // Profile picture on the left
        echo '        <img src="' . htmlspecialchars($row['profilePic']) . '" alt="' . htmlspecialchars($row['fullName']) . '">';
        echo '    </div>';
        echo '    <div class="profile-details">'; // Profile details on the right
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
