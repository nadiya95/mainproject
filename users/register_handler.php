<?php
require_once '../config/db.php';
session_start();

//check if there is register form
if(isset($_POST['register_details'])){

    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmPassword'];
    $email=$_POST['email'];
    $fullName=$_POST['fullName'];
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $religion=$_POST['religion'];
    $sects=$_POST['sects'];
    $state=$_POST['state'];
    $district=$_POST['district'];
    $primaryNum=$_POST['primaryNum'];
    $secondaryNum=$_POST['secondaryNum'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $complexion=$_POST['complexion'];
    $appearance=$_POST['appearance'];
    $bodyType=$_POST['bodyType'];
    $fatherName=$_POST['fatherName'];
    $motherName=$_POST['motherName'];
    $siblings=$_POST['siblings'];
    $familyValues=$_POST['familyValues'];
    $occupation=$_POST['occupation'];
    $companyName=isset($_POST['companyName']) ? $_POST['companyName'] : '';
    $annualIncome=isset($_POST['annualIncome']) ? $_POST['annualIncome'] : '';
    $education= $_POST['education'];
    $bio=$_POST['bio'];
    $hashtags=$_POST['hashtags'];
    $Max_age=$_POST['Max_age'];
    $Min_age=$_POST['Min_age'];
    $heightPreference=$_POST['heightPreference'];
    $religionPreference=$_POST['religionPreference'];
    $educationPreference=isset($_POST['educationPreference']) ? $_POST['educationPreference'] : '';
    $otherPreference=isset($_POST['otherPreference']) ? $_POST['otherPreference'] : '';
    $profilePic=isset($_FILES['profilePic']) ? $_FILES['profilePic']['name'] : '';
    $profileVideo=isset($_FILES['profileVideo']) ? $_FILES['profileVideo']['name'] : '';

  //  print_r($_POST);
    

    //password match
    if($password !== $confirmpassword)
    {
       die('password does not match.');
    }
    if($Max_age < $Min_age)
    {
      die('Enter valid age range. Max age should be greater than min age.');
    }
    // Handle profile picture upload with validation for size
       if (!empty($profilePic)) {
         $targetDir = "uploads/images/";
         $targetFile = $targetDir . basename($_FILES["profilePic"]["name"]);
         $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
 
         // Validate file size (max 2MB)
         if ($_FILES["profilePic"]["size"] > 2000000) {
             echo "Sorry, your profile picture is too large. Maximum size is 2MB.";
             exit();
         }
 
         // Allow only certain file formats
         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             exit();
         }
 
         if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFile)) {
             $profilePic = $targetFile;
             echo "<script>
             console.log('Profile Picture Path: " . addslashes($profilePic) . "');
             </script>";
         } else {
             echo "Sorry, there was an error uploading your profile picture.";
             exit();
         }
     }
      // Handle profile video upload
   if (!empty($_FILES["profileVideo"]["name"]))
 {
   $profileVideo = $_FILES["profileVideo"];
   $targetDir = "uploads/videos/";
   $targetFile = $targetDir . basename($profileVideo["name"]);

   // Set a size limit (e.g., 10MB)
   $maxFileSize = 100 * 1024 * 1024; // 100B in bytes

   // Allowed MIME types for video files
   $allowedTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/mpeg'];

   // Check the file size
   if ($profileVideo["size"] > $maxFileSize) {
       echo "The video file is too large. Max file size is 100  MB.";
       exit();
   }

   // Check the MIME type
   $fileType = mime_content_type($profileVideo["tmp_name"]);
   if (!in_array($fileType, $allowedTypes)) {
       echo "Invalid file type. Only MP4, AVI, MOV, and MPEG videos are allowed.";
       exit();
   }

   // If size and type are valid, proceed to move the file
   if (move_uploaded_file($profileVideo["tmp_name"], $targetFile)) {
       $profileVideo = $targetFile; // File successfully uploaded

   } else {
       echo "Sorry, there was an error uploading your video.";
       exit();
   }
 }
  // Store form values in session variables
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['password']=$password;
  $_SESSION['confirmPassword']=$confirmpassword;
  $_SESSION['fullName'] = $fullName;
  $_SESSION['dob'] = $dob;
  $_SESSION['age']=$age;
  $_SESSION['gender'] = $gender;
  $_SESSION['religion'] = $religion;
  $_SESSION['sects'] = $sects;
  $_SESSION['state'] = $state;
  $_SESSION['district'] = $district;
  $_SESSION['primaryNum'] = $primaryNum;
  $_SESSION['secondaryNum'] = $secondaryNum;
  $_SESSION['height'] = $height;
  $_SESSION['weight'] = $weight;
  $_SESSION['complexion'] = $complexion;
  $_SESSION['appearance'] = $appearance;
  $_SESSION['bodyType'] = $bodyType;
  $_SESSION['fatherName'] = $fatherName;
  $_SESSION['motherName'] = $motherName;
  $_SESSION['siblings'] = $siblings;
  $_SESSION['familyValues'] = $familyValues;
  $_SESSION['occupation']=$occupation;
  $_SESSION['companyName'] = $companyName;
  $_SESSION['annualIncome'] = $annualIncome;
  $_SESSION['education'] = $education;
  $_SESSION['bio'] = $bio;
  $_SESSION['profilePic']=$profilePic;
  $_SESSION['profileVideo']=$profileVideo;
  $_SESSION['hashtags'] = $hashtags;
  $_SESSION['Max_age'] = $Max_age;
  $_SESSION['Min_age'] = $Min_age;
  $_SESSION['heightPreference'] = $heightPreference;
  $_SESSION['religionPreference'] = $religionPreference;
  $_SESSION['educationPreference'] = $educationPreference;
  $_SESSION['otherPreference'] = $otherPreference;

  var_dump($_SESSION);

    
    if(UsernameExists($username) || emailExists($email))
     {
        die('username or email already exists');
     }
      header("Location: quiz.php");
     exit();
   /* else{ 
           global $conn;
           $sql="INSERT INTO user(username,password,email,fullName,dob,gender,religion,sects,state,district,primaryNo,secondaryNo,height,weight,complexion,appearance,bodyType,fatherName,motherName,siblings,familyValues,companyName,annualIncome,education,bio,profilePic,profileVideo,hashtags,Max_age,Min_age,heightPreference,religionPreference,educationPreference,otherPreference)VALUES ('$username','$password','$email','$fullName','$dob','$gender','$religion','$sects','$state','$district','$primaryNum','$secondaryNum','$height','$weight','$complexion','$appearance','$bodyType','$fatherName','$motherName','$siblings','$familyValues','$companyName','$annualIncome','$education','$bio','$profilePic','$profileVideo','$hashtags','$Max_age','$Min_age','$heightPreference','$religionPreference','$educationPreference','$otherPreference')";
           if (mysqli_query($conn,$sql))
           {
            echo "<script>alert('Registration successful!');</script>";
            header("Location: ../users/login.html");
            exit(); 
           }
        else 
          {
            echo "<script>alert('Error inserting into database');</script>";
          }
    
        }
    */
}
else {
       die('no register form has been submitted');
     }    
function UsernameExists($username){
    global $conn;
    $sql="SELECT * from user where username='$username'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
           return true;
          else
           return false;
        }

function emailExists($email){
    global $conn;
    $sql="SELECT * from user where email='$email'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
           return true;
          else
           return false;
}
?>