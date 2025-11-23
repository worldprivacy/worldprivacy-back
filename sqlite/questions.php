<?php

require __DIR__ . '/../vendor/autoload.php';

use WorldPrivacy\Domain\Model\Question\QuestionId;
use WorldPrivacy\Infrastructure\Repository\QuestionRepository;
use WorldPrivacy\Domain\Model\Question\Question;

$pdo = new PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');
$repository = new QuestionRepository($pdo);

$stmt = $pdo->query("SELECT COUNT(*) as count FROM question");
$count = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;

if ($count > 0) {
    echo "✔️ Base déjà remplie, seed ignoré.\n";
    exit;
}

echo "🌱 Insertion de données fictives...\n";

for ($i = 1; $i <= 20; $i++) {
    $question = new Question(
        questionId: new QuestionId(),
        intitule: "Intitulé de la question $i",
        reponse: (bool)random_int(0, 1),
        texteVrai: "Texte vrai pour la question $i",
        texteFaux: "Texte faux pour la question $i",
        createdAt: new DateTime()
    );

    $repository->save($question);
}

echo "✅ Seed terminé : 20 questions ajoutées.\n";
