<?php
// Include necessary files
include("../inventory/view_inventory_sql.php");
$products = getProducts();
include("../includes/header_one.php");

// Define the current page for the navbar highlight
$current_page = 'inventory';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventory</title>
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>  
    </head>
    <body>
        <!-- header -->
        <header>
            <div class="logo">
                <img src="../images/Screenshot 2024-11-05 162943.png" alt="Logo">
            </div>
        </header>
        
        <nav class="vertical-navbar">
    <ul>
        <li><a href="../manager_dashboard.php" class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>"><box-icon name='dashboard' type='solid'></box-icon>Dashboard ></a></li>
        <li><a href="inventory.php" class="<?php echo ($current_page == 'inventory') ? 'active' : ''; ?>"><box-icon name='table'></box-icon>Inventory ></a></li>
        <li><a href="../manage_orders.php" class="<?php echo ($current_page == 'manage_orders') ? 'active' : ''; ?>"><box-icon name='package' type='solid'></box-icon>Manage Orders ></a></li>
        <li><a href="../communications.php" class="<?php echo ($current_page == 'communications') ? 'active' : ''; ?>"><box-icon name='chat'></box-icon>Communicate ></a></li>
        <li><a href="../settings.php" class="<?php echo ($current_page == 'settings') ? 'active' : ''; ?>"><box-icon name='cog'></box-icon>Settings ></a></li>
        <li><a href="../login.php" class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>"><box-icon name='log-out-circle'></box-icon>Logout ></a></li>
    </ul>
</nav>



        <!-- main content -->
        <main>
            <h1>Welcome to the Inventory Catalogue</h1>
            
            <div class="toolbar">
                <h2>Database Product Listing</h2>
                
                <!--icons from Icons8 website-->
                <img src="../images/download_icon.png" alt="download icon" class="icon">
                <img src="../images/print_icon.png" alt="print icon" class="icon">
            </div>

            <!--Button-->
            <form action="add_product.php">
                <input type="submit" value="Add New Product">
            </form>

            <div class="table-container">
                <table>
                    <!--table headers-->
                    <thead>
                        <tr>
                            <th>Product No.</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Supplier</th>
                            <th>Branch</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <!--table body-->
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['product_id']; ?></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['product_category']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo $product['supplier_name']; ?></td>
                                <td><?php echo $product['branch_name']; ?></td>
                                <td class="actions">
                                    <a href="order_product.php">Order</a>
                                    <a href="edit_product.php?productID=<?php echo $product['product_id']; ?>">Edit</a>
                                    <a href="remove_product.php?productID=<?php echo $product['product_id']; ?>">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p class="number-records">Displaying <?php echo count($products); ?> of <?php echo count($products); ?> Records</p>

        </main>
    </body>
</html>
