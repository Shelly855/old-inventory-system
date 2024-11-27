<?php
session_start();
include("includes/db_connection.php");

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = '';
$name = '';
$phone_number = '';
$email = '';
$role = '';
$password = '';

if (!$user_id) {
    header("Location: login.php");
    exit();
}

$stmt = $db->prepare("SELECT * FROM user WHERE user_id = :user_id");
$stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
$result = $stmt->execute();

if ($row = $result->fetchArray()) {
    $username = $row['username'];
    $name = $row['name'];
    $phone_number = $row['phone_number'];
    $email = $row['email'];
    $role = $row['role'];
    $password = $row['password'];  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username'];
    $new_name = $_POST['name'];
    $new_phone_number = $_POST['phone_number'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    $update_stmt = $db->prepare("UPDATE user SET username = :username, name = :name, phone_number = :phone_number, email = :email, password = :password WHERE user_id = :user_id");
    $update_stmt->bindValue(':username', $new_username, SQLITE3_TEXT);
    $update_stmt->bindValue(':name', $new_name, SQLITE3_TEXT);
    $update_stmt->bindValue(':phone_number', $new_phone_number, SQLITE3_TEXT);
    $update_stmt->bindValue(':email', $new_email, SQLITE3_TEXT);
    $update_stmt->bindValue(':password', $new_password, SQLITE3_TEXT);  
    $update_stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);

    if ($update_stmt->execute()) {
        $success_message = "Your details have been updated successfully!";
    } else {
        $error_message = "There was an error updating your details.";
    }
}

// Set current page
$current_page = 'settings';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="css/styles.css"> <!-- Main styles -->
</head>
<body>
    <!-- header -->
    <header>
        <div class="logo">
            <img src="./images/Screenshot 2024-11-05 162943.png" alt="Logo">
        </div>
    </header>

    <!-- vertical navbar -->
    <nav class="vertical-navbar">
        <ul>
            <li><a href="dashboard.php" class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>"><box-icon name='dashboard' type='solid'></box-icon>Dashboard ></a></li>
            <li><a href="inventory/inventory.php" class="<?php echo ($current_page == 'inventory') ? 'active' : ''; ?>"><box-icon name='table'></box-icon>Inventory ></a></li>
            <li><a href="manage_orders.php" class="<?php echo ($current_page == 'manage_orders') ? 'active' : ''; ?>"><box-icon name='package' type='solid'></box-icon>Manage Orders ></a></li>
            <li><a href="communications.php" class="<?php echo ($current_page == 'communications') ? 'active' : ''; ?>"><box-icon name='chat'></box-icon>Communicate ></a></li>
            <li><a href="settings.php" class="<?php echo ($current_page == 'settings') ? 'active' : ''; ?>"><box-icon name='cog'></box-icon>Settings ></a></li>
            <li><a href="login.php" class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>"><box-icon name='log-out-circle'></box-icon>Logout ></a></li>
        </ul>
    </nav>

    <!-- main content -->
    <main>
        <h1>Settings</h1>

        <!-- User details box -->
        <div class="user-details-box">
            <h2>Edit User Login Details</h2>
            <form action="settings.php" method="POST">
                <div class="detail">
                    <strong>Username:</strong>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="detail">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="detail">
                    <strong>Phone Number:</strong>
                    <input type="text" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" required>
                </div>
                <div class="detail">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="detail">
                    <strong>Password:</strong>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" placeholder="Enter new password">
                </div>
                <input type="submit" value="Update Details">
            </form>
        </div>

        <!-- Success or Error Message -->
        <?php if (isset($success_message)) : ?>
            <div style="color: green; text-align: center;">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php elseif (isset($error_message)) : ?>
            <div style="color: red; text-align: center;">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
