<?php
session_start();

include '../includes/db_connection.php';

if (isset($_POST['delete'])) {
    if (isset($_POST['userID'])) {
        $userID = $_POST['userID'];

        $stmt_user_delete = $db->prepare("DELETE FROM user WHERE user_id = :userID");
        $stmt_user_delete->bindValue(':userID', $userID);
        $result_user_delete = $stmt_user_delete->execute();

        if ($result_user_delete && $result_user_delete) {
            header("Location: ../admin/remove_user_success.php?deleted=true");
            exit();
        } else {
            echo "Error removing user.";
        }
    }
}

if (isset($_GET['userID'])) {
    $stmt = $db->prepare('SELECT * FROM user WHERE user_id = :userID');
    $stmt->bindParam(':userID', $_GET['userID'], SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);
}

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" media="only screen and (min-width:720px)" rel="stylesheet" type="text/css">
    <title>Remove User</title>
</head>
<body>
    <?php include("../includes/header_one.php"); ?>
    <main>
        <h1>Remove User</h1>
        <div class="confirm">Are you sure you want to remove this user?</div>
        <?php if(isset($user)): ?>
        <div class="delete-data">
            <label class="delete-label">Name:</label>
            <label><?php echo $user['name']; ?></label>
        </div>
        <div class="delete-data">
            <label class="delete-label">Email:</label>
            <label><?php echo $user['email']; ?></label>
        </div>
        <div class="delete-data">
            <label class="delete-label">Role:</label>
            <label><?php echo $user['role']; ?></label>
        </div>
        <?php endif; ?>
        <form method="post">
            <input type="hidden" name="userID" value="<?php echo $_GET['userID']; ?>">
            <input type="submit" value="Delete" name="delete">
            <a href="../admin/user_overview.php" class="back-button">Back</a>
        </form>
    </main>
</body>
</html>