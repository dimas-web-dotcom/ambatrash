// Toggle Class Active
const navbarNav = document.querySelector('.navbar-nav');

//ketika humberger menu diclick
document.querySelector('#hamburger-menu').onclick = ( ) => {
    navbarNav.classList.toggle('active');
}

// Click Diluar SideBar

const hamburger = document.querySelector('#hamburger-menu');

document.addEventListener('click', function (event) {
    // Cek apakah yang diklik adalah tombol detail
    if (event.target.classList.contains('btnDetail')) {
        let card = event.target.closest('.card');
        if (!card) return; // Pastikan elemen card ditemukan

        let imgElement = card.querySelector('.card-img-top');
        let hargaElement = card.querySelector('.harga');
        let judulElement = card.querySelector('.card-title');
        let deskripsiElement = card.querySelector('.card-text');

        // Pastikan semua elemen yang dibutuhkan tersedia
        if (!imgElement || !hargaElement || !judulElement || !deskripsiElement) {
            console.error("Elemen penting tidak ditemukan dalam card!");
            return;
        }

        let imgSrc = imgElement.src;
        let harga = hargaElement.innerHTML;
        let judul = judulElement.innerHTML;
        let deskripsi = deskripsiElement ? deskripsiElement.innerHTML : '<i>tidak ada informasi yang tersedia</i>';

        // Masukkan data ke dalam modal
        document.querySelector('.modalTitle').innerHTML = judul;
        document.querySelector('.modalImage').innerHTML = `<img src="${imgSrc}" class="img-fluid">`;
        document.querySelector('.modalDeskripsi').innerHTML = deskripsi;
        document.querySelector('.modalHarga').innerHTML = harga;

        // Menampilkan deskripsi modal
        document.querySelector('.modalDeskripsi').style.display = 'block';  // Mengubah display deskripsi menjadi block

        // Tampilkan modal
        document.getElementById('myModal').style.display = 'block';
    }
});

// Menutup modal saat klik tombol close di modal

document.querySelector('.btn-close-modal').addEventListener('click', function () {
    document.getElementById('myModal').style.display = 'none';
});

// Tombol Pesan mengarah ke halaman pemesanan
document.querySelector('.btnPesan').addEventListener('click', function () {
    // Menambahkan data ke URL atau proses lainnya sebelum mengarahkan
    window.location.href = '../payment.php'; // Ganti dengan halaman yang sesuai untuk pemesanan
});

