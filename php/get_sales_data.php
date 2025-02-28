<?php
include 'database.php';

$query = "SELECT DATE(order_date) AS sale_date, COUNT(*) AS total_sales FROM list_buy GROUP BY sale_date ORDER BY sale_date ASC";
$result = mysqli_query($koneksi, $query);

$salesData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $salesData[] = [
        'date' => $row['sale_date'],  // Format tanggal harian
        'total_sales' => $row['total_sales']
    ];
}

header('Content-Type: application/json');
echo json_encode($salesData);
?>
