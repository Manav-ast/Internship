<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$expenses = $db->query("SELECT e.id,e.name,e.amount,e.group_id, e.created_at,g.name as group_name FROM expenses e JOIN expense_groups g on e.group_id=g.id")->get();
// dd($expenses);

view("expenses/index.view.php",[
    'heading' => 'Expenses', 
    'expenses' => $expenses
]);
