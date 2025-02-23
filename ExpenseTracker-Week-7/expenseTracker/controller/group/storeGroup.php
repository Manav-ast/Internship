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
    $errors['group_name'] = 'Category name is required';
}

if (strlen($group_name) > 255) {
    $errors['group_name'] = 'Category name cannot exceed 255 characters';
}

// Check if group name already exists
$existingGroup = $db->query("SELECT id FROM expense_categories WHERE name = :name", [
    'name' => $group_name
])->find();

if ($existingGroup) {
    $errors['group_name'] = 'A category with this name already exists';
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
    exit();
}

try {
    $db->query("INSERT INTO expense_categories (name) VALUES (:name)", [
        'name' => $group_name
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Category added successfully'
    ]);
} catch (Exception $e) {
    error_log("Error adding category: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'errors' => [
            'general' => 'An error occurred while adding the category'
        ]
    ]);
}
