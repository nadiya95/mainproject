<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0; /* Remove default margin */
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px; /* Minimized padding for the header */
            background-color: rgba(192, 97, 105, 0.9); /* Slightly transparent header background */
            position: relative; /* Position for the dropdown menu */
            z-index: 1; /* Ensure header stays above other content */
        }

        .logo img {
            width: 80px; /* Adjust the width to a reasonable size */
            height: auto; /* Maintains the aspect ratio */
        }

        nav {
            background-color: rgba(255, 255, 255, 0.8); /* Subtle transparent background for the nav */
            padding: 10px 0; /* Keep padding for a proper height */
            border-radius: 0; /* Sharp corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Slight shadow for depth */
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin-right: 20px; /* Adjusted margin for spacing */
        }

        nav ul li a {
            color: #333; /* Dark text color */
            text-decoration: none;
            padding: 5px; /* Added padding for better click area */
            line-height: 1; /* Minimize line height */
        }

        nav ul li a:hover {
            color: #c06169; /* Accent color on hover */
        }

        .menu-icon {
            display: block;
            cursor: pointer;
            color: #fff; /* White color for the menu icon */
            font-size: 24px; /* Increase the icon size */
            margin-left: 10px; /* Small margin to separate from the nav */
        }

        .menu-popup {
            display: none;
            position: absolute;
            top: 50px;
            right: 10px;
            background-color: #333; /* Dark background for the popup */
            padding: 10px;
            border-radius: 5px;
            z-index: 10; /* Ensures popup is above other content */
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
            color: #fff; /* White text for popup links */
            text-decoration: none;
        }

        .menu-popup ul li a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    <script>
        // JavaScript for toggling the menu
        function toggleMenu() {
            var menu = document.getElementById("menuPopup");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // Close the menu when clicking outside
        window.onclick = function(event) {
            var menu = document.getElementById("menuPopup");
            if (!event.target.matches('.menu-icon') && menu.style.display === "block") {
                menu.style.display = "none";
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
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="search.php"><i class="fas fa-search"></i> Search</a></li>
            <li><a href="matches.php"><i class="fas fa-heart"></i> Matches</a></li>
            <li><a href="notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </nav>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    <div class="menu-popup" id="menuPopup">
        <ul>
            <li><a href="#">Update Account</a></li>
            <li><a href="#">Delete Account</a></li>
            <li><a href="../users/login.html">Log Out</a></li>
        </ul>
    </div>
</header>
</body>
</html>
