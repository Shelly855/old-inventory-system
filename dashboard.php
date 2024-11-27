<?php
include("includes/db_connection.php");  

// fetch product data
$sql = "SELECT product_category, quantity FROM product";
$result = $db->query($sql);

// array to store the data 
$chartData = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $chartData[] = [$row['product_category'], (int)$row['quantity']];
}

// Convert the PHP array 
$chartDataJson = json_encode($chartData);

$current_page = 'dashboard'; // Set to the current page
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
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
            <li><a href="admin_communications.php" class="<?php echo ($current_page == 'communications') ? 'active' : ''; ?>"><box-icon name='chat'></box-icon>Communicate ></a></li>
            <li><a href="admin/user_overview.php" class="<?php echo ($current_page == 'user_overview') ? 'active' : ''; ?>"><box-icon name='chat'></box-icon>User Overview ></a></li>
            <li><a href="settings.php" class="<?php echo ($current_page == 'settings') ? 'active' : ''; ?>"><box-icon name='cog'></box-icon>Settings ></a></li>
            <li><a href="login.php" class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>"><box-icon name='log-out-circle'></box-icon>Logout ></a></li>
        </ul>
    </nav>

    <!-- main content -->
    <main>
        <h1>Welcome to the Dashboard, User</h1>
        <p>.</p>
    
        <div class="grid-container">
            <!-- Top row with 3 smaller rectangles -->
            <div class="small-rectangle"><box-icon name='package' type='solid'></box-icon><h2>Orders:  248</h2></div>
            <div  class="small-rectangle"><box-icon name='line-chart'></box-icon><h2>Revenue:  $3,590.50</h2></div>
            <div class="small-rectangle"><box-icon name='dollar-circle'></box-icon><h2>Earnings: $1,550.80</h2></div>
        
            <!-- Bottom row with a large rectangle and a small rectangle -->
            <div id="curve_chart" class="large-rectangle"></div>
            <div id="piechart" class="small-rectangle bottom-row"></div>
        </div>
        
        <!-- Google Charts script -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            google.charts.setOnLoadCallback(drawChart2);

            // generate data as an array
            var chartData = <?php echo $chartDataJson; ?>;

            function drawChart() {
                // add headers to array
                chartData.unshift(['Product Category', 'Quantity Sold']);
                
                // Create a DataTable using the data
                var data = google.visualization.arrayToDataTable(chartData);

                // Set piechart
                var options = { 
                    title: 'Best Selling Stock' 
                };

                // creates piechart
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }

            function drawChart2() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Sales', 'Expenses'],
                    ['2004',  1000,      400],
                    ['2005',  1170,      460],
                    ['2006',  660,       1120],
                    ['2007',  1030,      540]
                ]);

                var options = {
                    title: 'Company Performance',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
            }
        </script>
    </main>
</body>
</html>

