<?php
session_start();
$userId = $_SESSION["user_id"];
$input = json_decode(file_get_contents('php://input'), true);
$key = intval($input['key']);
$action = $input['action'];

// Initialize response
$response = ['success' => false, 'newQuantity' => 0, 'itemTotal' => 0, 'totalPrice' => 0];

// Check if the item exists in the cart
if (isset($_SESSION['cart'][$userId][$key])) {
    $item = &$_SESSION['cart'][$userId][$key];

    // Adjust the quantity
    if ($action === 'increase') {
        $item['quantity'] += 1;
    } elseif ($action === 'decrease' && $item['quantity'] > 0) {
        $item['quantity'] -= 1;
    }

    // Calculate new totals
    $itemTotal = $item['quantity'] * $item['price'];
    $totalPrice = 0;

    foreach ($_SESSION['cart'][$userId] as $cartItem) {
        $totalPrice += $cartItem['quantity'] * $cartItem['price'];
    }

    // Update response data
    $response = [
        'success' => true,
        'newQuantity' => $item['quantity'],
        'itemTotal' => $itemTotal,
        'totalPrice' => $totalPrice,
    ];
}

echo json_encode($response);
?>
