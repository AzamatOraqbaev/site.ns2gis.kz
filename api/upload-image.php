<?php
// upload-image.php
require_once 'config.php';

try {
    if (!checkAuth()) {
        throw new Exception('Access denied');
    }
    
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('No image file uploaded');
    }
    
    $file = $_FILES['image'];
    
    // Проверка типа файла
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception('Invalid file type. Allowed: JPEG, PNG, GIF, WebP');
    }
    
    // Проверка размера (максимум 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception('File too large. Maximum size: 5MB');
    }
    
    // Генерация имени файла
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $filepath = getImagePath($filename);
    
    // Сохранение файла
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        echo json_encode([
            'success' => true,
            'url' => '../images/' . $filename,
            'filename' => $filename
        ]);
    } else {
        throw new Exception('Failed to save image');
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>