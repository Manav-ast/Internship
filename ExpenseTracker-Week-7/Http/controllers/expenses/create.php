<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$groups = $db->query("SELECT * FROM expense_groups")->get();
// dd($groups);
view("expenses/create.view.php",[
    'heading' => 'Add Group',
    'errors' => [],
    'groups' => $groups
]);