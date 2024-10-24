<?php 
    include "config.php";

    // Query to fetch storeName and user_id where accType is 'Vendor'
    $sql = "SELECT storeName, user_id FROM users WHERE accType = 'Vendor'";
    $result = mysqli_query($conn, $sql);
    
    $vendors = [];
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Store both storeName and user_id in the array
            $vendors[] = [
                'storeName' => $row['storeName'], 
                'vendor_id' => $row['user_id'] // Treat user_id as vendor_id
            ];
        }
    }
    
    // Return the data as JSON
    echo json_encode($vendors);
?>
