<?php

require __DIR__ . '/../vendor/autoload.php';

use WorldPrivacy\Domain\Model\Pays\Pays;
use WorldPrivacy\Domain\Model\Pays\PaysId;

// Connexion à la base SQLite
$pdo = new PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "🗑️  Suppression des anciennes données \n";
$pdo->exec("DELETE FROM pays");


echo "🌱 Insertion des données de la table 'pays' \n";
$csvFile = __DIR__ . '/donnees/pays-donnees.csv';
if (!file_exists($csvFile)) {
    echo "❌ Fichier CSV introuvable : $csvFile\n";
    exit(1);
}
$handle = fopen($csvFile, 'r');
if ($handle === false) {
    echo "❌ Impossible d'ouvrir le fichier CSV.\n";
    exit(1);
}

$firstLine = true;
while (($data = fgetcsv($handle, 0, ';')) !== false) {
    if ($firstLine) { 
        $firstLine = false;
        continue;
    }

    [$zone, $codeIso, $nomPays, $nvProtection] = $data;

    $pays = new Pays(
        zone: $zone,
        code_pays_iso: $codeIso,
        nom_pays: $nomPays,
        nv_protection: $nvProtection,
        paysId: new PaysId(),
        createdAt: new DateTime()
    );

    $stmtInsert = $pdo->prepare("
        INSERT INTO pays (id, zone, code_pays_iso, nom_pays, nv_protection, created_at)
        VALUES (:id, :zone, :code_pays_iso, :nom_pays, :nv_protection, :created_at)
    ");

    $stmtInsert->execute([
        ':id' => (string)$pays->getPaysId(),
        ':zone' => $pays->getZone(),
        ':code_pays_iso' => $pays->getCodePaysIso(),
        ':nom_pays' => $pays->getNomPays(),
        ':nv_protection' => $pays->getNvProtection(),
        ':created_at' => $pays->getCreatedAt()->format('Y-m-d H:i:s'),
    ]);
}

fclose($handle);

echo "✅ Seed de la table 'pays' effectué \n";

