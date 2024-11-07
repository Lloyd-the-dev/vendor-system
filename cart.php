<?php
include "config.php";
session_start();
$firstName = $_SESSION["name"];
$role = $_SESSION["role"];
$userId =  $_SESSION["user_id"];

$cartCount = 0;
$totalPrice = 0;

// Check if the user's cart exists and count items in it
if (isset($_SESSION['cart'][$userId])) {
    $cartCount = count($_SESSION['cart'][$userId]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 fs-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">VENDORLY</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="vendorDropdown">
                </ul>
            </li>
            <?php if($role === "Vendor"){?>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class='bx bx-plus-circle' id="nav-icon"></i>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link active" href="cart.php">
                    <i class='bx bx-cart-alt'></i>
                    <?php if ($cartCount > 0): ?>
                        <span id="cart-number" class=""><?php echo $cartCount; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_profile.php">
                  <i class='bx bx-user'></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./index.html" style="margin-left: 1.6rem">Logout</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search for a product" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
<div class="container mt-5">
    <h1 class="text-center">Your Cart</h1>
    <?php if ($cartCount > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'][$userId] as $item): 
                        // Ensure all keys exist in the item
                        $productName = isset($item['name']) ? htmlspecialchars($item['name']) : 'Unknown Product';
                        $productPrice = isset($item['price']) ? $item['price'] : 0.00;
                        $productQuantity = isset($item['quantity']) ? $item['quantity'] : 0;
                        $itemTotal = $productPrice * $productQuantity;
                        $totalPrice += $itemTotal;
                    ?>
                    <tr>
                        <td><?php echo $productName; ?></td>
                        <td>₦<?php echo number_format($productPrice, 2); ?></td>
                        <td><?php echo $productQuantity; ?></td>
                        <td>₦<?php echo number_format($itemTotal, 2); ?></td>
                        <td>
                            <form action="remove_from_cart.php" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo isset($item['id']) ? htmlspecialchars($item['id']) : ''; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-right mb-3">
            <h2>Total: ₦<?php echo number_format($totalPrice, 2); ?></h2>
        </div>
        <form action="place_order.php" method="POST">
            <button type="submit" class="btn btn-success btn-lg btn-block">Proceed to Checkout</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning text-center"><h1>Your cart is empty!</h1></div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetchVendorStoreNames();
        const cartCount = <?php echo $cartCount; ?>;
        if (cartCount > 0) {
            const cartNumber = document.getElementById("cart-number");
            if (cartNumber) {
                cartNumber.style.backgroundColor = "#d9534f";
                cartNumber.style.color = "white";
                cartNumber.style.borderRadius = "50%";
                cartNumber.style.padding = ".1rem .4rem";
                cartNumber.style.position = "absolute";
                cartNumber.style.top = ".7rem";
                cartNumber.style.left = "22rem";
                cartNumber.style.fontSize = ".7rem";
            }
        }
    });


    function fetchVendorStoreNames() {
            // Perform an AJAX request to get vendor store names and IDs
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "fetchVendors.php", true);
            xhr.onreadystatechange = function() {
                if(xhr.readyState === 4 && xhr.status === 200) {
                    // Parse the JSON response
                    let vendors = JSON.parse(xhr.responseText);
                    
                    // Get the vendor dropdown element
                    let vendorDropdown = document.getElementById("vendorDropdown");
                    
                    // Clear existing dropdown items
                    vendorDropdown.innerHTML = '';

                    // Add each vendor as a dropdown item
                    vendors.forEach(function(vendor) {
                        let listItem = document.createElement("li");
                        let link = document.createElement("a");
                        link.className = "dropdown-item";
                        
                        // Link to vendor_products.php with vendor_id in query parameter
                        link.href = "vendor_products.php?vendor_id=" + vendor.vendor_id;
                        
                        link.textContent = vendor.storeName;

                        listItem.appendChild(link);
                        vendorDropdown.appendChild(listItem);

                        // Add a divider after each item
                        let divider = document.createElement("li");
                        divider.innerHTML = '<hr class="dropdown-divider">';
                        vendorDropdown.appendChild(divider);
                    });
                }
            };
            xhr.send();
        }


</script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
