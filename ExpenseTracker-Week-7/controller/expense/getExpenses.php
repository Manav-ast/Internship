<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

try {
    // Get all expenses with their group names
    $expenses = $db->query("
        SELECT 
            e.*,
            ec.name as category_name 
        FROM expense e 
        LEFT JOIN expense_categories ec ON e.group_id = ec.id 
        ORDER BY e.date DESC, e.id DESC
    ")->get();

    // Get summary data
    $totalExpense = $db->query("SELECT COALESCE(SUM(amount), 0) as total FROM expense")->find()['total'];
    
    $thisMonth = $db->query("
        SELECT COALESCE(SUM(amount), 0) as total 
        FROM expense 
        WHERE MONTH(date) = MONTH(CURRENT_DATE()) 
        AND YEAR(date) = YEAR(CURRENT_DATE())
    ")->find()['total'];
    
    $maxExpense = $db->query("
        SELECT COALESCE(MAX(amount), 0) as max_amount 
        FROM expense 
        WHERE MONTH(date) = MONTH(CURRENT_DATE()) 
        AND YEAR(date) = YEAR(CURRENT_DATE())
    ")->find()['max_amount'];

    echo json_encode([
        'success' => true,
        'expenses' => $expenses,
        'summary' => [
            'totalExpense' => $totalExpense,
            'thisMonth' => $thisMonth,
            'maxExpense' => $maxExpense
        ]
    ]);
} catch (Exception $e) {
    error_log("Error fetching expenses: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch expenses'
    ]);
}

exit;