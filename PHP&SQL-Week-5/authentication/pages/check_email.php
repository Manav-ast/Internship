<?php

    include '../dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        
        $stmt = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            echo "Email ID already exists!";
        }else{
            echo "Email ID does not exist!";
        }

        $stmt->close();
        $conn->close();
    }
?>