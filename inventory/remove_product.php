<?php
session_start();

include '../includes/db_connection.php';

if (isset($_POST['delete'])) {
    if (isset($_POST['productID'])) {
        $productID = $_POST['productID'];

        $stmt_product_delete = $db->prepare("DELETE FROM product WHERE product_id = :productID");
        $stmt_product_delete->bindValue(':productID', $productID);
        $result_product_delete = $stmt_product_delete->execute();

        if ($result_product_delete && $result_product_delete) {
            header("Location: remove_product_success.php?deleted=true");
            exit();
        } else {
            echo "Error removing product.";
        }
    }
}

if (isset($_GET['productID'])) {
    $stmt = $db->prepare('SELECT * FROM product WHERE product_id = :productID');
    $stmt->bindParam(':productID', $_GET['productID'], SQLITE3_INTEGER);
    $result = $stmt->execute();
    $product = $result->fetchArray(SQLITE3_ASSOC);
}

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" media="only screen and (min-width:720px)" rel="stylesheet" type="text/css">
    <title>Remove Product</title>
</head>
<body>
    <?php include("../includes/header_one.php"); ?>
    <main>
        <h1>Remove Product</h1>
        <div class="confirm">Are you sure you want to remove this product?</div>
        <?php if(isset($product)): ?>
        <div class="delete-data">
            <label class="delete-label">Product Name:</label>
            <label><?php echo $product['product_name']; ?></label>
        </div>
        <div class="delete-data">
            <label class="delete-label">Category:</label>
            <label><?php echo $product['product_category']; ?></label>
        </div>
        <?php endif; ?>
        <form method="post">
            <input type="hidden" name="productID" value="<?php echo $_GET['productID']; ?>">
            <input type="submit" value="Delete" name="delete">
            <a href="inventory.php" class="back-button">Back</a>
        </form>
    </main>
</body>
</html>