<?php
    include "config.php";
    session_start();
    $firstName = $_SESSION["name"];
    $role = $_SESSION["role"];
    $userId =  $_SESSION["user_id"];
    $orderCountQuery = "SELECT COUNT(*) AS order_count FROM orders WHERE vendor_id = ? OR user_id = ?";
    $stmt = $conn->prepare($orderCountQuery);
    $stmt->bind_param("ii", $userId, $userId);
    $stmt->execute();
    $orderCountResult = $stmt->get_result();
    $orderCount = $orderCountResult->fetch_assoc();
    $stmt->close();

    function displayVendorProducts($vendorId) {
        global $conn;
        $sql = "SELECT * FROM products WHERE vendor_id = '$vendorId' LIMIT 9";  // Limit to 9 products
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $firstRow = $result->fetch_assoc(); 
            $storeName = $firstRow['storeName'];

            echo '<section class="pt-5 pb-5 mt-5">';
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-6">';
            echo '<h3 class="mb-3">Best Sellers in '.$storeName.'</h3>';
            echo '</div>';
            echo '<div class="col-6 text-right">';
            echo '<a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">';
            echo '<i class="fa fa-arrow-left"></i>';
            echo '</a>';
            echo '<a class="btn btn-primary mb-3" href="#carouselExampleIndicators2" role="button" data-slide="next">';
            echo '<i class="fa fa-arrow-right"></i>';
            echo '</a>';
            echo '</div>';
            echo '<div class="col-12">';
            echo '<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">';
            echo '<div class="carousel-inner">';
            
            $result->data_seek(0); 
            $counter = 0;
            $row_counter = 0;
            $active_class = 'active';
            
            while ($row = $result->fetch_assoc()) {
                if ($counter % 3 == 0) { 
                    if ($row_counter > 0) echo '</div></div>'; 
                    echo '<div class="carousel-item ' . $active_class . '">';
                    echo '<div class="row">';
                    $active_class = ''; 
                }
                echo '<div class="col-md-4 mb-3">';
                echo '<div class="card">';
                echo '<img class="img-fluid" id="caro_img" alt="' . $row['product_name'] . '" src="' . $row['product_image'] . '">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">' . $row['product_name'] . '</h4>';
                echo '<p class="card-text">Price: ₦' . $row['price'] . '</p>';
                echo '<a href="#" class="btn btn-primary btn-block">Order Now</a>'; 
                echo '</div>';
                echo '</div>';
                echo '</div>';
                
                $counter++;
                $row_counter++;
            }
            
            echo '</div></div>'; 
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
            
        } else {
            echo "No products found for this vendor.";
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashboard.css">

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
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span id="order-number" class="badge bg-danger"><?php echo $orderCount['order_count']; ?></span>
                    </i>
                    <span class="">Orders</span>
                </a>
            </li>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" action="addProduct.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Product Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="productQuantity">Quantity</label>
                            <input type="number" class="form-control" id="productQuantity" name="productQuantity" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="productImg">Product Image</label>
                            <input type="file" class="form-control" id="productImg" name="productImg" required>
                        </div>
                        <input type="hidden" id="tonerId" name="tonerId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Add Product</button>
                </div>
            </div>
        </div>
    </div>



    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" id="caro-item">
                <img src="./img/snacks.jpg" class="w-100 object-fit-cover" alt="...">
                <div class="carousel-caption d-none d-md-block" id="caro-text">
                    <h1 style="font-size: 5rem">Hello, <?php echo $firstName; ?></h1>
                    <h5>Ore's Treats</h5>
                    <p>20% off on all snacks and goodies in Ore's Treats.</p>
                </div>
            </div>

            <div class="carousel-item" id="caro-item">
                <img src="./img/cereal.jpg" class="d-block w-100 object-fit-cover" alt="...">
                <div class="carousel-caption d-none d-md-block" id="caro-text">
                    <h1 style="font-size: 5rem">What are you getting today,  <?php echo $firstName; ?>?</h1>
                    <h5>Dave's Store</h5>
                    <p>New stock available in Dave's store, more cereals to your taste.</p>
                </div>
            </div>

            <div class="carousel-item" id="caro-item">
                <img src="./img/clothes2.jpg" class="d-block w-100 object-fit-cover" alt="...">
                <div class="carousel-caption d-none d-md-block" id="caro-text">
                    <h1 style="font-size: 5rem">Hello, <?php echo $firstName; ?></h1>
                    <h5>Maximillian's Wears</h5>
                    <p>See new incoming outfits to up your steeze game.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <?php  displayVendorProducts(5) ?>
    <?php  displayVendorProducts(6) ?>

    

    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        // Fetch vendor store names when the page loads
        fetchVendorStoreNames();
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


    function submitForm() {
        const form = document.getElementById('addProductForm');
        form.submit();
    }
    function submitForm() {
        // Get the form
        var form = document.getElementById('addProductForm');
        
        // Check if form inputs are valid
        if (form.checkValidity()) {
            // Submit the form
            form.submit();
        } else {
            // If form is invalid, show the validation messages
            form.reportValidity();
        }
    }


    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script type="text/javascript"src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
