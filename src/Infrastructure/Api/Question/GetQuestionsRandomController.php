<?php
namespace WorldPrivacy\Infrastructure\Api\Question;

use WorldPrivacy\Application\Service\Question\GetRandomQuestionsService;
use WorldPrivacy\Infrastructure\Repository\QuestionRepository;

class GetQuestionsRandomController
{
    public const ROUTE_PATH = '/question/list-random';
    public function index(\PDO $pdo): \stdClass
    {
        $repository = new QuestionRepository($pdo);
        $service = new GetRandomQuestionsService($repository);

        $questions = $service->execute();

        $response = new \stdClass();
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
