<?php
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Update the package data
    $sql = "UPDATE packet SET packet_name='$name', packet_price='$price', packet_description='$description' WHERE ID_packet='$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Package updated successfully";
    } else {
        echo "Error updating package: " . $koneksi->error;
    }
}

$koneksi->close();
?>