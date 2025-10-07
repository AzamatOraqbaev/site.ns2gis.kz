<?php
// save-menu.php
require_once 'config.php';

try {
    if (!checkAuth()) {
        throw new Exception('Access denied');
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($input === null) {
        throw new Exception('Invalid JSON data');
    }
    
    if (!isset($input['menu'])) {
        throw new Exception('Menu data is required');
    }
    
    if (saveJSON('menu.json', $input['menu'])) {
        echo json_encode([
            'success' => true,
            'message' => 'Menu saved successfully'
        ]);
    } else {
        throw new Exception('Failed to save menu data');
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>