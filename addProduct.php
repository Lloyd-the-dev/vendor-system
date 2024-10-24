<?php
// Database connection
include "config.php";

session_start();
$vendorId = $_SESSION["user_id"];
$storeName = $_SESSION["storeName"];

// Check if form data is set
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];

    // Handle the image upload
    $targetDir = "uploads/"; // Directory to store uploaded images
    $targetFile = $targetDir . basename($_FILES["productImg"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or a fake image
    $check = getimagesize($_FILES["productImg"]["tmp_name"]);
    if ($check === false) {
        echo '<script type="text/JavaScript">';
        echo 'alert("The uploaded File is not an image!");';
        echo '</script>';
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $targetFile)) {
        // Insert product details into the database
        $sql = "INSERT INTO products (product_name, vendor_id, price, Quantity, product_image, storeName) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiiss", $productName, $vendorId, $productPrice, $productQuantity, $targetFile, $storeName);

        if ($stmt->execute()) {
            echo '<script type="text/JavaScript">';
            echo 'alert("New product added successfully.");';
            echo 'window.location.href = "dashboard.php";';
            echo '</script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
