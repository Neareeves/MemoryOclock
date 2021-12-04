<?php
include('Models/Score.php');

if (isset($_POST['validate'])) {
    echo 'entered in post things';
    $score = $_POST['score'];
    $owner = $_POST['owner'];

    $storeScore = storeLastScore($score, $owner);


}

include('Views/ScoreView.php');