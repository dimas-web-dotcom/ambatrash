<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
};

include 'php/delete_user.php';
include 'php/fetch_packages_data.php';
include 'php/database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="dashboard">
        <!-- Di semua file admin (bagian sidebar) -->
        <div class="sidebar">
            <div class="mobile-menu-toggle">
                <div class="hamburger"></div>
            </div>
            <h2>Admin Dashboard</h2>
            <ul class="nav-menu">
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="payments.php">Payments</a></li>
                <li><a href="php/logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
                <div id="sales_chart" class="section">
                    <h3>Grafik Penjualan Per Hari</h3>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

        </div>
    </div>

    <div class="sidebar-overlay"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="javascript/grafik.js"></script>
    <script src="javascript/ajax.js"></script>
</body>
</html>