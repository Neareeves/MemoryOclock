<?php
//le controlleur inclut le ou les modèles
include('Models/Score.php');

$numbers = [];

 for ($i=1; $i < 13; $i++) { 
     $numbers[$i] = $i; 
 };

 for ($i=13, $j=1; $i < 24, $j < 13; $i++, $j++) { 
     $numbers[$i] = $j; 
    
 };

shuffle($numbers);

//inclusion de la vue
include('Views/PlayView.php');
?>