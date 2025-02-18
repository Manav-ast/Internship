<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// $currentUserId = 1;

$group = $db->query("SELECT * FROM expenses WHERE id = :id", [
    'id' => $_POST['id']
])->findOrFail();

// authorize($note['user_id'] === $currentUserId);

$db->query("DELETE FROM expenses WHERE id = :id", [
    'id' => $_POST['id']
]);

header('Location: /expenses');
exit();
