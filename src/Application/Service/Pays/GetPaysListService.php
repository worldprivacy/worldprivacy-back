<?php

namespace WorldPrivacy\Application\Service\Pays;

use WorldPrivacy\Domain\Model\Pays\PaysRepositoryInterface;
use WorldPrivacy\Domain\Model\Pays\Pays;

class GetPaysListService{

    public function __construct(
        private PaysRepositoryInterface $paysRepository
    ) {}

    /**
     * @return Pays[]
     */
    public function execute(): array
    {
        return $this->paysRepository->findAll();
    }

}