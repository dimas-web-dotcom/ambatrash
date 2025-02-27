<?php
include 'database.php'; // Sesuaikan path-nya

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param('s', $email); // Ganti $username dengan $email
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) { // Ganti $email dengan $password
        session_start();
        $_SESSION['ID_user'] = $user['ID_user'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: ../admin.php');
            exit(); // Tambahkan ini
        } elseif ($user['role'] == 'user') {
            header('Location: ../dashboard.php');
            exit(); // Tambahkan ini
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>