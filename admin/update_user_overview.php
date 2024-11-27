<?php
session_start();

include '../includes/db_connection.php';
$errorName = $errorNumber = $errorEmail = $errorRole = $errorUsername = $errorPassword = $errorBranchID = "";
$allFields = true;

if (isset($_POST['submit'])) {

    if (empty($_POST['fullName'])) {
        $errorName = "Full Name is mandatory";
        $allFields = false;
    }
    if (empty($_POST['phoneNumber'])) {
        $errorNumber = "Phone Number is mandatory";
        $allFields = false;
    }
    if (empty($_POST['email'])) {
        $errorEmail = "Email is mandatory";
        $allFields = false;
    }
    if (empty($_POST['role'])) {
        $errorRole = "Role is mandatory";
        $allFields = false;
    }
    if (empty($_POST['username'])) {
        $errorUsername = "Username is mandatory";
        $allFields = false;
    }
    if (empty($_POST['password'])) {
        $errorPassword = "Password is mandatory";
        $allFields = false;
    }
    if (empty($_POST['branchID'])) {
        $errorBranchID = "Branch ID is mandatory";
        $allFields = false;
    }

    if ($allFields) {

        $stmt = $db->prepare("UPDATE user SET name = :fullName, phone_number = :phoneNumber, email = :email, role = :role, username = :username, password = :password, branch_id = :branchID WHERE user_id = :userID");
        $stmt->bindValue(':userID', $_POST['userID'], SQLITE3_INTEGER);
        $stmt->bindValue(':fullName', $_POST['fullName'], SQLITE3_TEXT);
        $stmt->bindValue(':phoneNumber', $_POST['phoneNumber'], SQLITE3_INTEGER);
        $stmt->bindValue(':email', $_POST['email'], SQLITE3_TEXT);
        $stmt->bindValue(':role', $_POST['role'], SQLITE3_TEXT);
        $stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);
        $stmt->bindValue(':password', $_POST['password'], SQLITE3_TEXT);
        $stmt->bindValue(':branchID', $_POST['branchID'], SQLITE3_INTEGER);
        
        $result = $stmt->execute();

        if ($result) {
            header('Location: ../admin/update_user_overview_success.php?updated=true');
            exit;
        } else {
            echo "Error updating user.";
        }
    }
}

if (isset($_GET['userID'])) {
    $stmt = $db->prepare('SELECT * FROM user WHERE user_id = :userID');
    $stmt->bindParam(':userID', $_GET['userID'], SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" media="only screen and (min-width:720px)" rel="stylesheet" type="text/css">
    <title>Update User Details</title>
</head>
<body>
    <?php
        include("../includes/header_one.php");
    ?>  
    <main>
        <h1>Update User</h1>
        <form method="post">
            <?php if (isset($user)): ?>
                <input type="hidden" name="userID" value="<?php echo $user['user_id']; ?>">
            <?php endif; ?>
            <label>Full Name</label>
            <input type="text" name="fullName" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>">
            <span class="blank-error"><?php echo $errorName; ?></span>

            <label>Phone Number</label>
            <input type="number" name="phoneNumber" value="<?php echo isset($user['phone_number']) ? $user['phone_number'] : ''; ?>">
            <span class="blank-error"><?php echo $errorNumber; ?></span>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">
            <span class="blank-error"><?php echo $errorEmail; ?></span>
            
            <label>Role</label>
            <select name="role">
                <option value="" disabled selected>Select Role</option>
                <option value="Admin" <?php echo (isset($user['role']) && $user['role'] == "admin") ? "selected" : ""; ?>>Admin</option>
                <option value="Manager" <?php echo (isset($user['role']) && $user['role'] == "manager") ? "selected" : ""; ?>>Manager</option>
                <option value="Sales Clerk" <?php echo (isset($user['role']) && $user['role'] == "sales clerk") ? "selected" : ""; ?>>Sales Clerk</option>
            </select>
            <span class="blank-error"><?php echo $errorRole; ?></span>

            <label>Username</label>
            <input type="text" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>">
            <span class="blank-error"><?php echo $errorUsername; ?></span>

            <label>Password</label>
            <input type="text" name="password" value="<?php echo isset($user['password']) ? $user['password'] : ''; ?>">
            <span class="blank-error"><?php echo $errorPassword; ?></span>

            <label>Branch Name</label>
            <select name="branch_name"> 
                <option value="" disabled selected>Branch Name</option>
                <option value="candy atlas sheffield">
            <input type="number" name="branchID" value="<?php echo isset($user['branch_id']) ? $user['branch_id'] : ''; ?>">
            <span class="blank-error"><?php echo $errorBranchID; ?></span>

            <input type="submit" value="Update User" name="submit">
            <a href="../admin/user_overview.php" class="back-button">Back</a>
        </form>
    </main>
</body>
</html>