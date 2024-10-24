<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = intval($_POST['product_id']);
    $productName = $_POST['product_name'];
    $productPrice = floatval($_POST['product_price']);
    
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $isProductInCart = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] === $productId) {
            $_SESSION['cart'][$key]['quantity'] += 1; // Increment quantity
            $isProductInCart = true;
            break;
        }
    }

    // If not in cart, add new product
    if (!$isProductInCart) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }

    echo "Product added to cart!";
}
?>
