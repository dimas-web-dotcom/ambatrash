<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
};

include 'php/database.php';
include 'php/delete_user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="payments.php">Payments</a></li>
                <li><a href="php/logout.php">Logout</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div id="users" class="section">
                <h3>Users Management</h3>
                <table id="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <!-- Data Users akan dimuat di sini -->
                    </tbody>
                </table>

                <div class="pagination">
                    <button id="prev-page">Previous</button>
                    <span id="page-info">Page 1</span>
                    <button id="next-page">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="javascript/admin.js"></script>
    <script src="javascript/ajax.js"></script>
</body>
</html>