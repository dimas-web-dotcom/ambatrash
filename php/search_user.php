<?php
include 'database.php'; // Include koneksi database

// Ambil parameter pencarian dari AJAX
$searchName = isset($_GET['search_name']) ? $_GET['search_name'] : '';

// Query untuk mencari user berdasarkan nama
$sql = "SELECT * FROM users WHERE email LIKE ?";
$stmt = $koneksi->prepare($sql);
$searchTerm = "%$searchName%";
$stmt->bind_param('s', $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($users);

$stmt->close();
$koneksi->close();
?>