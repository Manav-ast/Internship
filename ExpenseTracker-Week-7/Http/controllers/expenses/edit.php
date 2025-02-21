<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$groups = $db->query("SELECT * FROM expense_groups")->get();
// dd($groups);
$expense = $db->query("SELECT * FROM expenses WHERE id = :id",[
    'id' => $_GET['id']
])->findOrFail();

view("expenses/edit.view.php",[
    'heading' => 'Update expense',
    'errors' => [],
    'groups' => $groups,
    'expense' => $expense
]);