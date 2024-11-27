<?php
    $result = isset($_GET['create_user']) ? $_GET['create_user'] : '';

    $message = ($result) ? "User Created Successfully!" : "User Creation Failed!";

    $title = $message;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $message; ?></title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>  
</head>
<body>
<?php
        include("../includes/header_one.php");
    ?>  
    <div class="container">
        <?php
        
        $db = new SQLite3('C:\xampp\data\candyatlas.db');


        ?>  
        <main>
            <h1><?php echo $message; ?></h1>
            <form action="../admin/user_overview.php">
                <input type="submit" value="Back" />
            </form>
        </main>
        <?php
            $db->close();
        ?>
    </div>
</body>
</html>
