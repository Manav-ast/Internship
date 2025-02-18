<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$group = $db->query("SELECT * FROM expense_groups WHERE id = :id", [
    'id' => $_GET['id']
])->findOrFail();



view("groups/show.view.php", [
    'heading' => 'Group',
    'group' => $group
]);
