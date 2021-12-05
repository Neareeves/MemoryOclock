<?php

include('connexion.php');

function getBestScoresEver() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Score ORDER BY     score ASC LIMIT 5');
    $stmt->execute();
    $bestScores = $stmt->fetchAll();
    return $bestScores;
}

function storeLastScore($score, $owner) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO `Score`(`Score`, `Owner`) VALUES (?, ?)');
    $stmt->execute([$score, $owner]);
    return $stmt->fetch();
}
function getLastRegisteredScore() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Score ORDER BY Id DESC LIMIT 1');
    $stmt->execute();
    return $stmt->fetch();
}