<?php

require __DIR__ . '/../vendor/autoload.php';

$pdo = new \PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');

// Crée la table question
$sql = "
CREATE TABLE IF NOT EXISTS question (
    id TEXT PRIMARY KEY,
    intitule TEXT NOT NULL,
    reponse INTEGER NOT NULL,
    texte_vrai TEXT NOT NULL,
    texte_faux TEXT NOT NULL,
    created_at DATETIME NOT NULL
)";
$pdo->exec($sql);

$sql = "
CREATE TABLE IF NOT EXISTS pays (
    id TEXT PRIMARY KEY,
    zone TEXT NOT NULL,
    code_pays_iso  INTEGER NOT NULL,
    nom_pays TEXT NOT NULL,
    nv_protection TEXT NOT NULL,
    created_at DATETIME NOT NULL
)";

$pdo->exec($sql);

echo "Base SQLite initialisée ✅\n";
