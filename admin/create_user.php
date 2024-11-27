<?php
$errorName = $errorNumber = $errorEmail = $errorRole = $errorUsername = $errorPassword = $errorBranch = "";
$allFields = true;

// database connection
include '../includes/db_connection.php';

//fetching branch details
$stmt_branch = $db->prepare('SELECT branch_id, branch_name FROM branch');
$result_branch = $stmt_branch->execute();
$branches = array();
while ($row = $result_branch->fetchArray(SQLITE3_ASSOC)){
    $branches[] = array(
    'branch_id' => $row['branch_id'],
    'branch_name' => $row['branch_name'] );
}

if (isset($_POST['submit'])){
    if (empty($_POST["fullName"])) {
        $errorName = "Full Name is mandatory";
        $allFields = false;
    }
    if (empty($_POST["phoneNumber"])) {
        $errorNumber = "Phone number is mandatory";
        $allFields = false;
    }
    if (empty($_POST["email"])) {
        $errorEmail = "Email is mandatory";
        $allFields = false;
    }   
    if (empty($_POST["role"])) {
        $errorRole = "Role is mandatory";
        $allFields = false;
    }   
    if (empty($_POST["username"])) {
        $errorUsername = "Username is mandatory";
        $allFields = false;
    }    
    if (empty($_POST["password"])) {
        $errorPassword = "Password is mandatory";
        $allFields = false;
    }    
    if (empty($_POST["branch_id"]) || $_POST["branch_id"] == 0) {
        $errorBranch = "Branch is mandatory";
        $allFields = false;
    }

    if ($allFields){
        $stmt = $db->prepare('INSERT INTO user (name, phone_number, email, role, username, password, branch_id) VALUES (:fullName, :phoneNumber, :email, :role, :username, :password, :branch_id)');
        $stmt->bindValue(':fullName', $_POST['fullName'], SQLITE3_TEXT);
        $stmt->bindValue(':phoneNumber', $_POST['phoneNumber'], SQLITE3_INTEGER);
        $stmt->bindValue(':email', $_POST['email'], SQLITE3_TEXT);
        $stmt->bindValue(':role', $_POST['role'], SQLITE3_TEXT);
        $stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);
        $stmt->bindValue(':password', $_POST['password'], SQLITE3_TEXT);
        $stmt->bindValue(':branch_id', $_POST['branch_id'], SQLITE3_INTEGER);

       $result_user = $stmt->execute();

        if ($result_user) {
            header("Location: ../admin/create_user_success.php?create_user=success");
            exit();
            } else {
                echo "Error creating user. " .$db->lastErrorMsg();
            }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>  
</head>
<body>
<?php
        include("../includes/header_one.php");
    ?>  
    
    <main> 
        <h1>Create User</h1>
        <form method="post">
        <label>Full Name</label>
            <input type="text" name="fullName" value="<?php echo isset($_POST['fullName']) ? $_POST['fullName'] : ''; ?>">
            <span class="blank-error"><?php echo $errorName; ?></span>
        
            <label>Phone Number</label>
            <input type="number" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : ''; ?>">
            <span class="blank-error"><?php echo $errorNumber; ?></span>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <span class="blank-error"><?php echo $errorEmail; ?></span>

            <label>Role</label>
            <select name="role">
                <option value="" disabled selected>Select Role</option>
                <option value="Admin" >Admin</option>
                <option value="Manager">Manager</option>
                <option value="Sales Clerk">Sales Clerk</option>
            </select>
            <span class="blank-error"><?php echo $errorRole; ?></span>

            <label>Username</label>
            <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
            <span class="blank-error"><?php echo $errorUsername; ?></span>

            <label>Password</label>
            <input type="text" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
            <span class="blank-error"><?php echo $errorPassword; ?></span>

            <label for="branch_id">Branch</label>
            <select name="branch_id" id="branch_id">
                <option value="" disabled selected>Select Branch</option>
                <?php foreach ($branches as $branch): ?>
                    <option value="<?php echo $branch['branch_id']; ?>">
                        <?php echo $branch['branch_name']; ?>
                </option>
                <?php endforeach; ?>
                </select>       
            <span class="blank-error"><?php echo $errorBranch; ?></span>

            <input type="submit" value="Create User" name="submit">
            <a href="../admin/user_overview.php" class="back">Back</a>
        </form>
    </main>
</body>
</html>
