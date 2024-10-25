<?php
session_start();
include '../config/db.php';

// Fetch interests from the database
$query = "SELECT sender, receiver, status, created_at FROM interests ORDER BY created_at DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Interests - Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #181818; /* Dark background */
            color: #f0f0f0; /* Light text */
        }
        header {
            background-color: #c06169; /* Your primary color */
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
            background-color: #222; /* Dark sidebar */
            color: #fff;
            padding: 10px;
            position: fixed;
            height: 100vh;
            overflow: auto;
            transition: transform 0.3s ease;
            transform: translateX(0);
        }
        .sidebar.hidden {
            transform: translateX(-100%);
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
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .main {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s ease;
        }
        .main.shifted {
            margin-left: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #444; /* Darker border */
        }
        th {
            background-color: #c06169;
        }
        tr:nth-child(even) {
            background-color: #2a2a2a; /* Alternate row color */
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
    </style>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const main = document.querySelector('.main');
            sidebar.classList.toggle('hidden');
            main.classList.toggle('shifted');
        }
    </script>

</head>
<body>

<header>
    <h1>View Interests</h1>
</header>

<!-- Toggle button to hide/show sidebar -->
<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<div class="container">
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="admin_dashboard.php">Dashboard </a>
        <a href="manage_users.php">Manage Users</a>
        <a href="view_interests.php">View Interests</a>
        <a href="view_matches.php">View Matches</a>
        <a href="admin_settings.php">Settings</a>
        <div class="logout">
            <a href="adminlogin.php">Logout</a>
        </div>
    </div>

    <div class="main">
        <h2>Interests List</h2>
        <table>
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['sender']}</td>
                                <td>{$row['receiver']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['created_at']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No interests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
