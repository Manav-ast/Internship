<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$groups = $db->query("SELECT * FROM expense_groups")->get();

view("groups/index.view.php",[
    'heading' => 'Groups',
    'groups' => $groups
]);
