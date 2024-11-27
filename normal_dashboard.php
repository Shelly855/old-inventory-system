<?php
session_start();

// Set the current page
$current_page = 'normal_dashboard'; // Make sure to set the current page to 'normal_dashboard'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normal Dashboard</title>
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
            <li><a href="normal_dashboard.php" class="<?php echo ($current_page == 'normal_dashboard') ? 'active' : ''; ?>"><box-icon name='dashboard' type='solid'></box-icon>Dashboard ></a></li>
            <li><a href="inventory/normal_inventory.php" class="<?php echo ($current_page == 'inventory') ? 'active' : ''; ?>"><box-icon name='table'></box-icon>Inventory ></a></li>
            <li><a href="sales_history.php" class="<?php echo ($current_page == 'sales_history') ? 'active' : ''; ?>"><box-icon name='history'></box-icon>Sales History ></a></li>
            <li><a href="reports.php" class="<?php echo ($current_page == 'reports') ? 'active' : ''; ?>"><box-icon name='file-archive'></box-icon>Reports ></a></li>
            <li><a href="normal_settings.php" class="<?php echo ($current_page == 'settings') ? 'active' : ''; ?>"><box-icon name='cog'></box-icon>Settings ></a></li>
            <li><a href="login.php" class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>"><box-icon name='log-out-circle'></box-icon>Logout ></a></li>
        </ul>
    </nav>

    <!-- main content -->
    <main>
        <h1>Welcome to Your Dashboard</h1>

        <div class="grid-container">
            <div class="small-rectangle"><box-icon name='package' type='solid'></box-icon><h2>Orders: 248</h2></div>
            <div class="small-rectangle"><box-icon name='line-chart'></box-icon><h2>Revenue: $3,590.50</h2></div>
            <div class="small-rectangle"><box-icon name='dollar-circle'></box-icon><h2>Earnings: $1,550.80</h2></div>

            <div id="curve_chart" class="large-rectangle"></div>
            <div id="piechart" class="small-rectangle bottom-row"></div>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            google.charts.setOnLoadCallback(drawChart2);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['', 'Hours per Day'],
                    ['Lollipops', 11],
                    ['Chocolate Bars', 2],
                    ['Gummies', 2],
                    ['Sours', 2],
                    ['Marshmellow', 7]
                ]);
                var options = { title: 'Best selling Stock' };
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
