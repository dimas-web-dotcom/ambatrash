function getLocation() {
    document.getElementById('address').placeholder = "Meminta izin lokasi...";
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const { latitude, longitude } = position.coords;
                reverseGeocode(latitude, longitude);
                
                // Opsional: Tampilkan peta (gunakan Leaflet)
                showMap(latitude, longitude);
            },
            error => {
                handleLocationError(error);
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    } else {
        document.getElementById('address').placeholder = "Browser tidak mendukung geolokasi";
    }
}

// Fungsi reverse geocoding dengan Nominatim
function reverseGeocode(lat, lng) {
    document.getElementById('location-status').textContent = "Mendapatkan alamat...";
    
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
        .then(response => response.json())
        .then(data => {
            if (data.display_name) {
                document.getElementById('address').value = data.display_name;
                document.getElementById('location-status').textContent = "Lokasi ditemukan!";
            } else {
                throw new Error("Alamat tidak ditemukan");
            }
        })
        .catch(error => {
            document.getElementById('address').placeholder = "Gagal mendapatkan alamat: " + error.message;
            document.getElementById('location-status').textContent = "Error";
        });
}

// Opsional: Tampilkan peta sederhana
function showMap(lat, lng) {
    const mapContainer = document.createElement('div');
    mapContainer.id = 'map-preview';
    mapContainer.style.height = '200px';
    mapContainer.style.margin = '10px 0';
    
    const addressContainer = document.getElementById('address').parentNode;
    addressContainer.insertBefore(mapContainer, document.getElementById('address'));
    
    const map = L.map('map-preview').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Anda")
        .openPopup();
}

// Penanganan error
function handleLocationError(error) {
    let message = "Error: ";
    switch(error.code) {
        case error.PERMISSION_DENIED:
            message += "Izin lokasi ditolak";
            break;
        case error.POSITION_UNAVAILABLE:
            message += "Informasi lokasi tidak tersedia";
            break;
        case error.TIMEOUT:
            message += "Permintaan timeout";
            break;
        default:
            message += "Error tidak diketahui";
    }
    document.getElementById('address').placeholder = message + ". Silakan masukkan manual.";
    document.getElementById('location-status').textContent = "Error";
}

// Fungsi openModal
function openModal(packetId, packetName, packetPrice) {
    // Isi data user
    document.getElementById('modal-packet-id').value = packetId;
    document.getElementById('modal-packet-name').value = packetName;
    document.getElementById('modal-packet-price').value = packetPrice;
    document.getElementById('name').value = userData.name;
    document.getElementById('email').value = userData.email;
    document.getElementById('phone').value = userData.phone || '';
    
    // Reset alamat
    document.getElementById('address').value = '';
    document.getElementById('address').placeholder = "Klik tombol deteksi lokasi";
    
    // Hapus peta sebelumnya jika ada
    const oldMap = document.getElementById('map-preview');
    if (oldMap) oldMap.remove();
    
    // Tampilkan modal
    document.getElementById('payment-modal').style.display = 'block';
}

// Event listeners
document.querySelector('.close').addEventListener('click', () => {
    document.getElementById('payment-modal').style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === document.getElementById('payment-modal')) {
        document.getElementById('payment-modal').style.display = 'none';
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


