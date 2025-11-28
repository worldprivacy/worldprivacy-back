<?php

namespace WorldPrivacy\Infrastructure\Api\Pays;

use WorldPrivacy\Application\Service\Pays\GetPaysListService;
use WorldPrivacy\Infrastructure\Repository\PaysRepository;

class GetPaysListController
{
    public const ROUTE_PATH = '/pays/list';

    public function index(\PDO $pdo): \stdClass
    {
        $repository = new PaysRepository($pdo);
        $service = new GetPaysListService($repository);

        $paysList = $service->execute();

        $response = new \stdClass();
        $response->pays = array_map(function($pays) {
            return [
                'id' => (string) $pays->getPaysId(),
                'zone' => $pays->getZone(),
                'code_pays_iso' => $pays->getCodePaysIso(),
                'nom_pays' => $pays->getNomPays(),
                'nv_protection' => $pays->getNvProtection(),
                'createdAt' => $pays->getCreatedAt()->format('Y-m-d H:i:s'),
            ];
        }, $paysList);
        return $response;
    }
}