<?php

namespace WorldPrivacy\Application\Service\Pays;

use WorldPrivacy\Domain\Model\Pays\PaysRepositoryInterface;
use WorldPrivacy\Domain\Model\Pays\PaysId;
use WorldPrivacy\Domain\Model\Pays\Pays;

class GetPaysByIdService
{
    public function __construct(
        private PaysRepositoryInterface $paysRepository
    ) {}

    /**
     * @return Pays|null
     */
    public function execute(string $id): ?Pays
    {
        return $this->paysRepository->findById(new PaysId($id));
    }
}
