<?php
include('Models/Score.php');

if (isset($_POST['validate'])) {
    
    $score = stripslashes(htmlspecialchars($_POST['score']));
    $owner = stripslashes(htmlspecialchars($_POST['owner']));

    $storeScore = storeLastScore($score, $owner);

    $lastRegisteredScore = getLastRegisteredScore();
    
}
$bestScoresEver = getBestScoresEver();

include('Views/ScoreView.php');