<?php

// $_SESSION['name'] = 'Manav Vaishnani';
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$total = $db->query("SELECT sum(amount) as total FROM expenses")->get();

$monthTotal = $db->query("SELECT SUM(amount) AS monthTotal FROM expenses WHERE MONTH(created_at) = MONTH(CURRENT_DATE) AND YEAR(created_at) = YEAR(CURRENT_DATE);")->get();

$maxExpense = $db->query("SELECT MAX(amount) AS maxExpense FROM expenses WHERE MONTH(created_at) = MONTH(CURRENT_DATE) AND YEAR(created_at) = YEAR(CURRENT_DATE);")->get();

$group_totals = $db->query("SELECT eg.name AS group_name, SUM(e.amount) AS total_expense FROM expense_groups eg LEFT JOIN expenses e ON eg.id = e.group_id GROUP BY eg.id, eg.name ORDER BY eg.name; ")->get();

view("index.view.php", [
    'heading' => "Dashboard",
    'total' => $total,
    'monthTotal' => $monthTotal,
    'maxExpense' => $maxExpense,
    'group_totals' => $group_totals
]);