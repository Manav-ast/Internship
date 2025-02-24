<?php 
use Core\Database;

try {
    $config = require base_path('config.php');
    $db = new Database($config['database']);

    // Fetch groups with select method
    $groups = $db->select('expense_categories', '*')->get();

    // Fetch expenses with prepared statement and proper JOIN
    $expenses = $db->query("
        SELECT 
            e.*,
            ec.name as category_name
        FROM expense e
        LEFT JOIN expense_categories ec ON e.group_id = ec.id
        ORDER BY e.date DESC, e.id DESC
    ")->get();

    // Calculate total expense
    $totalExpense = $db->select('expense', 'COALESCE(SUM(amount), 0) as total')->find()['total'];

    // Calculate this month's total
    $thisMonth = $db->select('expense', 'COALESCE(SUM(amount), 0) as total', [
        'MONTH(date)' => 'MONTH(CURRENT_DATE())',
        'YEAR(date)' => 'YEAR(CURRENT_DATE())'
    ])->find()['total'];

    // Get highest expense this month
    $maxExpense = $db->select('expense', 'COALESCE(MAX(amount), 0) as max_amount', [
        'MONTH(date)' => 'MONTH(CURRENT_DATE())',
        'YEAR(date)' => 'YEAR(CURRENT_DATE())'
    ])->find()['max_amount'];

    views("index.view.php", [
        'groups' => $groups,
        'expenses' => $expenses,
        'totalExpense' => $totalExpense,
        'thisMonth' => $thisMonth,
        'maxExpense' => $maxExpense
    ]);

} catch (\Exception $e) {
    // Log error and show user-friendly message
    error_log("Database error: " . $e->getMessage());
    views("error.view.php", ['message' => 'An error occurred while fetching expense data']);
}