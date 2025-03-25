<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
};

include 'php/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
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
        <div id="payments" class="section">
                <h3>Payments</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID Buy</th>
                            <th>ID User</th>
                            <th>ID Paket</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM list_buy");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id_buy']}</td>
                                    <td>{$row['ID_user']}</td>
                                    <td>{$row['ID_packet']}</td>
                                    <td>{$row['order_date']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="javascript/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>