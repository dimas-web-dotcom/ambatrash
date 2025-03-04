$(document).ready(function () {
    // Cek username saat user mengetik
    $("#username").on("input", function () {
        let username = $(this).val().trim();
        $(this).next(".msg").remove(); // Hapus pesan lama setiap ketikan

        if (username.length > 3) {
            checkAvailability("username", username, "#username");
        }
    });

    // Cek email saat user mengetik
    $("#email").on("input", function () {
        let email = $(this).val().trim();
        $(this).next(".msg").remove(); // Hapus pesan lama setiap ketikan

        if (email.length > 5) {
            checkAvailability("email", email, "#email");
        }
    });

    // Fungsi untuk cek username/email ke server
    function checkAvailability(type, value, field) {
        $.ajax({
            url: "php/check_user.php",
            type: "POST",
            data: { [type]: value },
            dataType: "json",
            success: function (response) {
                $(field).next(".msg").remove(); // Hapus pesan lama
                
                if (response.exists) {
                    // Jika username/email sudah dipakai (tampilkan merah ❌)
                    $(field).after(
                        `<span class='msg' style='color:red; font-weight:bold;'>
                            ❌ ${response.message}
                        </span>`
                    );
                } else {
                    // Jika username/email bisa digunakan (tampilkan hijau ✅)
                    $(field).after(
                        `<span class='msg' style='color:green; font-weight:bold;'>
                            ✅ Bisa digunakan!
                        </span>`
                    );
                }
            },
            error: function () {
                console.log("Error checking " + type);
            }
        });
    }
});
