<?php
// Le controller inclut le ou les modèles
include('Models/Score.php');

// On stocke le résultat de la fonction getBestScoresEver() dans une variable qu'on récupèrera dans la vue
$bestScoresEver = getBestScoresEver();

// Puis inclut la vue
include('Views/HomeView.php');
?>