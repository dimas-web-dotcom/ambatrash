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
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
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
             
                <div id="users" class="section">
                    <h3>Users</h3>
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

                    <!-- Pagination -->
                    <div class="pagination">
                        <button id="prev-page">Previous</button>
                        <span id="page-info">Page 1</span>
                        <button id="next-page">Next</button>
                    </div>
                </div>

            <div id="packages" class="section">
                <h3>Packages</h3>
                <table id="package-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if (is_array($packagesData) && !empty($packagesData)) {
                            foreach ($packagesData as $package) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($package['ID_packet']) . "</td>";
                                echo "<td>" . htmlspecialchars($package['packet_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($package['packet_price']) . "</td>";
                                echo "<td class='desc'>" . htmlspecialchars($package['packet_description']) . "</td>";
                                echo "<td>
                                        <a href='php/delete_packet.php?ID_packet=" . htmlspecialchars($package['ID_packet']) . "' class='delete-btn'>DELETE</a>
                                        <button class='edit-btn' 
                                                data-id='" . htmlspecialchars($package['ID_packet']) . "' 
                                                data-name='" . htmlspecialchars($package['packet_name']) . "' 
                                                data-price='" . htmlspecialchars($package['packet_price']) . "' 
                                                data-description='" . htmlspecialchars($package['packet_description']) . "'>EDIT</button>
                                    </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <button id="add-package-btn">Add Package</button>
            </div>

            <!-- Modal (Popup) -->
            <div id="add-package-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>ADD Package</h2>
                    <form id="add-package-form" action="php/add_packet.php" method="POST">
                        <label for="ID-packet">ID</label>
                        <input type="number" id="ID-packet" name="id" required>
                        <br>
                        <label for="packet-name">Name:</label>
                        <input type="text" id="packet-name" name="packet-name" required>
                        <br>

                        <label for="packet-price">Price:</label>
                        <input type="number" id="packet-price" name="packet-price" required>
                        <br>

                        <label for="packet-description">Description:</label>
                        <input type="text" id="packet-description" name="packet-description" required>
                        <br>

                        <button type="submit">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- EDIT (Popup) -->
            <div id="edit-package-modal" class="edit">
                <div class="edit-content">
                    <span class="closeDua">&times;</span>
                    <h2>Edit Package</h2>
                    <form id="edit-package-form" action="php/update_packet.php" method="POST">
                        <label for="ID_packet">ID</label>
                        <input type="hidden" id="ID_packet" name="ID_packet" required>
                        <br>
                        <label for="packet_name">Name:</label>
                        <input type="text" id="packet_name" name="packet_name" required>
                        <br>
                        <label for="packet_price">Price:</label>
                        <input type="number" id="packet_price" name="packet_price" required>
                        <br>
                        <label for="packet_description">Description:</label>
                        <input type="text" id="packet_description" name="packet_description" required>
                        <br>
                        <button type="submit">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- table payment -->
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

            <!-- Grafik Penjualan -->


        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="javascript/admin.js"></script>
    <script src="javascript/ajax.js"></script>



</body>
</html>