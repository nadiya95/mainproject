<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('image1.jpg'); /* Replace with your background image path */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the image */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white; /* Change text color to white for better contrast */
        }

        .banner {
            text-align: center;
            color: #c06169; /* Change text color for better visibility */
            font-size: 24px;
            margin: 20px 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Optional: Add shadow for better readability */
        }

        .signup-button {
            background-color: #c06169;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .signup-button:hover {
            background-color: #a0525b; /* Darker shade for hover effect */
        }
    </style>
</head>
<body>

<?php include 'header2.php'; ?>

<div class="banner">
    Discover Your Heart’s Desire – Register Now!
</div>

<a href="../users/register.php">
    <button class="signup-button">Sign Up</button>
</a>

</body>
</html>
