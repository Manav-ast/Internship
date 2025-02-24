<?php 

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

// Validate incoming data
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['errors' => ['general' => 'Invalid request method']]);
    exit();
}

// Get the request body
if (!isset($_POST['group_name'], $_POST['group_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['errors' => ['general' => 'Missing required fields']]);
    exit();
}

$group_name = trim($_POST['group_name']);
$group_id = $_POST['group_id'];

// Validate the data
$errors = [];
if (!Validator::required($group_name, 'group_name')) {
    $errors['group_name'] = "Group name is required";
}

// Check if group exists
$group = $db->select('expense_categories', 'id', ['id' => $group_id])->find();

if (!$group) {
    $errors['group_id'] = "Group does not exist";
}

// If there are validation errors, return them
if (!empty($errors)) {
    header('Content-Type: application/json');
    echo json_encode(['errors' => $errors]);
    exit();
}

try {
    // Update the group
    $db->query('UPDATE expense_categories SET name = :name WHERE id = :id', [
        'name' => $group_name,
        'id' => $group_id
    ]);

    // Return success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);

} catch (\Exception $e) {
    // Log the error
    error_log("Error updating group: " . $e->getMessage());
    
    // Return error response
    header('Content-Type: application/json');
    echo json_encode(['errors' => ['general' => 'An error occurred while updating the group']]);
}

exit();