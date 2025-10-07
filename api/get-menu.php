<?php
// get-menu.php
require_once 'config.php';

try {
    $menu = loadJSON('menu.json');
    $categories = loadJSON('categories.json');
    
    // Если категорий нет, создаем стандартные
    if (empty($categories)) {
        $categories = [
            'zavtraki' => ['name' => 'Завтраки', 'emoji' => '🥐'],
            'vypechka' => ['name' => 'Выпечка', 'emoji' => '🥖'],
            'sendvichi' => ['name' => 'Сэндвичи', 'emoji' => '🥪'],
            'salaty' => ['name' => 'Салаты', 'emoji' => '🥗'],
            'osnovnye' => ['name' => 'Основные блюда', 'emoji' => '🍝'],
            'myaso' => ['name' => 'Мясо и рыба', 'emoji' => '🥩'],
            'deserty' => ['name' => 'Десерты', 'emoji' => '🍰'],
            'napitki' => ['name' => 'Напитки', 'emoji' => '☕'],
            'alko' => ['name' => 'Алкоголь', 'emoji' => '🍷']
        ];
        saveJSON('categories.json', $categories);
    }
    
    // Если меню пустое, создаем демо-данные
    if (empty($menu)) {
        $menu = [
            'zavtraki' => [
                [
                    'id' => 1,
                    'name' => 'Итальянский завтрак',
                    'description' => 'Круассан, капучино и свежевыжатый апельсиновый сок',
                    'price' => 2500,
                    'image' => ''
                ],
                [
                    'id' => 2,
                    'name' => 'Авокадо-тост',
                    'description' => 'Хлеб на закваске с авокадо, яйцом пашот и рукколой',
                    'price' => 2800,
                    'image' => ''
                ]
            ],
            'napitki' => [
                [
                    'id' => 3,
                    'name' => 'Капучино',
                    'description' => 'Классический итальянский капучино с плотной пенкой',
                    'price' => 1200,
                    'image' => ''
                ],
                [
                    'id' => 4,
                    'name' => 'Лате',
                    'description' => 'Нежный кофейный напиток с молоком',
                    'price' => 1400,
                    'image' => ''
                ]
            ]
        ];
        saveJSON('menu.json', $menu);
    }
    
    echo json_encode([
        'success' => true,
        'menu' => $menu,
        'categories' => $categories
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>