<?php
$host = 'localhost'; // Host database
$user = 'root';      // Username database (default XAMPP)
$password = '';      // Password database (default XAMPP kosong)
$database = 'recyclehub'; // Nama database

// Buat koneksi
$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>