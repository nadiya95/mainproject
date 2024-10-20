<?php
// Start the session
session_start();

// Include the database configuration
include '../config/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle Activate/Deactivate user account
if (isset($_GET['toggle_status']) && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $current_status = $_GET['status'];

    // Toggle the user status (1 = active, 0 = deactivated)
    $new_status = $current_status == 1 ? 0 : 1;
    $toggle_query = "UPDATE users SET status = $new_status WHERE id = $user_id";
    $conn->query($toggle_query);
    header("Location: manageuser.php");
    exit();
}

// Handle user deletion (soft delete)
if (isset($_GET['delete_user']) && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Mark the user as deleted (soft delete)
    $delete_query = "UPDATE users SET deleted_at = NOW() WHERE id = $user_id";
    $conn->query($delete_query);
    header("Location: manageuser.php");
    exit();
}

// Fetch all users from the database
$fetch_users = "SELECT id, username, email, status FROM users WHERE deleted_at IS NULL";
$users_result = $conn->query($fetch_users);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            padding: 10px 20px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .button.delete {
            background-color: red;
        }
        .button.deactivate {
            background-color: orange;
        }
        .button.activate {
            background-color: green;
        }
    </style>
</head>
<body>

    <h1>Manage Users</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php if ($users_result->num_rows > 0): ?>
            <?php while ($user = $users_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['status'] == 1 ? 'Active' : 'Deactivated'; ?></td>
                    <td>
                        <!-- Toggle user status -->
                        <a href="manageuser.php?toggle_status=1&user_id=<?php echo $user['id']; ?>&status=<?php echo $user['status']; ?>" 
                           class="button <?php echo $user['status'] == 1 ? 'deactivate' : 'activate'; ?>">
                           <?php echo $user['status'] == 1 ? 'Deactivate' : 'Activate'; ?>
                        </a>

                        <!-- Delete user (soft delete) -->
                        <a href="manageuser.php?delete_user=1&user_id=<?php echo $user['id']; ?>" class="button delete">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>