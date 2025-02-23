<?php 
use Core\Database;

try {
    $config = require base_path('config.php');
    $db = new Database($config['database']);

    // Fetch groups with prepared statement
    $groups = $db->query("SELECT * FROM expense_categories")->get();

    // Fetch expenses with prepared statement and proper JOIN
    $expenses = $db->query("
        SELECT 
            e.id,
            e.expense_name,
            e.amount,
            e.date,
            e.created_at,
            e.group_id,
            ec.name as category_name
        FROM expense e
        JOIN expense_categories ec ON e.group_id = ec.id
        ORDER BY e.created_at DESC
    ")->get();

    // Fetch all required data in a single query using subqueries
    $stats = $db->query("
        SELECT 
            (SELECT SUM(amount) FROM expense) as total_expense,
            (SELECT MAX(amount) FROM expense 
             WHERE MONTH(date) = MONTH(CURRENT_DATE())
            ) as max_expense,
            (SELECT SUM(amount) FROM expense 
             WHERE MONTH(date) = MONTH(CURRENT_DATE())
             AND YEAR(date) = YEAR(CURRENT_DATE())
            ) as total_this_month
    ")->find();

    views("index.view.php", [
        'groups' => $groups,
        'expenses' => $expenses,
        'totalExpense' => $stats['total_expense'] ?? 0,
        'maxExpense' => $stats['max_expense'] ?? 0,
        'thisMonth' => $stats['total_this_month'] ?? 0
    ]);

} catch (\Exception $e) {
    // Log error and show user-friendly message
    error_log("Database error: " . $e->getMessage());
    views("error.view.php", ['message' => 'An error occurred while fetching expense data']);
}