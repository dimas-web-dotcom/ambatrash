// Ambil elemen modal dan tombol close
const modal = document.getElementById("payment-modal");
const closeBtn = document.querySelector(".close");

// Fungsi untuk membuka modal dan mengisi data produk
function openModal(packetId, packetName, packetPrice) {
    document.getElementById("modal-packet-id").value = packetId;
    document.getElementById("modal-packet-name").value = packetName;
    document.getElementById("modal-packet-price").value = packetPrice;
    
    modal.style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal() {
    modal.style.display = "none";
}

// Event listener untuk tombol close di modal
closeBtn.addEventListener("click", closeModal);

// Tutup modal jika klik di luar konten modal
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        closeModal();
    }
});

// Event listener untuk tombol "Confirm Payment"
document.getElementById("payment-form").addEventListener("submit", async (event) => {
    event.preventDefault(); // Mencegah submit form secara default

    // Ambil data dari form
    const formData = new FormData(event.target);

    try {
        // Kirim data ke `placeOrder.php` untuk mendapatkan Snap Token
        const response = await fetch("php/order.php", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (result.snapToken) {
            // Jika berhasil mendapatkan Snap Token, buka Midtrans Snap Payment Page
            window.snap.pay(result.snapToken, {
                onSuccess: function (result) {
                    alert("Pembayaran berhasil!");
                    closeModal();
                },
                onPending: function (result) {
                    alert("Pembayaran pending! Silakan selesaikan pembayaran.");
                    closeModal();
                },
                onError: function (result) {
                    alert("Pembayaran gagal! Silakan coba lagi.");
                    closeModal();
                },
            });
        } else {
            console.error("Error:", result.error);
            alert("Gagal mendapatkan token pembayaran: " + result.error);
        }
    } catch (error) {
        console.error("Fetch error:", error);
        alert("Terjadi kesalahan saat memproses pembayaran.");
    }
});


