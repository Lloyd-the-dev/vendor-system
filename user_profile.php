<?php
include "config.php";
session_start();
$firstName = $_SESSION["name"];
$role = $_SESSION["role"];
$userId =  $_SESSION["user_id"];

$cartCount = 0;

// Check if the user's cart exists and count items in it
if (isset($_SESSION['cart'][$userId])) {
    $cartCount = count($_SESSION['cart'][$userId]);
}
$sql = "SELECT * FROM users WHERE user_id = '$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Firstname = $row['firstname'];
    $Lastname = $row['lastname'];
    $Fullname = $row['firstname']. " " . $row['lastname'];
    $Email = $row['email'];
    $Password = $row["password"];

} else {
    echo "User not found.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $firstName; ?>'s Profile</title>
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
                <a class="nav-link" href="cart.php">
                    <i class='bx bx-cart-alt'></i>
                    <?php if ($cartCount > 0): ?>
                        <span id="cart-number" class=""><?php echo $cartCount; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="user_profile.php">
                  <i class='bx bx-user'></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./index.html" style="margin-left: 1.6rem">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>


    <div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" src="./img/user-profile.webp" width="90">
                    <span class="font-weight-bold"><?php echo $Firstname; ?></span>
                    <span class="text-black-50"><?php echo $Email; ?></span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-right">Edit Profile</h6>
                    </div>
                    <form action="user_profile.php" method="POST" onsubmit="return validatePasswords()">
                        <div class="row mt-2">
                                <div class="col-md-6"><input type="text" class="form-control" placeholder="first name" value="<?php echo $Firstname; ?>" name="first_name"></div>
                                <div class="col-md-6"><input type="text" class="form-control" value="<?php echo $Lastname; ?>" placeholder="Lastname" name="last_name"></div>
                        </div>
                        <div class="row mt-3">
                                <div class="col-md-6"><input type="text" class="form-control" placeholder="Email" value="<?php echo $Email; ?>" name="email"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <input type="password" id="newPassword" class="form-control" placeholder="New Password" name="new_password">
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="verifyPassword" class="form-control" placeholder="Verify Password" name="verify_password">
                            </div>                        
                        </div>
                        </div>
                        <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button></div>
                        </div>
                    </form>
                    
            </div>
    </div>
    <!-- </div> -->
    <script>
        function validatePasswords() {
            const newPassword = document.getElementById('newPassword').value;
            const verifyPassword = document.getElementById('verifyPassword').value;

            if (newPassword !== verifyPassword) {
                alert('Passwords do not match. Please try again.');
                return false;
            }
            return true;
        }

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
                document.getElementById("cart-number").style.left = "22.8rem";
                document.getElementById("cart-number").style.fontSize = ".7rem";
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
<?php
    if (isset($_POST['submit'])) {
        $userId = $_SESSION['user_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $newPassword = $_POST['new_password'];
    
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $firstName, $lastName, $email, $hashedPassword, $userId);
        } else {
            $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $firstName, $lastName, $email, $userId);
        }
    
        if ($stmt->execute()) {
            echo '<script type ="text/JavaScript">'; 
            echo 'alert("Profile Updated successfully");';
            echo 'window.location.href = "user_profile.php";'; 
            echo '</script>';  
        } else {
            echo '<script type ="text/JavaScript">'; 
            echo 'alert("error updating");';
            echo 'window.location.href = "user_profile.php";'; 
            echo '</script>'; 
        }
    
        $stmt->close();
        $conn->close();
    }


?>