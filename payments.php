<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
};

include 'php/database.php';

// Count total payments for pagination
$totalPaymentsQuery = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM list_buy");
$totalPayments = mysqli_fetch_assoc($totalPaymentsQuery)['total'];
$perPage = 5;
$totalPages = ceil($totalPayments / $perPage);
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
            <div id="payments" class="section">
                <h3>Payments</h3>
                <div id="payment-table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Buy</th>
                                <th>ID User</th>
                                <th>ID Paket</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody id="payment-data">
                            <?php
                            // Show first page by default
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($page - 1) * $perPage;
                            
                            $query = "SELECT * FROM list_buy ORDER BY order_date DESC LIMIT $offset, $perPage";
                            $result = mysqli_query($koneksi, $query);
                            
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
                    
                    <div class="pagination">
                        <button id="prev-page" <?= $page <= 1 ? 'disabled' : '' ?>>Previous</button>
                        <span id="page-info">Page <?= $page ?> of <?= $totalPages ?></span>
                        <button id="next-page" <?= $page >= $totalPages ? 'disabled' : '' ?>>Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="javascript/payments.js"></script>
    <script>
    $(document).ready(function() {
        let currentPage = <?= $page ?>;
        const totalPages = <?= $totalPages ?>;
        
        // Function to load payments via AJAX
        function loadPayments(page) {
            $.ajax({
                url: 'php/fetch_payments.php',
                type: 'GET',
                data: { page: page },
                beforeSend: function() {
                    $('#payment-data').html('<tr><td colspan="4">Loading...</td></tr>');
                },
                success: function(response) {
                    $('#payment-data').html(response.data);
                    $('#page-info').text('Page ' + page + ' of ' + totalPages);
                    currentPage = page;
                    
                    // Update button states
                    $('#prev-page').prop('disabled', page <= 1);
                    $('#next-page').prop('disabled', page >= totalPages);
                },
                error: function() {
                    $('#payment-data').html('<tr><td colspan="4">Error loading data</td></tr>');
                }
            });
        }
        
        // Previous page button
        $('#prev-page').click(function() {
            if (currentPage > 1) {
                loadPayments(currentPage - 1);
            }
        });
        
        // Next page button
        $('#next-page').click(function() {
            if (currentPage < totalPages) {
                loadPayments(currentPage + 1);
            }
        });
    });
    </script>
</body>
</html>