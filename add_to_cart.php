<?php
session_start();
include "config.php";

// Check if a product ID is provided
if (isset($_POST['product_id'])) {
    // Ensure product_id and quantity are integers
    $productId = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default to 1 if no quantity is provided
    $userId = $_SESSION["user_id"];

    // Fetch product details from the database
    $query = "SELECT product_id, product_name, price FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Create cart session if not already set
        if (!isset($_SESSION['cart'][$userId])) {
            $_SESSION['cart'][$userId] = [];
        }

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$userId][$productId])) {
            // Update quantity if product already exists in the cart
            $_SESSION['cart'][$userId][$productId]['quantity'] += $quantity;
        } else {
            // Add new product to the cart
            $_SESSION['cart'][$userId][$productId] = [
                'id' => $product['product_id'], // Make sure the ID here is consistent
                'name' => $product['product_name'],
                'price' => $product['price'],
                'quantity' => $quantity
            ];
        }

        // Calculate the total cart count
        $cartCount = 0;
        foreach ($_SESSION['cart'][$userId] as $item) {
            $cartCount += $item['quantity'];
        }

        // Return response as JSON
        echo json_encode(['success' => true, 'cartCount' => $cartCount]);
    } else {
        // Product not found
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Product ID is required']);
}

$conn->close();
