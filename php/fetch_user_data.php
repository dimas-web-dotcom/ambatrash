<?php
include 'database.php'; // Koneksi database

$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Hitung total user
$totalUsersQuery = "SELECT COUNT(*) AS total FROM users";
$totalUsersResult = $koneksi->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['total'];
$totalPages = ceil($totalUsers / $limit);

// Ambil data user dengan pagination
$sql = "SELECT ID_user, email, password FROM users LIMIT $limit OFFSET $offset";
$result = $koneksi->query($sql);

$usersData = [];
while ($row = $result->fetch_assoc()) {
    $usersData[] = $row;
}

$response = [
    'users' => $usersData,
    'totalPages' => $totalPages
];

echo json_encode($response);

$koneksi->close();
?>
