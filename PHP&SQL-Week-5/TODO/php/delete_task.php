<?php
include 'db.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM tasks WHERE id = $id";

    if ($conn->query($sql)) {
        echo "Task deleted";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
