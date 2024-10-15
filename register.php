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

        $sql = "INSERT INTO `users` (`firstname`, `lastname`, `username`, `accType`, `hostel`, `roomNo`, `email`, `password`) VALUES 
        ('$firstName', '$lastName', '$userName', '$accType', '$hostel', '$roomNo', '$email', '$password')";

        $rs = mysqli_query($conn, $sql);

        if($rs)
        {
            echo '<script type ="text/JavaScript">'; 
            echo 'alert("Account successfully created!")';
            echo 'window.location.href = "index.html";';
            echo '</script>';  
        }

        mysqli_close($conn);
    }


?>