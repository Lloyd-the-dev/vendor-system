<?php
// Include database connection
include('config.php'); 
session_start();
$firstName = $_SESSION["name"];
$role = $_SESSION["role"];
$userId =  $_SESSION["user_id"];

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
            <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
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
                <a class="nav-link" href="./index.html">Logout</a>
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
                                <p class="card-text">Price: $' . $product['price'] . '</p>';
                                 // Check if the current user is the vendor of the product
                                 if ((int)$userId === (int)$vendorId) {
                                    // If the user is the vendor, show "Edit"
                                    echo '<a href="edit_product.php?product_id=' . $product['product_id'] . '" class="btn btn-warning">Edit</a>';
                                } else {
                                    // If the user is not the vendor, show "Add to cart"
                                    echo '<button class="btn btn-primary add-to-cart" data-product-id="' . $product['product_id'] . '" data-product-name="' . $product['product_name'] . '" data-product-price="' . $product['price'] . '">Add to Cart</button>';
                                }
                                echo '
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="col-12"><p class="text-center">No products available for this vendor.</p></div>';
            }
            ?>
        </div>
    </div>


    <script>
            document.addEventListener("DOMContentLoaded", function() {
            // Fetch vendor store names when the page loads
            fetchVendorStoreNames();
        });


        // Add event listener for Add to Cart buttons
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                const productPrice = this.getAttribute('data-product-price');

                // Add product to cart using AJAX
                addToCart(productId, productName, productPrice);
            });
        });
    });

    function addToCart(productId, productName, productPrice) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText); // Show success message
            }
        };
        xhr.send("product_id=" + productId + "&product_name=" + encodeURIComponent(productName) + "&product_price=" + productPrice);
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
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script type="text/javascript"src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
