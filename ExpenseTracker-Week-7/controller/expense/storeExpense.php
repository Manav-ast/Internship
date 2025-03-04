<?php
use Core\Database;
use Core\Validator;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

// Validate the expense data
if (!Validator::validateExpense($_POST)) {
    $errors = Validator::getErrors();
    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
    exit();
}

// Format the date
$date = $_POST['date'];
$date = date('Y-m-d', strtotime($date));
$currentDateTime = date('Y-m-d H:i:s');

try {
    // Verify that the group exists
    $group = $db->select('expense_categories', 'id', ['id' => $_POST['group_id']])->find();

    if (!$group) {
        echo json_encode([
            'success' => false,
            'errors' => ['group_id' => 'Selected group does not exist']
        ]);
        exit();
    }

    // Insert the expense using the insert method
    $expenseData = [
        'expense_name' => $_POST['expense_name'],
        'amount' => $_POST['amount'],
        'date' => $date,
        'group_id' => $_POST['group_id'],
        'created_at' => $currentDateTime
    ];
    
    $db->insert('expense', $expenseData);

    // Return success response with message
    echo json_encode([
        'success' => true,
        'message' => 'Expense added successfully!'
    ]);

} catch (\Exception $e) {
    // Log the error
    error_log("Error adding expense: " . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

exit();