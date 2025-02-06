<?php
include 'db.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "UPDATE tasks SET completed = NOT completed WHERE id = $id";

    if ($conn->query($sql)) {
        echo "Task updated";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
