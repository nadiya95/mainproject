<?php
session_start();
include '../config/db.php';

// Fetch the current admin's username from the session
if (isset($_SESSION['admin_username'])) {
    $admin_username = $_SESSION['admin_username'];
} else {
    die('Admin username not found in session.');
}

// Fetch the current admin's username and password from the database
$query = "SELECT id, username, password FROM admin WHERE username = '$admin_username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $current_admin = mysqli_fetch_assoc($result);
    $current_admin_id = $current_admin['id'];
} else {
    die('Admin not found.');
}

// Handle form submission for updating username and password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the request is for account update or deletion
    if (isset($_POST['update'])) {
        $new_username = $_POST['username'];
        $current_password_input = trim($_POST['current_password']);
        $new_password = $_POST['new_password'];

        // Check if the current password is correct
        if ($current_password_input === trim($current_admin['password'])) {
            // Update the username and password
            $update_query = "UPDATE admin SET username = '$new_username', password = '$new_password' WHERE id = '$current_admin_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Account updated successfully!'); window.location.href = 'admin_dashboard.php';</script>";
                exit(); // Make sure to exit after the redirect
            } else {
                echo "<script>alert('Error updating account: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
        }
    }

    // Handle account deletion
    if (isset($_POST['delete_account'])) {
        // Execute the delete query
        $delete_query = "DELETE FROM admin WHERE id = '$current_admin_id'";
        if (mysqli_query($conn, $delete_query)) {
            // Clear the session and redirect after account deletion
            session_destroy();
            echo "<script>alert('Account deleted successfully!'); window.location.href = 'login.php';</script>";
            exit(); // Make sure to exit after the redirect
        } else {
            echo "<script>alert('Error deleting account: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings - Vows and Values</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #181818;
            color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #c06169;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #c06169;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #b04d59;
        }
        .delete-button {
            background-color: #d9534f; /* Bootstrap danger color */
        }
        .delete-button:hover {
            background-color: #c9302c;
        }
    </style>
    <script>
        // Function to confirm deletion of the account
        function confirmDelete() {
            return confirm('Are you sure you want to delete your account? This action cannot be undone.');
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Admin Settings</h2>
    <form action="" method="POST">
        <label for="username">Update Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($current_admin['username']); ?>" required>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <button type="submit" name="update">Update Account</button>
    </form>

    <form action="" method="POST" style="margin-top: 20px;" onsubmit="return confirmDelete();">
        <h3 style="color: #ffcc00;">Delete Account</h3>
        <p style="color: #fff;">Are you sure you want to delete your account? This action cannot be undone.</p>
        <button type="submit" class="delete-button" name="delete_account">Delete Account</button>
    </form>
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
