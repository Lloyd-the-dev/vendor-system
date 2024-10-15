<?php 

include "config.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    if($count == 1){
        session_start();
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["name"] = $row["firstname"];
        $_SESSION["mail"] = $row["email"];
        header("Location: dashboard.php");
        
    }  
    else{  
        echo '<script type="text/JavaScript">';
        echo 'alert("Invalid credentials, try again!");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    }     

    $conn->close();
?>