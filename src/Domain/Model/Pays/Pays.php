<?php

namespace WorldPrivacy\Domain\Model\Pays;

class Pays
{
    private \DateTime $createdAt;

    public function __construct(
        private string $zone,
        private string $code_pays_iso,
        private string $nom_pays,
        private string $nv_protection,
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
        return $this->code_pays_iso;
    }

    public function getNomPays(): string
    {
        return $this->nom_pays;
    }

    public function getNvProtection(): string
    {
        return $this->nv_protection;
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
