<?php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/models/Category.php';
require_once __DIR__ . '/../app/models/Book.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/BookController.php';

$controllerName = strtolower($_GET['controller'] ?? 'home');
$action = $_GET['action'] ?? 'index';

$controllerMap = [
    'home' => 'HomeController',
    'category' => 'CategoryController',
    'book' => 'BookController',
];

if (!isset($controllerMap[$controllerName])) {
    http_response_code(404);
    exit('Controller nije pronađen.');
}

$controllerClass = $controllerMap[$controllerName];
$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    exit('Akcija nije pronađena.');
}

$controller->$action();
