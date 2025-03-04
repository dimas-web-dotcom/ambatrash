<?php
include 'database.php'; 

// Periksa apakah ID_user disediakan
if (isset($_GET['ID_user'])) {
    $userId = $_GET['ID_user'];

    // Periksa role user sebelum menghapus
    $sqlCheckRole = "SELECT role FROM users WHERE ID_user = ?";
    $stmtCheckRole = $koneksi->prepare($sqlCheckRole);
    $stmtCheckRole->bind_param('i', $userId);
    $stmtCheckRole->execute();
    $stmtCheckRole->bind_result($role);
    $stmtCheckRole->fetch();
    $stmtCheckRole->close();

    // Jika role adalah admin, hentikan proses
    if ($role === 'admin') {
        echo "<script>alert('User dengan role admin tidak bisa dihapus!'); window.location.href = '../admin.php';</script>";
        exit;
    }

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
        echo "<script>window.location.href = '../admin.php';</script>";
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaksi jika terjadi error
        $koneksi->rollback();
        echo "Error: " . $exception->getMessage();
    }
}

$koneksi->close();
?>
