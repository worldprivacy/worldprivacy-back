<?php
namespace WorldPrivacy\Infrastructure\Api\Question;

use stdClass;
use WorldPrivacy\Application\Service\GetRandomQuestionsService;
use WorldPrivacy\Infrastructure\Repository\QuestionRepository;

final class QuestionController
{
    public const ROUTE_PATH = '/question/list-random';
    public function getListRandom(): \stdClass
    {
        $pdo = new \PDO('sqlite:' . __DIR__ . '/../../../../data/database.sqlite');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $repository = new QuestionRepository($pdo);
        $service = new GetRandomQuestionsService($repository);

        $questions = $service->execute();

        $response = new stdClass();
        $response->questions = array_map(function($q) {
            return [
                'id' => (string) $q->getQuestionId(),
                'intitule' => $q->getIntitule(),
                'reponse' => $q->getReponse(),
                'texteVrai' => $q->getTexteVrai(),
                'texteFaux' => $q->getTexteFaux(),
                'createdAt' => $q->getCreatedAt()->format('Y-m-d H:i:s'),
            ];
        }, $questions);
        return $response;
    }
}
