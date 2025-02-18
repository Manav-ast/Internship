<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// $currentUserId = 1;


$group = $db->query("SELECT * FROM expense_groups WHERE id = :id", [
    'id' => $_GET['id']
])->findOrFail();

// authorize($note['user_id'] === $currentUserId);

view("groups/show.view.php", [
    'heading' => 'Group',
    'group' => $group
]);
