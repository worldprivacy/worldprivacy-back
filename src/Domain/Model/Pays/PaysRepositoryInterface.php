<?php

namespace WorldPrivacy\Domain\Model\Pays;

interface PaysRepositoryInterface
{
    public function add(Pays $pays): void;
    /**
     * @return Pays[]
     */
    public function findAll(): array;
}
