<?php

require __DIR__ . '/../vendor/autoload.php';

use WorldPrivacy\Domain\Model\Question\QuestionId;
use WorldPrivacy\Infrastructure\Repository\QuestionRepository;
use WorldPrivacy\Domain\Model\Question\Question;

$pdo = new PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');
$repository = new QuestionRepository($pdo);

echo "🗑️  Suppression des anciennes données \n";
$pdo->exec("DELETE FROM question");

echo "🌱 Insertion des données de la table 'question' (fictives pour le moment) \n";
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
echo "✅ Seed de la table 'question' effectué \n";