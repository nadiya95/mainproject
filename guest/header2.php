<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #c06169;
    position: fixed; /* Fix the header at the top */
    top: 0; /* Align it to the top of the viewport */
    width: 100%; /* Ensure it takes the full width */
    z-index: 1000; /* Keep it above other content */
}

body {
    margin: 0; /* Remove default body margin */
    padding-top: 60px; /* Add padding to prevent content from hiding under the header */
}


        .logo img {
            width: 100px; /* Adjust the width to a reasonable size */
            height: auto; /* Maintains the aspect ratio */
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .menu-icon {
            display: block;
            cursor: pointer;
        }

        .menu-popup {
            display: none;
            position: absolute;
            top: 50px;
            right: 20px;
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
        }

        .menu-popup ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu-popup ul li {
            margin-bottom: 10px;
        }

        .menu-popup ul li a {
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .menu-popup ul li a:hover {
            background-color: #c06169; /* Change this to your desired hover color */
            padding: 5px 10px; /* Add some padding for better hover effect */
            border-radius: 3px; /* Round the corners on hover */
        }
    </style>
    <script>
        // JavaScript for toggling the menu
        function toggleMenu() {
            var menu = document.getElementById("menuPopup");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }
        
        // JavaScript for exit confirmation
        function confirmExit() {
            if (confirm("Do you want to exit?")) {
                window.location.href = "../users/login.html"; // Redirect to logout handler
            }
        }
    </script>
</head>
<body>
<header>
    <div class="logo">
        <img src="" alt="Vows and Values Logo">
    </div>
    <nav>
        <ul>
            <li><a href="guest_page.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="../guest/gsearch.php"><i class="fas fa-search"></i> Search</a></li>
            <li><a href="../guest/gmatch.php"><i class="fas fa-heart"></i> Matches</a></li>
            <li><a href="../guest/gAboutus.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="sign_up.php"><i class="fas fa-user-plus"></i> Sign Up</a></li>
        </ul>
    </nav>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    <div class="menu-popup" id="menuPopup">
        <ul>
            <li><a href="sign_up.php">Sign up</a></li>
            <li><a href="#" onclick="confirmExit()"><i class="fas fa-sign-out-alt"></i> Exit</a></li>
        </ul>
    </div>
 
</header>
</body>
</html>
