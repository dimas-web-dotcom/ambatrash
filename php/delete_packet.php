<?php
include 'database.php'; 

if (isset($_GET['ID_packet'])) {
    $packageId = $_GET['ID_packet'];

    // Mulai transaksi
    $koneksi->begin_transaction();

    try {
        // 1. Hapus data terkait di tabel list_buy
        $sqlDeleteListBuy = "DELETE FROM list_buy WHERE ID_packet = ?";
        $stmtDeleteListBuy = $koneksi->prepare($sqlDeleteListBuy);
        $stmtDeleteListBuy->bind_param('i', $packageId);
        $stmtDeleteListBuy->execute();
        $stmtDeleteListBuy->close();

        // 2. Hapus data di tabel packet
        $sqlDeletePacket = "DELETE FROM packet WHERE ID_packet = ?";
        $stmtDeletePacket = $koneksi->prepare($sqlDeletePacket);
        $stmtDeletePacket->bind_param('i', $packageId);
        $stmtDeletePacket->execute();
        $stmtDeletePacket->close();

        // Commit transaksi jika tidak ada error
        $koneksi->commit();
        echo "<Script>";
        echo "window.location.href = '../admin.php';"; 
        echo "</script>";
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaksi jika terjadi error
        $koneksi->rollback();
        echo "Error: " . $exception->getMessage();
    }
} else {
    echo "Invalid request. Package ID is missing.";
}

$koneksi->close();
?>