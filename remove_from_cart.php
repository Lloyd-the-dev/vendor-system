<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = intval($_POST['product_id']);
    $userId = $_SESSION['user_id'];

    // Check if the user's cart exists
    if (isset($_SESSION['cart'][$userId])) {
        // Find and remove the product from the user's cart
        foreach ($_SESSION['cart'][$userId] as $index => $item) {
            if ($item['id'] === $productId) {
                unset($_SESSION['cart'][$userId][$index]);
                $_SESSION['cart'][$userId] = array_values($_SESSION['cart'][$userId]); // Reindex array
                break;
            }
        }
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>