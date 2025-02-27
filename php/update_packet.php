<?php
include 'database.php';

// Debugging: Cetak data yang dikirim dari formulir
var_dump($_POST);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['ID_packet'];
    $name = $_POST['packet_name'];
    $price = $_POST['packet_price'];
    $description = $_POST['packet_description'];

    // Debugging: Cetak ID_packet
    if (empty($id)) {
        die("ID_packet is empty or invalid.");
    }

    // Update the package data
    $sql = "UPDATE packet SET packet_name='$name', packet_price='$price', packet_description='$description' WHERE ID_packet='$id'";
    echo $sql; // Debugging: Cetak query SQL

    if ($koneksi->query($sql)) {
        echo "Package updated successfully";
    } else {
        echo "Error updating package: " . $koneksi->error;
    }
} else {
    echo "Invalid request method.";
}

$koneksi->close();
?>