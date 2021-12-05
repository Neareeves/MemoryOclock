<?php
include('Models/Score.php');

if (isset($_POST['validate'])) {
    
    $rawScore = stripslashes(htmlspecialchars($_POST['score']));
    $owner = stripslashes(htmlspecialchars($_POST['owner']));
    $score=gmdate("i\m\i\\n s\s", $rawScore);
    $storeScore = storeLastScore($rawScore, $owner);

    $lastRegisteredScore = getLastRegisteredScore();
    
}
$bestScoresEver = getBestScoresEver();

include('Views/ScoreView.php');