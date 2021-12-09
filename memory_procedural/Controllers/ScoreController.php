<?php
// Le controller inclut le ou les modèles
include('Models/Score.php');

if (isset($_POST['validate'])) {
    // Si l'utilisateur vient de valider le formulaire après avoir gagné au jeu
    // On applique des filtres pour sécuriser et standardiser les données envoyées par l'utilisateur
    $rawScore = stripslashes(htmlspecialchars($_POST['score']));
    $owner = stripslashes(htmlspecialchars($_POST['owner']));
    // On applique un filtre pour afficher le score (nombre de secondes) au format "x min y s"
    $score=gmdate("i\m\i\\n s\s", $rawScore);

    // On enregistre le score grâce à la fonction storeLastScore() définie dans le modèle Score.php
    $storeScore = storeLastScore($rawScore, $owner);
    
}
// On récupère les cinq meilleurs scores pour les afficher également dans la vue
$bestScoresEver = getBestScoresEver();

// Puis inclut la vue
include('Views/ScoreView.php');