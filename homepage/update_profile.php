<?php
session_start();
include('../config/db.php'); // Include the database connection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_personal_details'])) {
      // Get the form data
    $user_id = $_POST['user_id'];
    $fullName = $_POST['fullName'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    if ($age < 18) {
        echo "<script>alert('You must enter an age older than or equal to 18!.');</script>";
        exit();
    }
    // Sanitize inputs to prevent SQL injection
    $user_id = intval($user_id); // Cast to integer
    $fullName = mysqli_real_escape_string($conn, $fullName);
    $dob = mysqli_real_escape_string($conn, $dob);
    $age = intval($age); // Cast to integer
    // Update the user data in the database
    $query = "UPDATE user SET fullName='$fullName', dob='$dob', age=$age WHERE user_id=$user_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
    }

   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_location_details'])) {
      
        // Get the form data for location
        $user_id = $_POST['user_id'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $state = mysqli_real_escape_string($conn, $state);
        $district = mysqli_real_escape_string($conn, $district);

        // Update the user location data in the database
        $query = "UPDATE user SET state='$state', district='$district' WHERE user_id=$user_id";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Location updated successfully!";
            header("Location: profile_update.php"); // Redirect to the profile page
            exit();
        } else {
            $_SESSION['error'] = "Error updating location: " . mysqli_error($conn);
            header("Location: profile_update.php"); // Redirect to the profile page
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_religion_details'])) {
        // Get the form data for religion and sect
        $user_id = $_POST['user_id'];
        $religion = $_POST['religion'];
        $sect = $_POST['sect'];
        
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $religion = mysqli_real_escape_string($conn, $religion);
        $sect = mysqli_real_escape_string($conn, $sect);
    
        // Update the user religion and sect data in the database
        $query = "UPDATE user SET religion='$religion', sects='$sect' WHERE user_id=$user_id";
    
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Religion and sect updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
        } else {
            echo "<script>alert('Error updating religion and sect: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_hashtags_details'])) {
        // Get the form data for hashtags
        $user_id = $_POST['user_id'];
        $hashtags = $_POST['hashtags'];
    
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $hashtags = mysqli_real_escape_string($conn, $hashtags);
    
        // Update the user hashtags data in the database
        $query = "UPDATE user SET hashtags='$hashtags' WHERE user_id=$user_id";
    
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Hashtags updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
        } else {
            echo "<script>alert('Error updating hashtags: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_family_details'])) {
        // Get the form data for family information
        $user_id = $_POST['user_id'];
        $fatherName = $_POST['fatherName'];
        $motherName = $_POST['motherName'];
        $siblings = $_POST['siblings'];
        $familyValues = $_POST['familyValues'];
    
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $fatherName = mysqli_real_escape_string($conn, $fatherName);
        $motherName = mysqli_real_escape_string($conn, $motherName);
        $siblings = mysqli_real_escape_string($conn, $siblings);
        $familyValues = mysqli_real_escape_string($conn, $familyValues);
    
        // Update the user family information in the database
        $query = "UPDATE user SET fatherName='$fatherName', motherName='$motherName', siblings='$siblings', familyValues='$familyValues' WHERE user_id=$user_id";
    
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Family information updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
        } else {
            echo "<script>alert('Error updating family information: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_career_details'])) {
        // Get the form data for career information
        $user_id = $_POST['user_id'];
        $occupation = $_POST['occupation'];
        $companyName = $_POST['companyName'];
        $annualIncome = $_POST['annualIncome'];
        $education = $_POST['education'];
    
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $occupation = mysqli_real_escape_string($conn, $occupation);
        $companyName = mysqli_real_escape_string($conn, $companyName);
        $annualIncome = intval($annualIncome); // Cast to integer
        $education = mysqli_real_escape_string($conn, $education);
    
        // Update the user career information in the database
        $query = "UPDATE user SET occupation='$occupation', companyName='$companyName', annualIncome=$annualIncome, education='$education' WHERE user_id=$user_id";
    
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Career information updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
        } else {
            echo "<script>alert('Error updating career information: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_partner_expectations'])) {
        // Get the form data for partner expectations
        $user_id = $_POST['user_id'];
        $minAge = $_POST['Min_age'];
        $maxAge = $_POST['Max_age'];
        $heightPreference = $_POST['heightPreference'];
        $religionPreference = $_POST['religionPreference'];
        $educationPreference = $_POST['educationPreference'];
        $otherPreference = $_POST['otherPreference'];
    
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $minAge = intval($minAge); // Cast to integer
        $maxAge = intval($maxAge); // Cast to integer
        $heightPreference = mysqli_real_escape_string($conn, $heightPreference);
        $religionPreference = mysqli_real_escape_string($conn, $religionPreference);
        $educationPreference = mysqli_real_escape_string($conn, $educationPreference);
        $otherPreference = mysqli_real_escape_string($conn, $otherPreference);
    
        // Update the user partner expectations in the database
        $query = "UPDATE user SET Min_age=$minAge, Max_age=$maxAge, heightPreference='$heightPreference', religionPreference='$religionPreference', educationPreference='$educationPreference', otherPreference='$otherPreference' WHERE user_id=$user_id";
    
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Partner expectations updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
        } else {
            echo "<script>alert('Error updating partner expectations: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_appearance'])) {
        // Get the form data for appearance
        $user_id = $_POST['user_id'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $complexion = $_POST['complexion'];
        $bodyType = $_POST['bodyType'];
    
        // Sanitize inputs to prevent SQL injection
        $user_id = intval($user_id); // Cast to integer
        $height = mysqli_real_escape_string($conn, $height);
        $weight = mysqli_real_escape_string($conn, $weight);
        $complexion = mysqli_real_escape_string($conn, $complexion);
        $bodyType = mysqli_real_escape_string($conn, $bodyType);
    
        // Update the user appearance in the database
        $query = "UPDATE user SET height='$height', weight='$weight', complexion='$complexion', bodyType='$bodyType' WHERE user_id=$user_id";
    
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Appearance updated successfully!'); window.location.href='profile_update.php';</script>"; // Alert success and redirect
        } else {
            echo "<script>alert('Error updating appearance: " . mysqli_error($conn) . "'); window.location.href='profile_update.php';</script>"; // Alert error and redirect
        }
    }
    
    
    

?>
