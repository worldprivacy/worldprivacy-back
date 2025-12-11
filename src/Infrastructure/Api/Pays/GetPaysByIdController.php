<?php

namespace WorldPrivacy\Infrastructure\Api\Pays;

use WorldPrivacy\Application\Service\Pays\GetPaysByIdService;
use WorldPrivacy\Infrastructure\Repository\PaysRepository;

class GetPaysByIdController
{
    public const ROUTE_PATH = '/pays';

    public function index(\PDO $pdo, string $id): \stdClass
    {
        $repository = new PaysRepository($pdo);
        $service = new GetPaysByIdService($repository);

        $pays = $service->execute($id);

        $response = new \stdClass();

        if (!$pays) {
            $response->error = "Aucun pays trouvé avec l'id: $id";
            return $response;
        }

        $response->pays = [
            'id' => (string) $pays->getPaysId(),
            'zone' => $pays->getZone(),
            'code_pays_iso' => $pays->getCodePaysIso(),
            'nom_pays' => $pays->getNomPays(),
            'nv_protection' => $pays->getNvProtection(),
            'createdAt' => $pays->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        return $response;
    }
}
