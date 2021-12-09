<?php
// Le controller inclut le ou les modèles
include('Models/Score.php');

// On crée le tableau $numbers que l'on remplie des chiffres de 1 à 12, deux fois
$numbers = [];

 for ($i=1; $i < 13; $i++) { 
     $numbers[$i] = $i; 
 };

 for ($i=13, $j=1; $i < 24, $j < 13; $i++, $j++) { 
     $numbers[$i] = $j;     
 };
 
 // puis on mélange le tableau qui nous servira à générer les cartes sur le deck de manière aléatoire
shuffle($numbers);

// Puis inclut la vue
include('Views/PlayView.php');
?>