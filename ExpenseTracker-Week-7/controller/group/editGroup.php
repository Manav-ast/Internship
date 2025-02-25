<?php 

use Core\Database;
use Core\Validator;


header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

// Validate incoming data
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['errors' => ['general' => 'Invalid request method']]);
    exit();
}

// Get the request body
if (!isset($_POST['group_name'], $_POST['group_id'])) {
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

// Check if the new group name already exists (excluding the current group)
$existingGroup = $db->select('expense_categories', 'id', ['name' => $group_name])->find();
if ($existingGroup && $existingGroup['id'] !== $group_id) {
    $errors['group_name'] = 'A group with this name already exists';
}

// If there are validation errors, return them
if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    exit();
}

try {
    // Update the group using update method
    $updateData = ['name' => $group_name];
    $whereCondition = ['id' => $group_id];
    $db->update('expense_categories', $updateData, $whereCondition);

    // Return success response
    echo json_encode(['success' => true]);

} catch (\Exception $e) {
    // Log the error
    error_log("Error updating group: " . $e->getMessage());
    
    // Return error response
    echo json_encode(['errors' => ['general' => 'An error occurred while updating the group']]);
}
