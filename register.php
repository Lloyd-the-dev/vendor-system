<?php  
    include "config.php";  // Assuming this file contains your DB connection code

    if(!empty($_POST["firstName"])){
        // Sanitize form inputs
        $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
        $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
        $userName = mysqli_real_escape_string($conn, $_POST["userName"]);
        $accType = mysqli_real_escape_string($conn, $_POST["accType"]);
        $hostel = mysqli_real_escape_string($conn, $_POST["hostel"]);
        $roomNo = mysqli_real_escape_string($conn, $_POST["roomNo"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        // Query to check if the email already exists
        $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        // If email exists, show an alert and prevent insertion
        if(mysqli_num_rows($result) > 0) {
            echo '<script type ="text/JavaScript">'; 
            echo 'alert("Email is already registered. Please use a different email!");';
            echo 'window.location.href = "register.html";'; // Redirect back to registration page
            echo '</script>';  
        } else {
            // For Vendor account types, retrieve the storeName and storeDescription
            $storeName = null;
            $storeDescription = null;
            if($accType === 'Vendor'){
                $storeName = mysqli_real_escape_string($conn, $_POST['storeName']);
                $storeDescription = mysqli_real_escape_string($conn, $_POST['storeDescription']);
            }

            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user details into the database
            $sql = "INSERT INTO `users` (`firstname`, `lastname`, `username`, `accType`, `hostel`, `roomNo`, `email`, `password`, `storeName`, `storeDescription`) 
                    VALUES ('$firstName', '$lastName', '$userName', '$accType', '$hostel', '$roomNo', '$email', '$hashedPassword', '$storeName', '$storeDescription')";

            // Execute the query
            $rs = mysqli_query($conn, $sql);

            if($rs) {
                echo '<script type ="text/JavaScript">'; 
                echo 'alert("Account successfully created!");';
                echo 'window.location.href = "index.html";'; // Redirect to login page
                echo '</script>';  
            } else {
                // In case of SQL errors, output the error message
                echo "Error: " . mysqli_error($conn);
            }

            // Close the database connection
            mysqli_close($conn);
        }
    } else {
        echo '<script type ="text/JavaScript">'; 
        echo 'alert("Please fill out all required fields.");';
        echo 'window.location.href = "register.html";'; // Redirect if no data is submitted
        echo '</script>';
    }
?>

 