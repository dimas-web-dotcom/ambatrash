$(document).ready(function () {
    // Cek kekuatan password saat user mengetik
    $("#password").on("input", function () {
        let password = $(this).val().trim();
        $(this).next(".msg").remove(); // Hapus pesan lama setiap ketikan
        
        // Validasi kekuatan password
        if (password.length === 0) {
            return; // Tidak tampilkan pesan jika kosong
        }
        
        let hasUpperCase = /[A-Z]/.test(password);
        let hasLowerCase = /[a-z]/.test(password);
        let isStrong = password.length >= 8 && hasUpperCase && hasLowerCase;
        
        $(this).next(".msg").remove(); // Hapus pesan lama
        
        if (isStrong) {
            $(this).after(
                `<span class='msg' style='color:green; font-weight:bold;'>
                    ✅ Password kuat!
                </span>`
            );
        } else {
            let message = "Password kurang kuat. Harus mengandung: ";
            if (password.length < 8) message += "<br> Minimal 8 karakter ";
            if (!hasUpperCase) message += "<br> Minimal 1 huruf besar ";
            if (!hasLowerCase) message += "<br> Minimal 1 huruf kecil ";
            
            $(this).after(
                `<span class='msg' style='color:red; font-weight:bold; font-size: 10px;'>
                    ❌ ${message}
                </span>`
            );
        }
    });
});