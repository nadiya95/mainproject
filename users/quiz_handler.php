<?php
require_once '../config/db.php';
session_start();
if(isset($_POST['previous'])){
    echo "<script>alert('Previous button clicked');</script>";
    header('Location: register.php');
    exit();
}
//handle form submission
if(isset($_POST['register'])){

   $username = $_SESSION['username'];
   $email = $_SESSION['email'];
   $password = $_SESSION['password'];
   $confirmpassword = $_SESSION['confirmPassword'];
   $fullName = $_SESSION['fullName'];
   $dob = $_SESSION['dob'];
   $gender = $_SESSION['gender'];
   $religion = $_SESSION['religion'];
   $sects = $_SESSION['sects'];
   $state = $_SESSION['state'];
   $district = $_SESSION['district'];
   $primaryNum = $_SESSION['primaryNum'];
   $secondaryNum = $_SESSION['secondaryNum'];
   $height = $_SESSION['height'];
   $weight = $_SESSION['weight'];
   $complexion = $_SESSION['complexion'];
   $appearance = $_SESSION['appearance'];
   $bodyType = $_SESSION['bodyType'];
   $fatherName = $_SESSION['fatherName'];
   $motherName = $_SESSION['motherName'];
   $siblings = $_SESSION['siblings'];
   $familyValues = $_SESSION['familyValues'];
   $occupation = $_SESSION['occupation'];
   $companyName = $_SESSION['companyName'];
   $annualIncome = $_SESSION['annualIncome'];
   $education = $_SESSION['education'];
   $bio = $_SESSION['bio'];
   $profilePic = $_SESSION['profilePic'];
   $profileVideo = $_SESSION['profileVideo'];
   $hashtags = $_SESSION['hashtags'];
   $Max_age = $_SESSION['Max_age'];
   $Min_age = $_SESSION['Min_age'];
   $heightPreference = $_SESSION['heightPreference'];
   $religionPreference = $_SESSION['religionPreference'];
   $educationPreference = $_SESSION['educationPreference'];
   $otherPreference = $_SESSION['otherPreference'];
   $personalityDescription=$_POST['personalityDescription'];
   $compatibleDescriptions=$_POST['compatibleDescriptions'];
   $personalityType=$_POST['personalityType'];

   print_r($_POST);

   echo $compatibleDescriptions;
   echo $personalityType;
   
   //insert into database
   global $conn;
   $sql="INSERT INTO user(username,password,email,fullName,dob,gender,religion,sects,state,district,primaryNo,secondaryNo,height,weight,complexion,appearance,bodyType,fatherName,motherName,siblings,familyValues,occupation,companyName,annualIncome,education,bio,profilePic,profileVideo,hashtags,Max_age,Min_age,heightPreference,religionPreference,educationPreference,otherPreference)VALUES ('$username','$password','$email','$fullName','$dob','$gender','$religion','$sects','$state','$district','$primaryNum','$secondaryNum','$height','$weight','$complexion','$appearance','$bodyType','$fatherName','$motherName','$siblings','$familyValues','$occupation','$companyName','$annualIncome','$education','$bio','$profilePic','$profileVideo','$hashtags','$Max_age','$Min_age','$heightPreference','$religionPreference','$educationPreference','$otherPreference')";
   
if (mysqli_query($conn, $sql)) 
  {
    $user_id = mysqli_insert_id($conn); 

    //personality insert query
    $sql1 = "INSERT INTO personality (user_id, personality_type, personality_description, compatibility_description) 
             VALUES ('$user_id', '$personalityType', '$personalityDescription', '$compatibleDescriptions')";

    // Execute personality insert
    if (mysqli_query($conn, $sql1)) {
        echo "<script>alert('Registration successful!');</script>";
        session_unset();
        session_destroy();
        header("Location: ../users/login.html");
        exit(); 
    } else {
        echo "<script>alert('Personality data not inserted');</script>";
    }
  } else {
    echo "<script>alert('User data not inserted');</script>";
      }

} else {
    echo "<script>alert('no form submitted');</script>";
   }
?> 
