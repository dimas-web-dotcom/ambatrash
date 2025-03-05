<?php
session_start();
if (!isset($_SESSION['ID_user']) || $_SESSION['role'] != 'user') {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

header('Content-Type: application/json'); // Set response sebagai JSON

require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

// Set Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-oTS7zgO5wrXCd-F3cqozNTff'; // Ganti dengan Server Key Anda
\Midtrans\Config::$isProduction = false; // Ubah ke true jika di production
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data dari POST
$packet_id = $_POST['packet_id'];
$packet_name = $_POST['packet_name'];
$packet_price = $_POST['packet_price'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Validasi data
if (empty($packet_id) || empty($packet_name) || empty($packet_price) || empty($name) || empty($email) || empty($phone) || empty($address)) {
    echo json_encode(['error' => 'Data tidak lengkap']);
    exit();
}

$name_parts = explode(' ', $name, 2);
$first_name = $name_parts[0];
$last_name = isset($name_parts[1]) ? $name_parts[1] : '';

$params = array(
    'transaction_details' => array(
        'order_id' => uniqid(), // Gunakan order_id yang unik
        'gross_amount' => (int) $packet_price,
    ),
    'customer_details' => array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'billing_address' => array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'address' => $address,
            'country_code' => 'IDN',
        ),
    ),
    'item_details' => array(
        array(
            'id' => $packet_id,
            'price' => (int) $packet_price,
            'quantity' => 1,
            'name' => $packet_name,
        ),
    ),
);

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['snapToken' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>