<?php

namespace WorldPrivacy\Infrastructure\Repository;

use WorldPrivacy\Domain\Model\Question\Question;
use WorldPrivacy\Domain\Model\Question\QuestionId;
use WorldPrivacy\Domain\Model\Question\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    private \PDO $pdo;

    public function __construct(
        \PDO $pdo
    ) {
        $this->pdo = $pdo;
        $this->initializeTable();
    }

    private function initializeTable(): void
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS question (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            intitule TEXT NOT NULL,
            reponse INTEGER NOT NULL,
            texte_vrai TEXT NOT NULL,
            texte_faux TEXT NOT NULL,
            created_at DATETIME NOT NULL
        )";
        $this->pdo->exec($sql);
    }

    public function save(Question $question): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO question (intitule, reponse, texte_vrai, texte_faux, created_at)
            VALUES (:intitule, :reponse, :texte_vrai, :texte_faux, :created_at)
        ");

        $stmt->execute([
            ':intitule' => $question->getIntitule(),
            ':reponse' => $question->getReponse() ? 1 : 0,
            ':texte_vrai' => $question->getTexteVrai(),
            ':texte_faux' => $question->getTexteFaux(),
            ':created_at' => $question->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @param int $limit
     * @return Question[]
     */
    public function findRandom(int $limit): array
    {
        $stmt = $this->pdo->query("SELECT * FROM question ORDER BY RANDOM() LIMIT " . (int)$limit);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Question(
            questionId: new QuestionId($row['id']),
            intitule: $row['intitule'],
            reponse: (bool)$row['reponse'],
            texteVrai: $row['texte_vrai'],
            texteFaux: $row['texte_faux'],
            createdAt: new \DateTime($row['created_at'])
        ), $rows);
    }
}
