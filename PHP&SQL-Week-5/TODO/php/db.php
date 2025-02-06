<?php
$host = "localhost:3307";
$user = "root"; // Change if needed
$pass = "";
$dbname = "todo_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>