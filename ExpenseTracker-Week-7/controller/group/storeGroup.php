<?php
use Core\Database;
use Core\Validator;

header('Content-Type: application/json'); // Set response header for JSON

$config = require base_path('config.php');
$db = new Database($config['database']);

// Validate input
$group_name = trim($_POST['group_name'] ?? '');

$errors = [];

if (!Validator::required($group_name, 'group_name')) {
    $errors['group_name'] = 'Group name is required';
}

if (strlen($group_name) > 255) {
    $errors['group_name'] = 'Group name cannot exceed 255 characters';
}

// Check if group name already exists
$existingGroup = $db->select('expense_categories', 'id', ['name' => $group_name])->find();

if ($existingGroup) {
    $errors['group_name'] = 'A group with this name already exists';
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
    exit();
}

try {
    // Insert the group using insert method
    $groupData = ['name' => $group_name];
    $db->insert('expense_categories', $groupData);

    echo json_encode([
        'success' => true,
        'message' => 'Group added successfully'
    ]);
} catch (Exception $e) {
    error_log("Error adding group: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'errors' => [
            'general' => 'An error occurred while adding the group'
        ]
    ]);
}
exit;