<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$groups = $db->query("SELECT * FROM expense_groups")->get();
// dd($groups);
$expense = $db->query("SELECT e.id,e.name,e.amount,e.group_id, e.created_at,g.name as group_name FROM expenses e JOIN expense_groups g on e.group_id=g.id")->findOrFail();

view("expenses/edit.view.php",[
    'heading' => 'Update expense',
    'errors' => [],
    'groups' => $groups,
    'expense' => $expense
]);