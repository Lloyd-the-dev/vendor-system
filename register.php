<?php  
    include "config.php";

    if(!empty($_POST["firstName"])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $userName = $_POST["userName"];
        $accType = $_POST["accType"];
        $hostel = $_POST["hostel"];
        $roomNo = $_POST["roomNo"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Query to check if the email already exists
        $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        // If email exists, show an alert and prevent insertion
        if(mysqli_num_rows($result) > 0) {
            echo '<script type ="text/JavaScript">'; 
            echo 'alert("Email is already registered. Please use a different email!");';
            echo 'window.location.href = "register.html";'; // Redirect back to registration page or wherever needed
            echo '</script>';  
        } else {
            $sql = "INSERT INTO `users` (`firstname`, `lastname`, `username`, `accType`, `hostel`, `roomNo`, `email`, `password`) VALUES 
            ('$firstName', '$lastName', '$userName', '$accType', '$hostel', '$roomNo', '$email', '$password')";

            $rs = mysqli_query($conn, $sql);

            if($rs)
            {
                echo '<script type ="text/JavaScript">'; 
                echo 'alert("Account successfully created!");';
                echo 'window.location.href = "index.html";';
                echo '</script>';  
            }

            mysqli_close($conn);
        }
       
    }


?>
 