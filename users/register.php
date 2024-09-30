<?php
session_start();
include '../config/db.php'; // Your database connection file
global $conn;
$query = "SELECT state_id, state_name FROM states";
$result = mysqli_query($conn, $query);

$states = [];
while ($row = mysqli_fetch_assoc($result)) {
    $states[] = $row;
}

// print_r($_SESSION);

$selectedState = $_SESSION['state'] ?? '';
$selectedDistrict = $_SESSION['district'] ?? '';

if ($selectedState != '') {
    $districts = getDistrict($selectedState, $conn);
}

function getDistrict($selectedState, $conn): array {
    $districts = [];
    if ($selectedState) {
        // First Query: Get the state_id based on the state_name
        $query1 = "SELECT state_id FROM states WHERE state_name = '$selectedState'";
        $result1 = mysqli_query($conn, $query1);

        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $state_id = $row['state_id'];

            // Second Query: Get the districts based on the state_id
            $query2 = "SELECT district_id, district_name FROM districts WHERE state_id = $state_id";
            $result2 = mysqli_query($conn, $query2);
            while ($row = mysqli_fetch_assoc($result2)) {
                $districts[] = $row;
            }
        }
    }
    return $districts;
}

$sectOptions = [
    'islam' => [
        'Sunni', 'Sunni (EK)', 'Sunni (AP)', 'Salafi', 'Shia', 'Other'
    ],
    'hinduism' => [
        'Shaiva', 'Shakta', 'Vaishnava', 'Smarta', 'Other'
    ],
    'christianity' => [
        'Catholic', 'Protestant', 'Orthodox', 'Anglican', 'Other'
    ]
];

$selectedReligion = $_SESSION['religion'] ?? '';
$selectedSect = $_SESSION['sects'] ?? '';

?>
<html> 
    <head>
        <title> Sign up </title>
        <link rel="stylesheet" href="../css/register.css">
    </head>
    <body>
     <div class="container">
        <form action="register_handler.php" method="post" enctype="multipart/form-data">
            <h1> Sign up</h1>
            <fieldset>
                <legend>Account info:</legend>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" placeholder="Enter password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" required>
                <label for="confirmPassword">confirmPassword:</label>
                <input type="text" name="confirmPassword" placeholder="confirmPassword" value="<?php echo isset($_SESSION['confirmPassword']) ? $_SESSION['confirmPassword'] : ''; ?>" required>
            </fieldset>
            <fieldset>
                <legend>Personal Information</legend>
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo isset($_SESSION['fullName']) ? $_SESSION['fullName'] : ''; ?>" required>
                
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo isset($_SESSION['dob']) ? $_SESSION['dob'] : ''; ?>" required>
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" min="18" max="100">
                <?php $GENDER= isset($_SESSION['gender']) ? $_SESSION['gender'] : ''; ?>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male" <?php echo $GENDER=='male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo $GENDER=='female' ? 'selected' : ''; ?>>Female</option>
                </select>

                <label for="religion">Religion:</label>
                <select id="religion" name="religion">
                    <option value="">Select Religion</option>
                    <option value="islam" <?= ($selectedReligion === 'islam') ? 'selected' : '' ?>>Islam</option>
                    <option value="hinduism" <?= ($selectedReligion === 'hinduism') ? 'selected' : '' ?>>Hinduism</option>
                    <option value="christianity" <?= ($selectedReligion === 'christianity') ? 'selected' : '' ?>>Christianity</option>
                </select>
        
                <label for="sects" id="sectLabel">Sect:</label>
                <select id="sects" name="sects">
                    <option value="">Select Sect</option>
                    <?php
                    foreach ($sectOptions[$selectedReligion] as $sect) {
                        $isSelected = ($selectedSect === strtolower($sect)) ? 'selected' : '';
                        echo "<option value=\"" . strtolower($sect) . "\" $isSelected>$sect</option>";
                    }
                    ?>
                </select>
            </fieldset>    
                  <!-- location -->
            <fieldset>
                <legend>Location</legend>
                <label for="state">State:</label>
                <select id="state" name="state" required>
                    <option value="">Select State</option>
                    <?php
                        $selectedState = $_SESSION['state'] ?? '';
                        foreach ($states as $state) {
                            $stateName = $state['state_name'];
                            $isSelectedState = ($selectedState == $stateName) ? 'selected' : '';
                            // echo "State ID: $stateId, Selected State: $selectedState, Is Selected: $isSelected<br>";
                            echo "<option value=\"$stateName\" $isSelectedState>$stateName</option>";
                        }
                    ?>
                </select>
                
                <label for="district">District:</label>
                <select id="district" name="district" required>
                    <option value="">Select District</option>
                    <?php
                        foreach ($districts as $district) {
                            $districtName = $district['district_name'];
                            $isSelected_d = ($selectedDistrict == $districtName) ? 'selected' : '';
                            echo "<option value=\"$districtName\" $isSelected_d>$districtName</option>";
                        }
                    ?>
                </select>
            </fieldset>
            <fieldset>
                <!--contact info-->
                <legend>Contact-Info:</legend>
                <label for="primaryNum">Primary contact no.:</label>
                <input type="tel" id="primaryNum" name="primaryNum" pattern="[0-9]{10}" value="<?php echo isset($_SESSION['primaryNum']) ? $_SESSION['primaryNum'] : ''; ?>" required>

                <label for="secondaryNum">Secondary contact no.:</label>
                <input type="tel" id="secondaryNum" name="secondaryNum" pattern="[0-9]{10}" value="<?php echo isset($_SESSION['secondaryNum']) ? $_SESSION['secondaryNum'] : ''; ?>" required>

            </fieldset>
            <fieldset>
              <legend> Appearance </legend>
               <label for="height">Height(cm):</label>
               <input type="number" id="height" name="height" min="100" max="300" placeholder="Enter height in cm" value="<?php echo isset($_SESSION['height']) ? $_SESSION['height'] : ''; ?>" required>
               <label for="weight">Weight(kg):</label>
               <input type="number" id="weight" name="weight" min="25" max="100" value="<?php echo isset($_SESSION['weight']) ? $_SESSION['weight'] : ''; ?>" required>
               <label for="complexion">Complexion:</label>
               <!-- //get complexion -->
               <?php $cmplx=isset($_SESSION['complexion']) ? $_SESSION['complexion'] : ''; ?>
               <select name="complexion" id="complexion">
               <option value="fair" <?php echo $cmplx=='fair' ? 'selected' : ''; ?>>Fair</option>
               <option value="wheatish" <?php echo $cmplx=='wheatish' ? 'selected' : ''; ?>>wheatish</option>
               <option value="olive" <?php echo $cmplx=='olive' ? 'selected' : ''; ?>>olive</option>
               <option value="light" <?php echo $cmplx=='light' ? 'selected' : ''; ?>>Light</option>
               <option value="medium" <?php echo $cmplx=='medium' ? 'selected' : ''; ?>>medium</option>
               <option value="dark" <?php echo $cmplx=='dark' ? 'selected' : ''; ?>>dark</option>
               </select>
               <label for="appearance">Appearance:</label>

               <?php $appearance=isset($_SESSION['appearance']) ? $_SESSION['appearance'] : ''; ?>

               <select id="appearance" name="appearance">
                <option value="VeryAttractive" <?php echo $appearance=='VeryAttractive' ? 'selected' : '';?>>Very Attractive</option>
                <option value="attractive" <?php echo $appearance=='attractive' ? 'selected' : ''; ?>>Attractive</option>
                <option value="average" <?php echo $appearance=='average' ? 'selected' : ''; ?>>Average</option>
               </select>
               <label for="bodyType">Body Type:</label>

               <?php $bodyType=isset($_SESSION['bodyType']) ? $_SESSION['bodyType'] : ''; ?>
               <select id="bodyType" name="bodyType" required>
                   <option value="slim" <?php echo $bodyType=='slim' ? 'selected' : ''; ?>>Slim</option>
                   <option value="athletic" <?php echo $bodyType=='athletic' ? 'selected' : ''; ?>>Athletic</option>
                   <option value="average" <?php echo $bodyType=='average' ? 'selected' : ''; ?>>Average</option>
                   <option value="heavy" <?php echo $bodyType=='heavy' ? 'selected' : ''; ?>>Heavy</option>
               </select>
           </fieldset>
              
            <!-- Family -->
            <fieldset>
                <legend>Family</legend>
                <label for="fatherName">Father's Name:</label>
                <input type="text" id="fatherName" name="fatherName" value="<?php echo isset($_SESSION['fatherName']) ? $_SESSION['fatherName'] : ''; ?>" required>
                
                <label for="motherName">Mother's Name:</label>
                <input type="text" id="motherName" name="motherName" value="<?php echo isset($_SESSION['motherName']) ? $_SESSION['motherName'] : ''; ?>" required>
                
                <label for="siblings">Siblings:</label>
                <input type="number" id="siblings" name="siblings" value="<?php echo isset($_SESSION['siblings']) ? $_SESSION['siblings'] : ''; ?>"required>
                
                <label for="familyValues">Family Values:</label>

                <?php $familyValues=isset($_SESSION['familyValues']) ? $_SESSION['familyValues'] : ''; ?>
                <select id="familyValues" name="familyValues" required>
                    <option value="traditional" <?php echo $familyValues=='traditional' ? 'selected' : ''; ?> >Traditional</option>
                    <option value="moderate" <?php echo $familyValues=='moderate' ? 'selected' : ''; ?>>Moderate</option>
                    <option value="liberal" <?php echo $familyValues=='liberal' ? 'selected' : ''; ?>>Liberal</option>
                </select>
            </fieldset>

                 
            <!-- Profession -->
            <fieldset>
                <legend>Profession</legend>
               <label for="occupation">Occupation:</label>
               <!-- //get occupation -->
               <?php $occupation=isset($_SESSION['occupation']) ? $_SESSION['occupation'] : ''; ?>
                <select id="occupation" name="occupation" required>
                <option value="accountant" <?php echo $occupation=='accountant' ? 'selected' : ''; ?>>Accountant</option>
                <option value="architect" <?php echo $occupation=='architect' ? 'selected' : ''; ?>>Architect</option>
                <option value="artist" <?php echo $occupation=='artist' ? 'selected' : ''; ?>>Artist</option>
                <option value="business_owner" <?php echo $occupation=='business_owner' ? 'selected' : ''; ?>>Business Owner</option>
                <option value="consultant" <?php echo $occupation=='consultant' ? 'selected' : ''; ?>>Consultant</option>
                <option value="doctor" <?php echo $occupation=='doctor' ? 'selected' : ''; ?>>Doctor</option>
                <option value="engineer" <?php echo $occupation=='engineer' ? 'selected' : ''; ?>>Engineer</option>
                <option value="entrepreneur" <?php echo $occupation=='entrepreneur' ? 'selected' : ''; ?>>Entrepreneur</option>
                <option value="government_employee" <?php echo $occupation=='government_employee' ? 'selected' : ''; ?>>Government Employee</option>
                <option value="graphic_designer" <?php echo $occupation=='graphic_designer' ? 'selected' : ''; ?>>Graphic Designer</option>
                <option value="it_professional" <?php echo $occupation=='it_professional' ? 'selected' : ''; ?>>IT Professional</option>
                <option value="lawyer" <?php echo $occupation=='lawyer' ? 'selected' : ''; ?>>Lawyer</option>
                <option value="lecturer" <?php echo $occupation=='lecturer' ? 'selected' : ''; ?>>Lecturer</option>
                <option value="marketing_professional" <?php echo $occupation=='marketing_professional' ? 'selected' : ''; ?>>Marketing Professional</option>
                <option value="nurse" <?php echo $occupation=='nurse' ? 'selected' : ''; ?>>Nurse</option>
                <option value="pharmacist" <?php echo $occupation=='pharmacist' ? 'selected' : ''; ?>>Pharmacist</option>
                <option value="pilot" <?php echo $occupation=='pilot' ? 'selected' : ''; ?>>Pilot</option>
                <option value="professor" <?php echo $occupation=='professor' ? 'selected' : ''; ?>>Professor</option>
                <option value="researcher" <?php echo $occupation=='researcher' ? 'selected' : ''; ?>>Researcher</option>
                <option value="sales_executive" <?php echo $occupation=='sales_executive' ? 'selected' : ''; ?>>Sales Executive</option>
                <option value="scientist" <?php echo $occupation=='scientist' ? 'selected' : ''; ?>>Scientist</option>
                <option value="self_employed" <?php echo $occupation=='self_employed' ? 'selected' : ''; ?>>Self-employed</option>
                <option value="software_developer" <?php echo $occupation=='software_developer' ? 'selected' : ''; ?>>Software Developer</option>
                <option value="student" <?php echo $occupation=='student' ? 'selected' : ''; ?>>Student</option>
                <option value="teacher" <?php echo $occupation=='teacher' ? 'selected' : ''; ?>>Teacher</option>
                <option value="writer" <?php echo $occupation=='writer' ? 'selected' : ''; ?>>Writer</option>
                <option value="other" <?php echo $occupation=='other' ? 'selected' : ''; ?>>Other</option>

                </select>
                <label for="companyName">Company Name(optional):</label>
                <input type="text" id="companyName" name="companyName" value="<?php echo isset($_SESSION['companyName']) ? $_SESSION['companyName'] : ''; ?>">
                
                <label for="annualIncome">Annual Income(optionl):</label>
                <!-- //get annualIncome -->
                <?php $annualIncome=isset($_SESSION['annualIncome']) ? $_SESSION['annualIncome'] : ''; ?>
                <select id="annualIncome" name="annualIncome">
                    <option value="Below_1L" <?php echo $annualIncome=='Below_1L' ? 'selected' : ''; ?>>Below 1Lakh</option>
                    <option value="1Lakh" <?php echo $annualIncome=='1Lakh' ? 'selected' : ''; ?>>1 Lakh</option>
                    <option value="2-4Lakh" <?php echo $annualIncome=='2-4Lakh' ? 'selected' : ''; ?>>2-4Lakh</option>
                    <option value="Above_4Lakh" <?php echo $annualIncome=='Above_4Lakh' ? 'selected' : ''; ?>>Above 4 lakh</option>
                </select>
                
                <label for="education">Education:</label>
                
                <?php $education=isset($_SESSION['education']) ? $_SESSION['education'] : ''; ?>
                <select id="education" name="education" required>
                    <option value="PG" <?php echo $education=='PG' ? 'selected' : '';?>>Post graduate</option>
                    <option value="UG"  <?php echo $education=='UG' ? 'selected' : '';?>>Under graduate</option>
                    <option value="Higher_secondary" <?php echo $education=='Higher_secondary' ? 'selected' : '';?> >Higher_secondary</option>
                    <option value="High_school"  <?php echo $education=='High_school' ? 'selected' : '';?>>High school</option>
                </select>    
            </fieldset>

            <!-- About You -->
            <fieldset>
                <legend>About You</legend>

               <label for="bio">Bio:</label>
               <textarea id="bio" name="bio" rows="4" required><?php echo isset($_SESSION['bio']) ? htmlspecialchars($_SESSION['bio'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>

                <label for="profilePic">Profile pic:</label>
            <input type="file" id="profilePic" name="profilePic">
            
            <?php if (isset($_SESSION['profilePic'])): ?>
                <p>Current Profile Picture:</p>
                <img src="<?php echo htmlspecialchars($_SESSION['profilePic']); ?>" alt="Profile Picture" style="max-width: 200px;">
            <?php endif; ?>
            <p></p> 
            <label for="profileVideo">Profile Video:</label>
            <input type="file" id="profileVideo" name="profileVideo">
            
            <?php if (isset($_SESSION['profileVideo'])): ?>
                <p>Current Profile Video:</p>
                <video controls style="max-width: 200px;">
                    <source src="<?php echo htmlspecialchars($_SESSION['profileVideo']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>

            <p></p> 
            <label for="hashtags">Hashtags:</label>
            <input type="text" id="hashtags" name="hashtags"  pattern="^#[A-Za-z0-9_]+( #[A-Za-z0-9_]+)*$" 
            placeholder="#example #hashtag" 
            title="Enter hashtags starting with #, separated by spaces (e.g., #example #hashtag)" value="<?php echo isset($_SESSION['hashtags']) ? $_SESSION['hashtags'] : ''; ?>" required>

            </fieldset>    
               <!-- Partner Expectations -->
            <fieldset>
                <legend>Partner Expectations</legend>
                <b>Age Range</b> <br>
                <label for="Max_age">Maximum age:</label>
                <input type="number" id="Max_age" name="Max_age" min="18" max="60" value="<?php echo isset($_SESSION['Max_age']) ? $_SESSION['Max_age'] : ''; ?>"required>
                <label for="Min_age">Minimum age:</label>
                <input type="number" id="Min_age" name="Min_age" min="18" max="60" value="<?php echo isset($_SESSION['Min_age']) ? $_SESSION['Min_age'] : ''; ?>"required>
                
                <label for="heightPreference">Height Preference:</label>
                <input type="number" id="heightPreference" name="heightPreference" min="30" max="300" value="<?php echo isset($_SESSION['heightPreference']) ? $_SESSION['heightPreference'] : ''; ?>"required>
                
                <label for="religionPreference">Religion:</label>
               <input type="text" id="religionPreference" name="religionPreference" value="<?php echo isset($_SESSION['religionPreference']) ? $_SESSION['religionPreference'] : ''; ?>" required>
                
                <label for="educationPreference">Education:</label>
                <input type="text" id="educationPreference" name="educationPreference" value="<?php echo isset($_SESSION['educationPreference']) ? $_SESSION['educationPreference'] : ''; ?>">

               <label for="otherPreference">Other Preferences:</label>
               <textarea id="otherPreference" name="otherPreference" rows="3"><?php echo isset($_SESSION['otherPreference']) ? htmlspecialchars($_SESSION['otherPreference'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>

            </fieldset>
            
              <button type="submit" name="register_details">Next</button>
        </form>
     </div>
    <script src="register.js"></script>
    </body>
</html>