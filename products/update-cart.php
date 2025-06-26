<?php
require('../config/config.php');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set proper JSON header
header('Content-Type: application/json');

// Check authentication
if (!isset($_SESSION['username'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    header('Location: ../auth/login.php');
    exit();
}

// Validate input
if (empty($_GET['quantity']) || empty($_GET['cart_id'])) {
    http_response_code(400); // Bad request
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    header('Location: cart.php');
    exit();
}

// Sanitize and validate input
$cart_id = filter_var($_GET['cart_id'], FILTER_VALIDATE_INT);
$qty = filter_var($_GET['quantity'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($cart_id === false || $qty === false) {
    http_response_code(400); // Bad request
    echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
    exit();
}

try {
    // Prepare and execute update
    $update = $pdo->prepare("UPDATE cart SET qty = :qty WHERE cart_id = :cart_id AND user_id = :user_id");
    $update->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
    $update->bindParam(':qty', $qty, PDO::PARAM_INT);
    $update->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

    if ($update->execute()) {
        if ($update->rowCount() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(404); // Not found
            echo json_encode(['status' => 'error', 'message' => 'Cart item not found or not owned by user']);
        }
    } else {
        http_response_code(500); // Server error
        echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
    }
} catch (PDOException $e) {
    http_response_code(500); // Server error
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
exit();
?>