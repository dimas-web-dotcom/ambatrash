<?php
session_start();
if (!isset($_SESSION['ID_user']) || $_SESSION['role'] != 'user') {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/c70abe0f51.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
     
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="src/output.css">
</head>
<body>
<nav class="navbar">
        <a href="#" class="navbar-logo">Amba<span>TRASH</span></a>
        <div class="navbar-nav">
            <a href="dashboard.php">Home</a>
            <a href="php/logout.php">Logout</a>
        </div>
        <div class="navbar-extra">
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>

    <!-- Payment Section -->
    <div class="container">
        <?php 
            include 'php/database.php';

            $sql = "SELECT ID_packet, image, packet_name, packet_price, packet_description FROM packet";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div id="root" class="sm:max-w-48 md:max-w-96">';
                    echo '<img src="image/Gambar5.jpg" alt="Gambar5">';
                    echo '<span class="text-center">' . htmlspecialchars($row['packet_name']) . '</span>';
                    echo '<p class="">' . htmlspecialchars($row['packet_description']) . '</p>';
                    echo '<span class="text-center">' . htmlspecialchars($row['packet_price']) . '</span>';
                    echo '<form action="php/order.php" method="POST">';
                    echo '<input type="hidden" name="packet_id" value="' . htmlspecialchars($row['ID_packet']) . '">';
                    echo '<input type="hidden" name="packet_name" value="' . htmlspecialchars($row['packet_name']) . '">';
                    echo '<input type="hidden" name="packet_price" value="' . htmlspecialchars($row['packet_price']) . '">';
                    echo '<button type="submit" class="btn">BUY</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No packets available.</p>';
            }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="socials flex justify-center">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>
        <div class="links">
            <a href="dashboard.php">Home</a>
        </div>
        <div class="credit">
            <p>Created By <a href="">Kelompok Musketeers</a>. | &copy; 2025 </p>
        </div>
    </footer>

    <!-- Icon dan JavaScript -->
    <script>
        feather.replace();
    </script>

</body>
</html>