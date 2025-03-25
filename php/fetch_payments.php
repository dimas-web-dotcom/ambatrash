<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
};

include 'database.php';

$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

$query = "SELECT * FROM list_buy ORDER BY order_date DESC LIMIT $offset, $perPage";
$result = mysqli_query($koneksi, $query);

$output = '';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>
                  <td>{$row['id_buy']}</td>
                  <td>{$row['ID_user']}</td>
                  <td>{$row['ID_packet']}</td>
                  <td>{$row['order_date']}</td>
                </tr>";
}

header('Content-Type: application/json');
echo json_encode(['data' => $output]);
?>