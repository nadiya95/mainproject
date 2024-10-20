<?php
// Include the database connection file
include('../config/db.php'); 
include('../homepage/header.php'); 
session_start();
$user_id = $_SESSION['user_id'];
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
          body {
            background-color: black; /* This will be overridden */
            color: white;

        }
        /* Additional CSS */
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

      /* Modal styles */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    padding-top: 60px;
}

.modal-content {
    background-color: #ffffff; /* White background for the modal */
    color : black;
    margin: 5% auto; /* 5% from the top and centered */
    padding: 20px;
    border-radius: 8px; /* Slightly rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Soft shadow for a subtle effect */
    width: 90%; /* More responsive width */
    max-width: 500px; /* Max width for larger screens */
}

.close {
    color: #888; /* Light gray for close button */
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000; /* Darker color on hover */
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-pic">
            <img src="<?php echo htmlspecialchars($user['profilePic']); ?>" alt="<?php echo htmlspecialchars($user['fullName']); ?>">
        </div>
        <h2><?php echo htmlspecialchars($user['fullName']); ?></h2>
    </div>
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
            <h3>About You</h3>
            <fieldset>
                <legend>Personal Details 
                    <i class="fas fa-edit" onclick="openModal()"></i>
                </legend>
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
                <legend>Location 
                 <i class="fas fa-edit" onclick="openLocationModal()"></i>
                 </legend>
             <p><?php echo htmlspecialchars($user['state']); ?>, <?php echo htmlspecialchars($user['district']); ?></p>
            </fieldset>
            <fieldset>
                <legend>Religion 
                  <i class="fas fa-edit" onclick="openReligionModal()"></i>
                </legend>
               <p><?php echo htmlspecialchars($user['religion']); ?></p>
               <p>Sect: <?php echo htmlspecialchars($user['sects']); ?></p>
            </fieldset>

        
            <fieldset>
               <legend>Hashtags 
                <i class="fas fa-edit" onclick="openHashtagsModal()"></i>
             </legend>
           <p><?php echo htmlspecialchars($user['hashtags']); ?></p>
           </fieldset>
            <fieldset>
              <legend>Appearance 
                  <i class="fas fa-edit" onclick="openAppearanceModal()"></i>
              </legend>
                   <p><strong>Height:</strong> <?php echo htmlspecialchars($user['height']); ?></p>
                   <p><strong>Weight:</strong> <?php echo htmlspecialchars($user['weight']); ?></p>
                   <p><strong>Complexion:</strong> <?php echo htmlspecialchars($user['complexion']); ?></p>
                   <p><strong>Body Type:</strong> <?php echo htmlspecialchars($user['bodyType']); ?></p>
            </fieldset>


        </div>
        <div id="family" class="tab">
        <fieldset>
            <legend>Family 
              <i class="fas fa-edit" onclick="openFamilyModal()"></i>
            </legend>
           <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($user['fatherName']); ?></p>
           <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($user['motherName']); ?></p>
           <p><strong>Siblings:</strong> <?php echo htmlspecialchars($user['siblings']); ?></p>
           <p><strong>Family Values:</strong> <?php echo htmlspecialchars($user['familyValues']); ?></p>
        </fieldset>

        </div>
        <div id="career" class="tab">
        <fieldset>
            <legend>Career 
                <i class="fas fa-edit" onclick="openCareerModal()"></i>
            </legend>
            <p><strong>Occupation:</strong> <?php echo htmlspecialchars($user['occupation']); ?></p>
            <p><strong>Company Name:</strong> <?php echo htmlspecialchars($user['companyName']); ?></p>
            <p><strong>Annual Income:</strong> <?php echo htmlspecialchars($user['annualIncome']); ?></p>
            <p><strong>Education:</strong> <?php echo htmlspecialchars($user['education']); ?></p>
        </fieldset>

        </div>
        <div id="expectations" class="tab">
        <fieldset>
           <legend>Partner Expectations 
            <i class="fas fa-edit" onclick="openPartnerModal()"></i>
           </legend>
            <p><strong>Minimum Age:</strong> <?php echo htmlspecialchars($user['Min_age']); ?></p> 
           <p><strong>Maximum Age:</strong> <?php echo htmlspecialchars($user['Max_age']); ?></p> 
           <p><strong>Height Preference:</strong> <?php echo htmlspecialchars($user['heightPreference']); ?></p> 
           <p><strong>Religion Preference:</strong> <?php echo htmlspecialchars($user['religionPreference']); ?></p> 
           <p><strong>Education Preference:</strong> <?php echo htmlspecialchars($user['educationPreference']); ?></p> 
           <p><strong>Other Preferences:</strong> <?php echo htmlspecialchars($user['otherPreference']); ?></p> 
        </fieldset>

        </div>
    </div> <!-- Closing profile-container here -->
</div>

<!-- Modal for editing profile -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Profile</h2>
        <form id="editForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($user['fullName']); ?>" required> <br>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required> <br>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required> <br>
            
            <button type="submit" name= "submit_personal_details">Update</button>
        </form>
    </div>
</div>
<!-- Modal for editing location -->
<div id="locationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Location</h2>
        <form id="locationForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="state">State:</label>
            <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($user['state']); ?>" required> <br>
            
            <label for="district">District:</label>
            <input type="text" id="district" name="district" value="<?php echo htmlspecialchars($user['district']); ?>" required> <br>
            
            <button type="submit" name="submit_location_details">Update Location</button>
        </form>
    </div>
</div>
<!-- Modal for editing religion and sect -->
<div id="religionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Religion and Sect</h2>
        <form id="religionForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion" value="<?php echo htmlspecialchars($user['religion']); ?>" required> <br>
            
            <label for="sect">Sect:</label>
            <input type="text" id="sect" name="sect" value="<?php echo htmlspecialchars($user['sects']); ?>" required> <br>
            
            <button type="submit" name="submit_religion_details">Update Religion and Sect</button>
        </form>
    </div>
</div>
<!-- Modal for editing hashtags -->
<div id="hashtagsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Hashtags</h2>
        <form id="hashtagsForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="hashtags">Hashtags:</label>
            <textarea id="hashtags" name="hashtags" required><?php echo htmlspecialchars($user['hashtags']); ?></textarea> <br>
            
            <button type="submit" name="submit_hashtags_details">Update Hashtags</button>
        </form>
    </div>
</div>
<!-- Modal for editing family information -->
<div id="familyModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Family Information</h2>
        <form id="familyForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="fatherName">Father's Name:</label>
            <input type="text" id="fatherName" name="fatherName" value="<?php echo htmlspecialchars($user['fatherName']); ?>" required> <br>
            
            <label for="motherName">Mother's Name:</label>
            <input type="text" id="motherName" name="motherName" value="<?php echo htmlspecialchars($user['motherName']); ?>" required> <br>
            
            <label for="siblings">Siblings:</label>
            <input type="text" id="siblings" name="siblings" value="<?php echo htmlspecialchars($user['siblings']); ?>" required> <br>
            
            <label for="familyValues">Family Values:</label>
            <input type="text" id="familyValues" name="familyValues" value="<?php echo htmlspecialchars($user['familyValues']); ?>" required> <br>
            
            <button type="submit" name="submit_family_details">Update Family Information</button>
        </form>
    </div>
</div>
<!-- Modal for editing career information -->
<div id="careerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Career Information</h2>
        <form id="careerForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($user['occupation']); ?>" required> <br>
            
            <label for="companyName">Company Name:</label>
            <input type="text" id="companyName" name="companyName" value="<?php echo htmlspecialchars($user['companyName']); ?>" required> <br>
            
            <label for="annualIncome">Annual Income:</label>
            <input type="number" id="annualIncome" name="annualIncome" value="<?php echo htmlspecialchars($user['annualIncome']); ?>" required> <br>
            
            <label for="education">Education:</label>
            <input type="text" id="education" name="education" value="<?php echo htmlspecialchars($user['education']); ?>" required> <br>
            
            <button type="submit" name="submit_career_details">Update Career Information</button>
        </form>
    </div>
</div>
<!-- Modal for editing partner expectations -->
<div id="partnerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Partner Expectations</h2>
        <form id="partnerForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="minAge">Minimum Age:</label>
            <input type="number" id="minAge" name="Min_age" value="<?php echo htmlspecialchars($user['Min_age']); ?>" required> <br>
            
            <label for="maxAge">Maximum Age:</label>
            <input type="number" id="maxAge" name="Max_age" value="<?php echo htmlspecialchars($user['Max_age']); ?>" required> <br>
            
            <label for="heightPreference">Height Preference:</label>
            <input type="text" id="heightPreference" name="heightPreference" value="<?php echo htmlspecialchars($user['heightPreference']); ?>" required> <br>
            
            <label for="religionPreference">Religion Preference:</label>
            <input type="text" id="religionPreference" name="religionPreference" value="<?php echo htmlspecialchars($user['religionPreference']); ?>" required> <br>
            
            <label for="educationPreference">Education Preference:</label>
            <input type="text" id="educationPreference" name="educationPreference" value="<?php echo htmlspecialchars($user['educationPreference']); ?>" required> <br>
            
            <label for="otherPreference">Other Preferences:</label>
            <input type="text" id="otherPreference" name="otherPreference" value="<?php echo htmlspecialchars($user['otherPreference']); ?>" required> <br>
            
            <button type="submit" name="submit_partner_expectations">Update Partner Expectations</button>
        </form>
    </div>
</div>
<!-- Modal for editing appearance -->
<div id="appearanceModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Appearance</h2>
        <form id="appearanceForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <br>
            
            <label for="height">Height:</label>
            <input type="text" id="height" name="height" value="<?php echo htmlspecialchars($user['height']); ?>" required> <br>
            
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" value="<?php echo htmlspecialchars($user['weight']); ?>" required> <br>
            
            <label for="complexion">Complexion:</label>
            <input type="text" id="complexion" name="complexion" value="<?php echo htmlspecialchars($user['complexion']); ?>" required> <br>
            
            <label for="bodyType">Body Type:</label>
            <input type="text" id="bodyType" name="bodyType" value="<?php echo htmlspecialchars($user['bodyType']); ?>" required> <br>
            
            <button type="submit" name="submit_appearance">Update Appearance</button>
        </form>
    </div>
</div>






<script>
    // Tab functionality
    function openTab(tabName) {
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.style.display = 'none'; // Hide all tabs
        });
        document.getElementById(tabName).style.display = 'block'; // Show selected tab
    }

    // Modal functionality
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }
    function openLocationModal() {
    document.getElementById("locationModal").style.display = "block";
}
    function openReligionModal() {
    document.getElementById("religionModal").style.display = "block";
}
function openHashtagsModal() {
    document.getElementById("hashtagsModal").style.display = "block";
}
function openFamilyModal() {
    document.getElementById("familyModal").style.display = "block";
}
function openCareerModal() {
    document.getElementById("careerModal").style.display = "block";
}
function openPartnerModal() {
    document.getElementById("partnerModal").style.display = "block";
}
function openAppearanceModal() {
    document.getElementById("appearanceModal").style.display = "block";
}






    function closeModal() {
        document.getElementById("myModal").style.display = "none";
        document.getElementById("locationModal").style.display = "none";
        document.getElementById("appearanceModal").style.display = "none";
        document.getElementById("partnerModal").style.display = "none";
        document.getElementById("careerModal").style.display = "none";
        document.getElementById("familyModal").style.display = "none";
        document.getElementById("hashtagsModal").style.display = "none";
        document.getElementById("religionModal").style.display = "none";




    }

    // Close the modal when the user clicks anywhere outside of it
    window.onclick = function(event) {
        const modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
