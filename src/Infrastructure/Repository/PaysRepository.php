<?php

namespace WorldPrivacy\Infrastructure\Repository;

use WorldPrivacy\Domain\Model\Question\Question;
use WorldPrivacy\Domain\Model\Pays\PaysRepositoryInterface;
use WorldPrivacy\Domain\Model\Pays\Pays;
use WorldPrivacy\Domain\Model\Pays\PaysId;

class PaysRepository implements PaysRepositoryInterface
{

    public function __construct(
        private \PDO $pdo
    ) {}

    public function add(Pays $question): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO pays (id, zone, code_pays_iso, nom_pays, nv_protection, created_at)
            VALUES (:id, :zone, :code_pays_iso, :nom_pays, :nv_protection, :created_at)
        ");

        $stmt->execute([
            ':id' => $question->getPaysId(),
            ':zone' => $question->getZone(),
            ':code_pays_iso' => $question->getCodePaysIso(),
            ':nom_pays' => $question->getNomPays(),
            ':nv_protection' => $question->getNvProtection(),
            ':created_at' => $question->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM pays");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Pays(
            paysId: new PaysId($row['id']),
            zone: $row['zone'],
            codePaysIso: $row['code_pays_iso'],
            nomPays: $row['nom_pays'],
            nvProtection: $row['nv_protection'],
            createdAt: new \DateTime($row['created_at'])
        ), $rows);
    }

    public function findById(PaysId $id): ?Pays
{
    $stmt = $this->pdo->prepare("SELECT * FROM pays WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => (string) $id]);

    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

    if (!$row) {
        return null; // Aucun pays trouvé
    }

    return new Pays(
        paysId: new PaysId($row['id']),
        zone: $row['zone'],
        codePaysIso: $row['code_pays_iso'],
        nomPays: $row['nom_pays'],
        nvProtection: $row['nv_protection'],
        createdAt: new \DateTime($row['created_at'])
    );
}

}
