<?php
include 'database.php'; 

// Periksa apakah ID_user disediakan
if (isset($_GET['ID_user'])) {
    $userId = $_GET['ID_user'];

    // Mulai transaksi
    $koneksi->begin_transaction();

    try {
        // 1. Hapus data terkait di tabel list_buy
        $sqlDeleteListBuy = "DELETE FROM list_buy WHERE ID_user = ?";
        $stmtDeleteListBuy = $koneksi->prepare($sqlDeleteListBuy);
        $stmtDeleteListBuy->bind_param('i', $userId);
        $stmtDeleteListBuy->execute();
        $stmtDeleteListBuy->close();

        // 2. Hapus data di tabel users
        $sqlDeleteUser = "DELETE FROM users WHERE ID_user = ?";
        $stmtDeleteUser = $koneksi->prepare($sqlDeleteUser);
        $stmtDeleteUser->bind_param('i', $userId);
        $stmtDeleteUser->execute();
        $stmtDeleteUser->close();

        // Commit transaksi jika tidak ada error
        $koneksi->commit();

        // Redirect ke halaman admin setelah berhasil
        echo "<script>";
        echo "window.location.href = '../admin.php';";
        echo "</script>";
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaksi jika terjadi error
        $koneksi->rollback();
        echo "Error: " . $exception->getMessage();
    }
} else {
    // echo "Invalid request. User ID is missing.";
}

$koneksi->close();
?>