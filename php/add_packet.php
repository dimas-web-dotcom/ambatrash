<?php
include 'database.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['packet-name'];
    $price = $_POST['packet-price'];
    $description = $_POST['packet-description'];

    // Insert data into the database
    $sql = "INSERT INTO packet (ID_packet, packet_name, packet_price, packet_description) 
            VALUES ('$id', '$name', '$price', '$description')";

    if ($koneksi->query($sql)) {
        echo "Package added successfully";
    } else {
        echo "Error adding package: " . $koneksi->error;
    }

    // Redirect back to the admin dashboard
    header('Location: ../admin.php');
    exit();
} else {
    echo "Invalid request method.";
}

$koneksi->close();
?>