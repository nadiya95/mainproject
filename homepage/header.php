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
}
  
    </style>
    <script>
        // JavaScript for toggling the menu
        function toggleMenu() {
            var menu = document.getElementById("menuPopup");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
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
            <li><a href="../homepage/index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="../homepage/search.php"><i class="fas fa-search"></i> Search</a></li>
            <li><a href="../homepage/match2.php"><i class="fas fa-heart"></i> Matches</a></li>
            <li><a href="../homepage/notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="../homepage/about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="../homepage/profile_update.php"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </nav>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    <div class="menu-popup" id="menuPopup"> 
    <ul>
        <li><a href="profile_update.php">Update Account</a></li>
        <li><a href="#" onclick="confirmDelete()">Delete Account</a></li>
        <li><a href="../homepage/logout.php">Log Out</a></li>

    </ul>
    </div>
    <script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this account?")) {
            window.location.href = "../handlers/delete_handler.php"; // Redirect to delete handler
        }
    }
</script>
</header>
