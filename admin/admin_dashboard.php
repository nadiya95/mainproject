<?php
session_start();

// Include the configuration file
include '../config/db.php';

// Basic functions to get totals
function getTotalUsers($conn) {
    $result = $conn->query("SELECT COUNT(*) AS total FROM user"); // Assuming a 'users' table
    return $result ? $result->fetch_assoc()['total'] : 0;
}

function getTotalInterests($conn) {
    $result = $conn->query("SELECT COUNT(*) AS total FROM interests"); // Assuming a 'interests' table
    return $result ? $result->fetch_assoc()['total'] : 0;
}

function getTotalMatches($conn) {
    $query = "
    SELECT COUNT(*) AS total 
    FROM interests 
    WHERE status = 'accepted' 
   
";
    $result = $conn->query($query);
    return $result ? $result->fetch_assoc()['total'] : 0;
}

// Fetch necessary data for dashboard stats
$totalUsers = getTotalUsers($conn);
$totalInterests = getTotalInterests($conn);
$totalMatches = getTotalMatches($conn);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a; /* Dark background */
            color: #f0f0f0; /* Light text */
            transition: margin-left 0.3s; /* Smooth transition for sidebar */
        }
        header {
            background-color: #333; /* Darker header */
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
        .container {
            display: flex;
            padding: 20px;
        }
        .sidebar {
            width: 200px;
            background-color: #2c2c2c; /* Sidebar background */
            color: #fff;
            padding: 10px;
            position: fixed;
            height: 100vh;
            overflow: auto;
            transition: transform 0.3s; /* Smooth transition */
            transform: translateX(0); /* Initially visible */
        }
        .sidebar.hidden {
            transform: translateX(-100%); /* Hide sidebar */
        }
        .sidebar h2 {
            text-align: center;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #444; /* Hover effect */
        }
        .main {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s; /* Smooth transition */
        }
        .main.shifted {
            margin-left: 0; /* Shift main content when sidebar is hidden */
        }
        .toggle-btn {
    position: fixed;
    left: 10px;
    top: 10px;
    background-color: #d88a97; /* Lighter shade */
    color: #fff;
    border: none;
    border-radius: 8px; /* Increased border radius for a rounded look */
    padding: 12px 16px; /* Increased padding for larger size */
    font-size: 18px; /* Increased font size for better visibility */
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3); /* Added shadow for better visibility */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}




.toggle-btn:hover {
    background-color: #c06169; /* Darker shade on hover */
}
        .dashboard-header {
            margin-bottom: 20px;
        }
        .dashboard-header h1 {
            margin: 0;
        }
        .card {
            background-color: #3c3c3c; /* Card background */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            padding: 20px;
            margin: 10px;
            text-align: center;
            display: inline-block;
            width: 30%;
            transition: transform 0.3s; /* Adding a hover effect */
        }
        .card:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        .card h3 {
            margin: 0;
            color: #c06169; /* Heading color */
        }
        footer {
            background-color: #333; /* Footer background */
            color: #fff;
            text-align: center;
            padding: 1rem;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<header>
    <h1>Admin Dashboard</h1>
</header>

<div class="container">
    <div class="sidebar" id="sidebar">
        <h2>Admin Menu</h2>
        <a href="manage_users.php">Manage Users</a>
        <a href="view_interests.php">View Interests</a>
        <a href="view_matches.php">View Matches</a>
        <a href="admin_settings.php">Settings</a>
        <div class="logout">
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="main" id="main-content">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h1>
        </div>

        <div class="dashboard-cards" style="display: flex; flex-wrap: wrap;">
            <div class="card">
                <i class="fas fa-user"></i>
                <h3>Total Users</h3>
                <p><?php echo $totalUsers; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-heart"></i>
                <h3>Total Interests</h3>
                <p><?php echo $totalInterests; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Total Matches</h3>
                <p><?php echo $totalMatches; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>


<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        sidebar.classList.toggle('hidden'); // Toggle sidebar visibility
        mainContent.classList.toggle('shifted'); // Shift main content
    }
</script>

</body>
</html>
