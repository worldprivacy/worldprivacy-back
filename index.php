<?php
header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';

use WorldPrivacy\Infrastructure\Api\Question\QuestionController;
use WorldPrivacy\Infrastructure\Api\ResponseData;

// Normalise l'URI (sans query string), supprime trailing slash sauf si racine
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');


switch ($uri) {
    case QuestionController::ROUTE_PATH:
        $controller = new QuestionController();
        $result = $controller->getListRandom();

        $response = new ResponseData(
            success: true,
            data: $result, // array → stdClass
        );
        break;

    default:
        http_response_code(404);
        $response = new ResponseData(
            success: false,
            error: "NOT_FOUND",
            error_message: "Route $uri not found"
        );
        break;
}

echo json_encode($response);
