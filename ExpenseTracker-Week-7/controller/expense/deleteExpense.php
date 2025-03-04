<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

try {
    // Ensure 'id' is set before using it
    if (!isset($_POST['id'])) {
        throw new Exception('ID not provided');
    }

    // Verify the expense exists
    $expense = $db->select('expense', 'id', ['id' => $_POST['id']])->find();

    if (!$expense) {
        throw new Exception('Expense not found');
    }

    // Delete the expense using delete method
    $whereCondition = ['id' => $_POST['id']];
    $db->delete('expense', $whereCondition);

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Expense deleted successfully!'
    ]);

} catch (\Exception $e) {
    // Log the error
    error_log("Error deleting expense: " . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    exit();
}
