<?php

include('connexion.php');

/**
 * Score.php est le modèle lié à la table Score
 * C'est ce fichier qui communique avec la base de données et lui envoie les requètes SQL
 */

 // Fonction pour récupérer les 5 meilleurs scores
function getBestScoresEver() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Score ORDER BY score ASC LIMIT 5');
    $stmt->execute();
    $bestScores = $stmt->fetchAll();
    return $bestScores;
}

// Fonction pour enregistrer un score
function storeLastScore($score, $owner) {
    global $dbh;
    // On prépare la requète SQL sans y mettre directement les variables
    $stmt = $dbh->prepare('INSERT INTO `Score`(`Score`, `Owner`) VALUES (?, ?)');
    // Les variables à stocker sont injectées dans le tableau envoyé par la méthode execute()
    $stmt->execute([$score, $owner]);
    // On récupère le résultat
    return $stmt->fetch();
}

function getLastRegisteredScore() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Score ORDER BY Id DESC LIMIT 1');
    $stmt->execute();
    return $stmt->fetch();
}