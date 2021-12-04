<?php

include('connexion.php');

function getBestScoresEver() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Score ORDER BY     score DESC LIMIT 10');
    $stmt->execute();
    $bestScores = $stmt->fetchAll();
    return $bestScores;
}

function storeLastScore($score, $owner) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO `Score`(`Score`, `Owner`) VALUES (?,?)');
    $stmt->execute($score, $owner);
    return $stmt->fetch();
}