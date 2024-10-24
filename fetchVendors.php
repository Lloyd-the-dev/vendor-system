<?php 
    include "config.php";

    $sql = "SELECT storeName FROM users WHERE accType = 'Vendor'";
    $result = mysqli_query($conn, $sql);
    
    $storeNames = [];
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $storeNames[] = $row['storeName'];
        }
    }
    
    // Return the data as JSON
    echo json_encode($storeNames);
?>