<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

try {
    $groups = $db->query("SELECT * FROM expense_categories ORDER BY name")->get();
    echo json_encode($groups);
} catch (Exception $e) {
    error_log("Error fetching groups: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'error' => 'Failed to fetch groups'
    ]);
}
