<?php
include 'database.php'; // Pastikan sudah ada koneksi ke database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $response = ["exists" => false];

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        $query = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $response["exists"] = true;
            $response["message"] = "Username is already taken!";
        }
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        $query = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $response["exists"] = true;
            $response["message"] = "Email is already registered!";
        }
    }

    echo json_encode($response);
}
?>
