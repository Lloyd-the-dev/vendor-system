<?php
// Include database connection
include('config.php'); 
session_start();
$firstName = $_SESSION["name"];
$role = $_SESSION["role"];
$userId =  $_SESSION["user_id"];
$cartCount = 0;
if (isset($_SESSION['cart'])) {
    $cartCount = isset($_SESSION['cart'][$userId]) ? count($_SESSION['cart'][$userId]) : 0;
}

if (isset($_GET['vendor_id'])) {
    $vendorId = intval($_GET['vendor_id']);
    
    // Fetch vendor information
    $vendorQuery = "SELECT storeName FROM products WHERE vendor_id = $vendorId";
    $vendorResult = $conn->query($vendorQuery);
    $vendor = $vendorResult->fetch_assoc();
    
    // Fetch vendor's products
    $productQuery = "SELECT * FROM products WHERE vendor_id = $vendorId";
    $productResult = $conn->query($productQuery);
} else {
    echo "Invalid vendor.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $vendor['storeName']; ?> - Products</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/vendor.css">
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
                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <a class="nav-link" href="cart.php">
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
        <h1 class="text-center">Products from <?php echo $vendor['storeName']; ?></h1>
        <div class="row">
            <?php
            if ($productResult->num_rows > 0) {
                while ($product = $productResult->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="' . $product['product_image'] . '" class="card-img-top" id="caro_img" alt="' . $product['product_name'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $product['product_name'] . '</h5>
                                <p class="card-text">Price: ₦' . $product['price'] . '</p>
                                <div class="quantity-controls d-flex align-items-center">
                                    <button class="btn btn-outline-secondary decrease-quantity" data-product-id="' . $product['product_id'] . '">-</button>
                                    <span class="mx-2" id="quantity-' . $product['product_id'] . '">0</span>
                                    <button class="btn btn-outline-secondary increase-quantity" data-product-id="' . $product['product_id'] . '">+</button>
                                </div>';

                    // Check if the current user is the vendor of the product
                    if ((int)$userId === (int)$vendorId) {
                        // If the user is the vendor, show "Edit"
                        echo '<a href="edit_product.php?product_id=' . $product['product_id'] . '" class="btn btn-warning mt-2">Edit</a>';
                    } else {
                        // If the user is not the vendor, show "Add to cart"
                        echo '<button class="btn btn-primary add-to-cart mt-2" 
                                data-product-id="' . $product['product_id'] . '" 
                                data-product-name="' . $product['product_name'] . '" 
                                data-product-price="' . $product['price'] . '" 
                                data-vendor-id="' . $product['vendor_id'] . '">Add to Cart</button>';
                    }
                    echo '
                            </div>
                        </div>
                    </div>';
                }
            }
            else {
                echo '<div class="col-12"><p class="text-center">No products available for this vendor.</p></div>';
            }
            ?>
        </div>
    </div>


    <script>
            document.addEventListener("DOMContentLoaded", function() {
            // Fetch vendor store names when the page loads
            fetchVendorStoreNames();
            
            const cartCount = <?php echo $cartCount; ?>;

            // Display the count in the span with id 'cart-number' only if it exists
            if(cartCount > 0) {
                    document.getElementById("cart-number").textContent = cartCount;
                    document.getElementById("cart-number").style.backgroundColor = "#d9534f";
                    document.getElementById("cart-number").style.color = "white";
                    document.getElementById("cart-number").style.borderRadius = "50%";
                    document.getElementById("cart-number").style.padding = ".1rem .4rem";
                    document.getElementById("cart-number").style.position = "absolute";
                    document.getElementById("cart-number").style.top = ".7rem";
                    document.getElementById("cart-number").style.left = "22.1rem";
                    document.getElementById("cart-number").style.fontSize = ".7rem";
            }
        });
          // Add event listeners for increase and decrease buttons
    document.querySelectorAll('.increase-quantity').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const quantityElement = document.getElementById('quantity-' + productId);
            let currentQuantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = currentQuantity + 1;
        });
    });

    document.querySelectorAll('.decrease-quantity').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const quantityElement = document.getElementById('quantity-' + productId);
            let currentQuantity = parseInt(quantityElement.textContent);
            if (currentQuantity > 0) {
                quantityElement.textContent = currentQuantity - 1;
            }
        });
    });

    // Add to Cart with updated quantity
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            const vendorId = this.getAttribute('data-vendor-id');
            const quantity = parseInt(document.getElementById('quantity-' + productId).textContent);

            if (quantity > 0) {
                // Add product to cart using AJAX with specified quantity
                addToCart(productId, productName, productPrice, vendorId, quantity); 
            } else {
                alert("Please select a quantity greater than 0.");
            }
        });
    });

    function addToCart(productId, productName, productPrice, vendorId, quantity) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Show success message
                alert("Successfully added to cart!");

                // Parse the JSON response for updated cart count
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Update the cart count display dynamically
                    updateCartCount(response.cartCount);
                }
            }
        };
        productId = parseInt(productId, 10);
        xhr.send("product_id=" + productId + "&product_name=" + productName + "&product_price=" + productPrice + "&vendor_id=" + vendorId + "&quantity=" + quantity);
    }

        function updateCartCount(cartCount) {
            const cartNumber = document.getElementById("cart-number");
            cartNumber.textContent = cartCount;
            cartNumber.style.backgroundColor = "#d9534f";
            cartNumber.style.color = "white";
            cartNumber.style.borderRadius = "50%";
            cartNumber.style.padding = ".1rem .4rem";
            cartNumber.style.position = "absolute";
            cartNumber.style.top = ".7rem";
            cartNumber.style.left = "22.1rem";
            cartNumber.style.fontSize = ".7rem";
        }



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
    <!-- Include Bootstrap JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
