<?php

require __DIR__ . '/../../../vendor/autoload.php'; // Autoload PSR-4

use WorldPrivacy\Application\Service\GetRandomQuestionsService;
use WorldPrivacy\Infrastructure\Repository\QuestionRepository;

header('Content-Type: application/json');

try {
    // Connexion PDO
    $pdo = new \PDO('sqlite:' . __DIR__ . '/../../../data/database.sqlite');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    // Repository
    $repository = new QuestionRepository($pdo);

    // Service
    $service = new GetRandomQuestionsService($repository);

    // Exécution
    $questions = $service->execute();

    // Formatage pour JSON
    $output = array_map(fn($q) => [
        'id' => (string)$q->getQuestionId(),
        'intitule' => $q->getIntitule(),
        'reponse' => $q->getReponse(),
        'texteVrai' => $q->getTexteVrai(),
        'texteFaux' => $q->getTexteFaux(),
        'createdAt' => $q->getCreatedAt()->format('Y-m-d H:i:s')
    ], $questions);

    echo json_encode($output, JSON_PRETTY_PRINT);

} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
