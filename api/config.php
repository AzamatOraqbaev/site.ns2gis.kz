<?php
// config.php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Разрешить CORS preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Функция для получения пути к файлам данных
function getDataPath($filename) {
    $dir = __DIR__ . '/../data/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    return $dir . $filename;
}

// Функция для получения пути к изображениям
function getImagePath($filename = '') {
    $dir = __DIR__ . '/../images/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    return $dir . $filename;
}

// Функция для загрузки JSON
function loadJSON($filename) {
    $path = getDataPath($filename);
    if (file_exists($path)) {
        $json = file_get_contents($path);
        return json_decode($json, true) ?: [];
    }
    return [];
}

// Функция для сохранения JSON
function saveJSON($filename, $data) {
    $path = getDataPath($filename);
    $result = file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return $result !== false;
}

// Базовая проверка авторизации (можно усилить)
function checkAuth() {
    // Простая проверка - можно добавать реальную авторизацию
    return true;
}
?>