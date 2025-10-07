<?php
// save-categories.php
require_once 'config.php';

try {
    if (!checkAuth()) {
        throw new Exception('Access denied');
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($input === null) {
        throw new Exception('Invalid JSON data');
    }
    
    if (!isset($input['categories'])) {
        throw new Exception('Categories data is required');
    }
    
    if (saveJSON('categories.json', $input['categories'])) {
        echo json_encode([
            'success' => true,
            'message' => 'Categories saved successfully'
        ]);
    } else {
        throw new Exception('Failed to save categories data');
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>