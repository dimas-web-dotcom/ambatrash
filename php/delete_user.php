<?php
include 'database.php'; // Ensure this file contains your database connection

// Check if the user ID is provided
if (isset($_GET['ID_user'])) {
    $userId = $_GET['ID_user'];

    // SQL query to delete the user
    $sql = "DELETE FROM users WHERE ID_user = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$koneksi->close();
?>