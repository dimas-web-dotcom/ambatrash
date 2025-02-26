<?php
include 'database.php'; // Ensure this file contains your database connection

// Check if the package ID is provided
if (isset($_GET['ID_packet'])) {
    $packageId = $_GET['ID_packet'];

    // SQL query to delete the package
    $sql = "DELETE FROM packet WHERE ID_packet = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param('i', $packageId);

    if ($stmt->execute()) {
        echo "Package deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$koneksi->close();
?>