<?php
include 'database.php'; // Ensure this file contains your database connection

// SQL query to fetch user data
$sql = "SELECT ID_user, email, password FROM users";
$result = $koneksi->query($sql);

$usersData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usersData[] = $row;
    }
}

$koneksi->close();
?>