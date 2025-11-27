<?php

namespace WorldPrivacy\Domain\Model\Pays;

class Pays
{
    private \DateTime $createdAt;

    public function __construct(
        private string $zone,
        private string $codePaysIso,
        private string $nomPays,
        private string $nvProtection,
        private PaysId $paysId = new PaysId(),
        ?\DateTime $createdAt = null
    ) {
        $this->createdAt = $createdAt ?? new \DateTime();
    }

    public function getZone(): string
    {
        return $this->zone;
    }

    public function getCodePaysIso(): string
    {
        return $this->codePaysIso;
    }

    public function getNomPays(): string
    {
        return $this->nomPays;
    }

    public function getNvProtection(): string
    {
        return $this->nvProtection;
    }

    public function getPaysId(): PaysId
    {
        return $this->paysId;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
