<?php
session_start();

// Include the configuration file
include '../config/db.php';

// Fetch all users
$result = $conn->query("SELECT user_id, username, email FROM user");

// Handle user deletion
if (isset($_GET['delete'])) {
    $user_id_to_delete = intval($_GET['delete']);
    // Prepare the delete statement
    $delete_query = "DELETE FROM user WHERE user_id = $user_id_to_delete";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('User deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users - Vows and Values</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #ffffff;
        }
        header {
            background-color: #c06169;
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
            background-color: #1e1e1e;
            color: #fff;
            padding: 10px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
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
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #c06169;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            position: relative;
            bottom: 0;
            width: 100%;
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

.toggle-btn:hover {
    background-color: #b04d59; /* Darker shade on hover */
}


        .delete-icon {
            color: red;
            cursor: pointer;
        }
    </style>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const main = document.querySelector('.main');
            sidebar.classList.toggle('hidden');
            main.classList.toggle('shifted');
        }

        function confirmDelete() {
            return confirm('Are you sure you want to delete this user?');
        }
    </script>

</head>
<body>

<header>
    <h1>Manage Users</h1>
</header>

<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<div class="container">
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="view_interests.php">View Interests</a>
        <a href="view_matches.php">View Matches</a>
        <a href="admin_settings.php">Settings</a>
        <div class="logout">
            <a href="adminlogin.php">Logout</a>
        </div>
    </div>

    <div class="main">
        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="?delete=<?php echo $row['user_id']; ?>" class="delete-icon" onclick="return confirmDelete();">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
