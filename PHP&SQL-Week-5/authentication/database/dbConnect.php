<?php
    $serverName = "localhost:3307";
    $userName = "root";
    $password = "";
    $dbName = "users";

    $conn = new mysqli($serverName, $userName, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
?>