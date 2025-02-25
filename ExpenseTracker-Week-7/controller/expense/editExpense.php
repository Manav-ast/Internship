<?php
use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

header('Content-Type: application/json');
// Validate incoming data
if (!isset($_POST['expense_name'], $_POST['id'], $_POST['amount'], $_POST['date'], $_POST['group_id'])) {
    echo json_encode(['errors' => ['general' => 'Missing required fields']]);
    exit();
}

$expense_name = $_POST['expense_name'];
$expense_id = $_POST['id'];
$expense_amount = $_POST['amount'];
$expense_date = $_POST['date'];
$group_id = $_POST['group_id'];

// Validate the data
$errors = [];
if (!Validator::required($expense_name, 'expense_name')) {
    $errors['expense_name'] = "Expense name is required";
}
if (!Validator::required($expense_amount, 'amount') || !is_numeric($expense_amount) || $expense_amount <= 0) {
    $errors['amount'] = "Amount must be a positive number";
}
if (!Validator::required($expense_date, 'date')) {
    $errors['date'] = "Date is required";
}
if (!Validator::required($group_id, 'group_id')) {
    $errors['group_id'] = "Group is required";
}

// Check if group exists
$group = $db->select('expense_categories', 'id', ['id' => $group_id])->find();

if (!$group) {
    $errors['group_id'] = "Selected group does not exist";
}

// If there are validation errors, return them
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit();
}

try {
    // Format the date
    $formatted_date = date('Y-m-d', strtotime($expense_date));

    // Update the expense using update method
    $updateData = [
        'expense_name' => $expense_name,
        'amount' => $expense_amount,
        'date' => $formatted_date,
        'group_id' => $group_id
    ];

    $whereCondition = ['id' => $expense_id];

    $db->update('expense', $updateData, $whereCondition);

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Expense updated successfully!'
    ]);

} catch (\Exception $e) {
    // Log the error
    error_log("Error updating expense: " . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    exit();
}
