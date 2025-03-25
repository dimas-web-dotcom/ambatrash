// Fungsi untuk mendapatkan lokasi dengan penanganan error yang lebih baik
function getLocation() {
    // Beri tahu pengguna bahwa kita membutuhkan izin lokasi
    document.getElementById('address').placeholder = "Meminta izin akses lokasi...";
    
    if (navigator.geolocation) {
        const options = {
            enableHighAccuracy: true,
            timeout: 10000, // 10 detik timeout
            maximumAge: 0
        };
        
        navigator.geolocation.getCurrentPosition(
            showPosition, 
            showError, 
            options
        );
    } else {
        showManualAddressInput("Browser tidak mendukung geolocation");
    }
}

function showPosition(position) {
    document.getElementById('address').placeholder = "Mendapatkan alamat...";
    
    const geocoder = new google.maps.Geocoder();
    const latlng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK" && results[0]) {
            document.getElementById('address').value = results[0].formatted_address;
        } else {
            showManualAddressInput("Gagal mendapatkan alamat otomatis. Silakan masukkan manual.");
        }
    });
}

function showError(error) {
    let errorMessage = "Error: ";
    switch(error.code) {
        case error.PERMISSION_DENIED:
            errorMessage = "Izin lokasi ditolak. Silakan masukkan alamat manual.";
            break;
        case error.POSITION_UNAVAILABLE:
            errorMessage = "Informasi lokasi tidak tersedia.";
            break;
        case error.TIMEOUT:
            errorMessage = "Permintaan lokasi timeout. Silakan coba lagi.";
            break;
        case error.UNKNOWN_ERROR:
            errorMessage = "Terjadi kesalahan tidak diketahui.";
            break;
    }
    showManualAddressInput(errorMessage);
}

function showManualAddressInput(message) {
    document.getElementById('address').placeholder = message + " Silakan ketik alamat manual.";
    document.getElementById('address').focus();
}

// Fungsi openModal yang diperbarui
function openModal(packetId, packetName, packetPrice) {
    // Isi data paket
    document.getElementById('modal-packet-id').value = packetId;
    document.getElementById('modal-packet-name').value = packetName;
    document.getElementById('modal-packet-price').value = packetPrice;
    
    // Isi data user dari session
    document.getElementById('name').value = userData.name;
    document.getElementById('email').value = userData.email;
    document.getElementById('phone').value = userData.phone || '';
    
    // Kosongkan alamat sementara
    document.getElementById('address').value = '';
    document.getElementById('address').placeholder = "Klik tombol 'Deteksi Lokasi' atau ketik manual";
    
    // Tampilkan modal
    document.getElementById('payment-modal').style.display = 'block';
    
    // Jangan otomatis meminta lokasi, biarkan user yang memulai
}

// Tutup modal ketika klik tombol close
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('payment-modal').style.display = 'none';
});

// Tutup modal ketika klik di luar modal
window.addEventListener('click', function(event) {
    const modal = document.getElementById('payment-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Tambahkan event listener untuk tombol deteksi lokasi
document.querySelector('button[onclick="getLocation()"]').addEventListener('click', function(e) {
    e.preventDefault();
    getLocation();
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


