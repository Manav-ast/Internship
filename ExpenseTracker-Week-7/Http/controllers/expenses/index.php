<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Fetch expenses grouped by group_name and sorted by group_name
$expenses = $db->query("SELECT e.id, e.name, e.amount, e.group_id, e.created_at, g.name as group_name 
                        FROM expenses e 
                        JOIN expense_groups g ON e.group_id = g.id 
                        ORDER BY g.name ASC")->get();

// Calculate total expenses per group
$groupTotals = [];
foreach ($expenses as $exp) {
    $groupName = $exp['group_name'];
    if (!isset($groupTotals[$groupName])) {
        $groupTotals[$groupName] = 0;
    }
    $groupTotals[$groupName] += $exp['amount'];
}

view("expenses/index.view.php", [
    'heading' => 'Expenses', 
    'expenses' => $expenses,
    'groupTotals' => $groupTotals
]);
