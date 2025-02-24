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
    $group = $db->query('SELECT id FROM expense_categories WHERE id = :id', [
        'id' => $_POST['group_id']
    ])->find();

    if (!$group) {
        echo json_encode([
            'success' => false,
            'errors' => ['group_id' => 'Selected group does not exist']
        ]);
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

    // Return success response with message
    echo json_encode([
        'success' => true,
        'message' => 'Expense added successfully!'
    ]);

} catch (\PDOException $e) {
    // Log the error with details
    error_log("Error storing expense: " . $e->getMessage());
    
    // Return error response with more details in development
    $errorMessage = 'An error occurred while saving the expense';
    if (in_array(getenv('APP_ENV'), ['local', 'development'])) {
        $errorMessage .= ': ' . $e->getMessage();
    }
    
    echo json_encode([
        'success' => false,
        'errors' => ['general' => $errorMessage]
    ]);
} catch (\Exception $e) {
    // Log other types of errors
    error_log("Unexpected error storing expense: " . $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'errors' => ['general' => 'An unexpected error occurred']
    ]);
}

exit();