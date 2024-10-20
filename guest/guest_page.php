<?php
include '../config/db.php';

// Fetch all profiles from the database
$sql_profiles = "SELECT * FROM user";
$profiles_result = mysqli_query($conn, $sql_profiles);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vows and Values</title>
    <link rel="stylesheet" href="../homepage/frontpg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="homepage-banner">
        <div class="banner-content">
            <h1>At Vows and Values, we connect hearts with meaning. Find your match now!</h1>
            <a href="gsearch.php" class="find-button">Find</a>
        </div>
    </section>

<main>
      <!-- Profiles Section -->
      <div class="profiles-section">
        <h2>Profiles</h2>
        
        <?php
          if (mysqli_num_rows($profiles_result) > 0) {
              while ($profile = mysqli_fetch_assoc($profiles_result)) {
               // Fetch user_id and state
               $user_id = $profile['user_id'];
               $state = $profile['state']; // Fetching state
               echo '<div class="profile-card" onclick="window.location.href=\'../guest/gprofile.php?user_id=' . $user_id . '\'">';
               // Adjusted path for profilePic
               echo '<img class="profile-pic" src="../users/' . $profile['profilePic'] . '" alt="' . $profile['fullName'] . '">';
               echo '<div class="profile-details">';
               echo '<span class="username">' . $profile['fullName'] . '</span>';
               echo '<span class="age-state">' . $profile['age'] . ' years old, ' . $state . '</span>'; // Displaying state instead of location
               echo '</div>';
               echo '</div>';
              }
          } else {
              echo '<p>No profiles found.</p>';
          }
        ?>
      </div>
</main>

<?php include '../homepage/footer.php'; ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
