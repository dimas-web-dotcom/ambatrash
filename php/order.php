<?php
// Pastikan user sudah login
session_start();
if (!isset($_SESSION['ID_user']) || $_SESSION['role'] != 'user') {
    header('Location: login.html');
    exit();
}

include 'database.php'; // Include koneksi database

// Ambil data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_packet = $_POST['packet_id'];
    $ID_user = $_SESSION['ID_user']; // Ambil ID_user dari session

    // Query untuk menyimpan data ke tabel list_buy
    $sql = "INSERT INTO list_buy (ID_packet, ID_user) VALUES ('$ID_packet', '$ID_user')";

    if ($koneksi->query($sql) === TRUE) {
        // Tampilkan halaman sukses
        include '../templates/succes.html';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "Invalid request method.";
}

$koneksi->close();
?>