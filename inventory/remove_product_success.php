<?php
    $deleted = isset($_GET['deleted']) && $_GET['deleted'] === 'true';

    $message = ($deleted) ? "Product Removed Successfully!" : "Product Removal Failed!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" media="only screen and (min-width:720px)" rel="stylesheet" type="text/css">
    <title>Product Removal</title>
</head>
<body>
    <?php
        include("../includes/header_one.php");
    ?>  
    <main>
        <h1><?php echo $message; ?></h1>
        <form action="inventory.php">
            <input type="submit" value="Back" />
        </form>
    </main>
</body>
</html>