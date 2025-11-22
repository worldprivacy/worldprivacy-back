<?php

require __DIR__ . '/../vendor/autoload.php';

$pdo = new PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');

// Crée la table question
$sql = "
CREATE TABLE IF NOT EXISTS question (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    intitule TEXT NOT NULL,
    reponse INTEGER NOT NULL,
    texte_vrai TEXT NOT NULL,
    texte_faux TEXT NOT NULL,
    created_at DATETIME NOT NULL
)";
$pdo->exec($sql);

echo "Base SQLite initialisée ✅\n";
