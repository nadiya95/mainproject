<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vows and Values</title>
    <link rel="stylesheet" href="frontpg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #f4c2ac; /* Example background color */
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            text-decoration: none;
            color: #333; /* Text color */
            padding: 10px 15px;
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #a05257; /* Hover color */
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>


    <section class="homepage-banner">
        <div class="banner-content">
            <h1>At Vows and Values, we connect hearts with meaning. Find your match now!</h1>
            <a href="#explore" class="find-button">Find</a>
        </div>
    </section>

    <main>
        <div class="activity-log">
            <h2>Activity Logs</h2>
            <div class="tabs">
                <button id="receivedBtn" onclick="showReceived()">Received</button>
                <button id="sentBtn" onclick="showSent()">Sent</button>
            </div>
            <div id="receivedRequests" class="requests">
                <!-- Received profiles go here -->
                <div class="profile-container">
                    <img src="../profiles/p1.jpg" alt="Profile 1">
                    <span>Name 1</span>
                </div>
                <div class="profile-container">
                    <img src="../profiles/p2.jpg" alt="Profile 2">
                    <span>Name 2</span>
                </div>
                <div class="profile-container">
                    <img src="../profiles/p3.jpg" alt="Profile 3">
                    <span>Name 3</span>
                </div>
            </div>
            <div id="sentRequests" class="requests" style="display:none;">
                <!-- Sent profiles go here -->
                <div class="profile-container">
                    <img src="../profiles/p4.jpg" alt="Profile 4">
                    <span>Name 4</span>
                </div>
                <div class="profile-container">
                    <img src="../profiles/p5.jpg" alt="Profile 5">
                    <span>Name 5</span>
                </div>
                <div class="profile-container">
                    <img src="../profiles/p7.jpg" alt="Profile 6">
                    <span>Name 6</span>
                </div>
            </div>
        </div>
        <div class="profiles-section">
            <h2>Profiles</h2>
            <div class="profile-container">
                <img src="../profiles/p6.jpg" alt="Profile 1">
                <span>Name 1</span>
            </div>
            <div class="profile-container">
                <img src="../profiles/p8.jpg" alt="Profile 2">
                <span>Name 2</span>
            </div>
            <div class="profile-container">
                <img src="../profiles/pf1.jpg" alt="Profile 3">
                <span>Name 3</span>
            </div>
        </div>
    </main>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menuPopup");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        function showReceived() {
            document.getElementById('receivedRequests').style.display = 'block';
            document.getElementById('sentRequests').style.display = 'none';
        }

        function showSent() {
            document.getElementById('receivedRequests').style.display = 'none';
            document.getElementById('sentRequests').style.display = 'block';
        }
    </script>
    <footer>
        <p>&copy; 2024 Vows and Values. All Rights Reserved.</p>
    </footer>
    
</body>
</html>
