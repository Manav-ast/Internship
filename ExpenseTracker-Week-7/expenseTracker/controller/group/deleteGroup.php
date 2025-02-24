<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

// Check for DELETE method (via POST with _method=DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
    header('Content-Type: application/json');
    
    $group_id = $_POST['id'] ?? '';
    
    if (empty($group_id)) {
        echo json_encode([
            'success' => false,
            'message' => 'Group ID is required'
        ]);
        exit();
    }

    try {
        // First check if the group exists
        $group = $db->query("SELECT id FROM expense_categories WHERE id = :id", [
            'id' => $group_id
        ])->find();

        if (!$group) {
            echo json_encode([
                'success' => false,
                'message' => 'Group not found'
            ]);
            exit();
        }

        // Delete the group using delete method
        $whereCondition = ['id' => $group_id];
        $db->delete('expense_categories', $whereCondition);
        
        echo json_encode([
            'success' => true,
            'message' => 'Group deleted successfully!'
        ]);
    } catch (Exception $e) {
        error_log("Error deleting group: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'Error deleting group'
        ]);
    }
    exit();
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit();
}