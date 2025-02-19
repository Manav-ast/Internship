<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// $expense = $db->query("SELECT * FROM expenses WHERE id = :id", [
//     'id' => $_GET['id']
// ])->findOrFail();


$expense = $db->query("SELECT e.id,e.name,e.amount,e.group_id, e.created_at,g.name as group_name FROM expenses e JOIN expense_groups g on e.group_id=g.id")->findOrFail();

// dd($expense);


view("expenses/show.view.php", [
    'heading' => 'Expense',
    'expense' => $expense
]);
