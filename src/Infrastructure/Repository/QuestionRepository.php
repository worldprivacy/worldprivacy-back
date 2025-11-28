<?php

namespace WorldPrivacy\Infrastructure\Repository;

use WorldPrivacy\Domain\Model\Question\Question;
use WorldPrivacy\Domain\Model\Question\QuestionId;
use WorldPrivacy\Domain\Model\Question\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function __construct(
        private \PDO $pdo
    ) {}

    public function add(Question $question): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO question (id,intitule, reponse, texte_vrai, texte_faux, created_at)
            VALUES (:id, :intitule, :reponse, :texte_vrai, :texte_faux, :created_at)
        ");

        $stmt->execute([
            ':id' => $question->getQuestionId(),
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
