<?php
//le controlleur inclut le ou les modèles
include('Models/Score.php');

$bestScoresEver = getBestScoresEver();





//inclusion de la vue
include('Views/HomeView.php');
?>