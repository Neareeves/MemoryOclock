<?php
//le controlleur inclut le ou les modèles
include('Models/base.php');



$numbers = [];
for ($i=1; $i < 5; $i++) { 
    $numbers[$i] = $i; 
};

for ($i=5, $j=1; $i < 10, $j < 5; $i++, $j++) { 
    $numbers[$i] = $j; 
    
};
// for ($i=1; $i < 19; $i++) { 
//     $numbers[$i] = $i; 
// };

// for ($i=19, $j=1; $i < 36, $j < 19; $i++, $j++) { 
//     $numbers[$i] = $j; 
    
// };

shuffle($numbers);



//inclusion de la vue
include('Views/PlayView.php');
?>