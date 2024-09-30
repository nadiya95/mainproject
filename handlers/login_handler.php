<?php
require_once '../config/db.php';
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    global $conn;
    $sql= "SELECT * FROM user where username='$username'";
    if(mysqli_query($conn,$sql)){
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            echo "<script> alert('username exists!'); </script>";
            $row = mysqli_fetch_assoc($result);
            // Verify the password
            if ($password === $row['password']){
              if($email == $row['email']) {
                echo "<script> alert('Login successful!'); </script>";
                header("Location: ../homepage/index.php");
                //session
                 } 
              else {
                echo "<script> alert('Incorrect Email'); </script>";
              //  header("location: ../users/login.html");
                   }
            }
            else {
                  echo "<script> alert('Incorrect password'); </script>";
               //   header("location: ../users/login.html");
                 }
        }
        else {
            echo "<script>alert('Username not exist.Enter valid username.'); </script>";
           // header("location: ../users/login.html");
        }
    }
    else{
        echo "<script> alert('Error connecting to database'); </script>";
    }

}
else
 { echo "<script> alert('No login form has been submitted'); </script>";
 }
 ?>