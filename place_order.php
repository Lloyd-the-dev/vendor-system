<?php
session_start();
include('config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $vendorId = $item['vendor_id'];
            $quantity = $item['quantity'];
            $totalPrice = $item['price'] * $quantity;
            $orderStatus = 'pending';

            $sql = "INSERT INTO orders (vendor_id, user_id, product_id, quantity, totalPrice, order_status, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiidss", $vendorId, $_SESSION["user_id"], $item['id'], $quantity, $totalPrice, $orderStatus);
            $stmt->execute();
        }
        
        // Clear the cart after placing the order
        unset($_SESSION['cart']);
        echo "Order placed successfully!";
    } else {
        echo "<div class='alert alert-warning text-center'>Your cart is empty!</div>";
    }
}
?>
