<?php
namespace WorldPrivacy\Domain\Model\Pays;

final class PaysId
{
    public const PREFIX = "wp_pays_";
    private string $id;

     public function __construct(?string $defautId = null)
    {
        $this->id = ($defautId === null) ?
            self::PREFIX . uniqid() :
            $defautId;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(PaysId $id): bool
    {
        return $this->id == $id->id;
    }
}
