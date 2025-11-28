<?php
header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';

use WorldPrivacy\Infrastructure\Api\Pays\GetPaysListController;
use WorldPrivacy\Infrastructure\Api\Question\GetQuestionsRandomController;
use WorldPrivacy\Infrastructure\Api\ResponseData;

// Liste des routes disponibles
$routes = [
    GetQuestionsRandomController::ROUTE_PATH => GetQuestionsRandomController::class,
    GetPaysListController::ROUTE_PATH => GetPaysListController::class,
];

// Normalise l'URI (sans query string), supprime trailing slash sauf si racine
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/data/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode(new ResponseData(success: false, error: 'DB_ERROR', error_message: $e->getMessage()));
    exit;
}

if (!isset($routes[$uri])) {
    http_response_code(404);
    echo json_encode(new ResponseData(success: false, error: 'NOT_FOUND', error_message: "Route $uri not found"));
    exit;
}

$controllerClass = $routes[$uri];
$controller = new $controllerClass();
$result = $controller->index($pdo);

$response = new ResponseData(
    success: true,
    data: $result, // array → stdClass
);

http_response_code(200);
echo json_encode($response);
