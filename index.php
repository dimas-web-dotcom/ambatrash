<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Angkut Sampah</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">Amba<span>TRASH</span></a>
        <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#paket">Paket</a>
            <a href="#contact">Kontak</a>
            <a href="login.html">Login</a>
        </div>
        <div class="navbar-extra">
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Mari Pakai Jasa Amba <span>TRASH</span></h1>
            <p>Solusi cerdas untuk lingkungan bersih</p>
            <a href="payment.php" class="cta">Pesan Jasa Sekarang</a>
        </main>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>
        <div class="row">
            <div class="about-image">
                <img src="image/Gambar2.jpg" alt="Tentang Kami"> 
            </div>
            <div class="content">
                <h3>Kenapa Memilih Layanan Kami?</h3>
                <p>Pilihan terbaik untuk lingkungan yang lebih bersih! Kami menawarkan jasa pengangkutan sampah yang cepat, profesional, dan ramah lingkungan dengan harga terjangkau. Dapatkan layanan terpercaya untuk kebersihan yang lebih baik. Para AMBA siap melayani.</p>
            </div>
        </div>
    </section>
    <!-- About Section End -->
    <!-- Paket Section Start -->
    <section id="paket" class="paket">
        <h2><span>Tentang</span> Paket</h2>
        <p>Pilih Paket jasa pengangkutan sampah yang sesuai dengan kebutuhan Anda. </p>

        <div class="row row-cols-md-3 row-cols-2 gx-5 p-5">
            <?php
            include 'php/database.php'; // Include koneksi database

            // Query untuk mengambil data dari tabel packet
            $sql = "SELECT ID_packet, image, packet_name, packet_price, packet_description FROM packet";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                // Jika data ditemukan, tampilkan dalam bentuk card
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col mb-5">';
                    echo '<div class="card h-100 d-flex flex-column shadow">';
                    
                    // Tampilkan gambar
                   
                    echo '<img src="image/Gambar5.jpg" class="card-img-top">';
                    
                    echo '<div class="card-body flex-grow-1">';
                    echo '<h5 class="card-title">' . $row['packet_name'] . '</h5>';
                    echo '<p class="card-text">' . $row['packet_description'] . '</p>';
                    echo '</div>';
                    
                    echo '<div class="card-footer d-flex justify-content-between align-items-center">';
                    echo '<a class="btn btn-sm btn-primary d-block btnDetail">Detail</a>';
                    echo '<span class="ms-auto text-danger fw-bold d-block text-center harga">Rp ' . $row['packet_price'] . '</span>';
                    echo '</div>';
                    
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada data packet.</p>';
            }

            $koneksi->close(); // Tutup koneksi database
            ?>
        </div>
    </section>
    <!-- Paket Section End -->

    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modalTitle" id="modalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modalImage"></div>
                    <h3 class="modalDeskripsi"></h3>
                </div>
                <div><p class="modalHarga"></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Close</button>
                    <a href="payment.php" class="btn btn-primary btnPesan">Pesan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section Start -->
    <section id="contact" class="contact">
        <h2><span>Contact</span> Us</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, harum?</p>
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31894.554218237525!2d113.8950144!3d-2.2216704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfcb25094706e19%3A0xbb98948229782892!2sBundaran%20Besar%20Palangkaraya!5e0!3m2!1sid!2sid!4v1739781880691!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>

            <form action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="nama">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="nama" placeholder="email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="nama" placeholder="no hp">
                </div>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Start -->
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>
        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#paket">Paket</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="credit">
            <p>Created By <a href="">Kelompok Musketeers</a>. | &copy; 2025 </p>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Icon -->
    <script>
        feather.replace();
    </script>

    <!-- My JavaScript -->
    <script src="javascript/script.js"></script>
</body>
</html>