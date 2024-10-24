<?php
// Include database connection
include('config.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit();
}

$userId = $_SESSION["user_id"];

// Check if product_id is set in the URL
if (isset($_GET['product_id'])) {
    $productId = intval($_GET['product_id']);

    // Fetch product details
    $productQuery = "SELECT * FROM products WHERE product_id = $productId";
    $productResult = $conn->query($productQuery);

    if ($productResult->num_rows > 0) {
        $product = $productResult->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Invalid product.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $productImage = $_POST['product_image']; 

    // Update product in the database
    $updateQuery = "UPDATE products SET product_name = '$productName', price = '$price', product_image = '$productImage' WHERE product_id = $productId";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: vendor_products.php?vendor_id=$userId"); 
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Product</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="product_image" class="form-label">Product Image URL</label>
            <input type="text" class="form-control" id="product_image" name="product_image" value="<?php echo htmlspecialchars($product['product_image']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="vendor_products.php?vendor_id=<?php echo $userId; ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
