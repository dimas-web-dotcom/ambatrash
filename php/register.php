<?php 

    include 'database.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user'; // Set the default role to 'user'

    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param('ssss', $username, $email, $hashed_password, $role); // Include the role parameter

    if ($stmt->execute()) {
        echo "<script>alert('Register Berhasil');";
        echo "window.location.href = '../login.html';";
        echo "</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();

?>