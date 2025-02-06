<?php
include '/php/db.php';

if (isset($_POST['text'])) {
    $text = $conn->real_escape_string($_POST['text']);
    $sql = "INSERT INTO tasks (text) VALUES ('$text')";

    if ($conn->query($sql)) {
        echo "Task added";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
