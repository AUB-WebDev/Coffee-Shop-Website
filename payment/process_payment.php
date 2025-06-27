<?php
require '../config/config.php';

header('Content-Type: application/json');

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to cart is the try to access checkout via link
    header('location: ../products/cart.php');
    exit;
}

// Check if this is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    header('HTTP/1.0 403 Forbidden');
    exit();
}


// Get the raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate required data
if (!isset($data['sessionData']) || !isset($data['orderData'])) {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit();
}

$orderData = $data['orderData'];
$sessionData = $data['sessionData'];

try {
    // Insert into database
    $insert = $pdo->prepare('INSERT INTO orders(first_name, last_name, state, street_address,
               apartment_unit, town, zip_code, phone, email, user_id, status, total_price) 
               VALUES(:first_name, :last_name, :state, :street_address, :apartment_unit, 
               :town, :zip_code, :phone, :email, :user_id, :status, :total_price)');

    $insert->execute([
        ':first_name' => $sessionData['first_name'],
        ':last_name' => $sessionData['last_name'],
        ':state' => $sessionData['state'],
        ':street_address' => $sessionData['street_address'],
        ':apartment_unit' => $sessionData['apartment'],
        ':town' => $sessionData['town'],
        ':zip_code' => $sessionData['zipcode'],
        ':phone' => $sessionData['phone'],
        ':email' => $sessionData['email'],
        ':user_id' => $sessionData['user_id'],
        ':status' => 'paid',
        ':total_price' => $sessionData['total_price']
    ]);

    $order_id = $pdo->lastInsertId();

    // Clear the cart and order data from session
    unset($_SESSION['order_data']);
//    unset($_SESSION['cart']);
    unset($_SESSION['total_price']);

    $_SESSION['order_status'] = 'success';

    echo json_encode(['success' => true, 'order_id' => $order_id]);

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}