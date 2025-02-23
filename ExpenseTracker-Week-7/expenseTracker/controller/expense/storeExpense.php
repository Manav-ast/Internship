<?php
use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

// Validate the expense data
if (!Validator::validateExpense($_POST)) {
    $errors = Validator::getErrors();
    // Return errors as JSON
    header('Content-Type: application/json');
    echo json_encode(['errors' => $errors]);
    exit();
}

// Format the date
$date = $_POST['date'];
$date = date('Y-m-d', strtotime($date));
$currentDateTime = date('Y-m-d H:i:s');

try {
    // Verify that the group exists
    $group = $db->query('SELECT id FROM expense_categories WHERE id = :id', [
        'id' => $_POST['group_id']
    ])->find();

    if (!$group) {
        header('Content-Type: application/json');
        echo json_encode(['errors' => ['group_id' => 'Selected group does not exist']]);
        exit();
    }

    // Insert the expense
    $db->query('INSERT INTO expense (expense_name, amount, date, group_id, created_at) VALUES (:expense_name, :amount, :date, :group_id, :created_at)', [
        'expense_name' => $_POST['expense_name'],
        'amount' => $_POST['amount'],
        'date' => $date,
        'group_id' => $_POST['group_id'],
        'created_at' => $currentDateTime
    ]);

    // Return success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);

} catch (\Exception $e) {
    // Log the error
    error_log("Error storing expense: " . $e->getMessage());
    
    // Return error response
    header('Content-Type: application/json');
    echo json_encode(['errors' => ['general' => 'An error occurred while saving the expense']]);
}

exit();