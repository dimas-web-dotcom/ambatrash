<?php
include 'database.php'; // Ensure this file contains your database connection

// SQL query to fetch package data
$sql = "SELECT ID_packet, packet_name, packet_price, packet_description FROM packet";
$result = $koneksi->query($sql);

$packagesData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packagesData[] = $row;
    }
}

$koneksi->close();
?>