<?php
session_start();
if (!isset($_SESSION['ID_user']) || $_SESSION['role'] != 'user') {
    header('Location: login.html');
    exit();
}

// Ambil data user dari database berdasarkan session
include 'php/database.php';
$user_id = $_SESSION['ID_user'];
$user_query = "SELECT username, email FROM users WHERE ID_user = '$user_id'";
$user_result = $koneksi->query($user_query);
$user_data = $user_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Tambahkan ini di bagian head -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0R3v6eP_1ps4vHx3qQ5IsxeFHgj0QwJM&libraries=places"></script>

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

    <!-- Midtrans Snap.js -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-U_QlWb9ToE6zJEG8"></script>
</head>
<body>
    <nav class="navbar">
            <a href="#" class="navbar-logo">Amba<span>TRASH</span></a>
            <div class="navbar-nav">
                <a href="#home">Home</a>
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
                    echo '<div class="packet-item">';
                    echo '  <img src="image/Gambar5.jpg" alt="Gambar5">';
                    echo '  <span class="text-center">' . htmlspecialchars($row["packet_name"]) . '</span>';
                    echo '  <p>' . htmlspecialchars($row["packet_description"]) . '</p>';
                    echo '  <span class="text-center">Rp' . number_format($row["packet_price"], 0, ',', '.') . '</span>';
                    // Gunakan tombol dengan type button dan panggil fungsi openModal()
                    echo '  <button type="button" onclick="openModal(\'' . $row["ID_packet"] . '\', \'' . htmlspecialchars($row["packet_name"]) . '\', \'' . $row["packet_price"] . '\')" class="btn">BUY</button>';
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
            <a href="php/logout.php">Logout</a>
        </div>
        <div class="credit">
            <p>Created By <a href="">Kelompok Musketeers</a>. | &copy; 2025 </p>
        </div>
    </footer>

    <!-- Modal untuk Payment -->
    <div id="payment-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Payment Details</h2>
            <form id="payment-form" action="php/order.php" method="POST">
                <input type="hidden" name="packet_id" id="modal-packet-id">
                <input type="hidden" name="packet_name" id="modal-packet-name">
                <input type="hidden" name="packet_price" id="modal-packet-price">

                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" placeholder="Nama" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="phone">Nomor HP:</label>
                <input type="tel" id="phone" name="phone" placeholder="Phone" required>

                <label for="address">Alamat:</label>
                <div class="location-controls">
                    <button type="button" onclick="getLocation()" class="btn-location">
                        <i data-feather="map-pin"></i> Deteksi Lokasi Saya
                    </button>
                    <span class="location-status" id="location-status"></span>
                </div>
                <textarea id="address" name="address" placeholder="Klik tombol 'Deteksi Lokasi' atau ketik manual" required></textarea>

                <button type="submit" class="btn">Confirm Payment</button>
            </form>
        </div>
    </div>


    <!-- JavaScript -->
    <script src="javascript/payment.js"></script>
    <script>
        feather.replace(); // Inisialisasi Feather Icons
        const userData = {
        name: "<?php echo htmlspecialchars($user_data['username'] ?? ''); ?>",
        email: "<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>",
        phone: "<?php echo htmlspecialchars($user_data['phone'] ?? ''); ?>"
};
    </script>
</body>
</html>