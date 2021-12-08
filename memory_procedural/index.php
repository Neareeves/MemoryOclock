<?php
// Si la variable $_GET['page'] de l'url contient quelque chose, on demande cette page
if(isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
}
else {
    $page = 'Home'; //Si il n'y a rien dans $_GET['page'], redirection vers la home page
}
$page = ucfirst($page); //On passe la première lettre en majuscule car les controlleurs possèdent des majuscules mais les URLs sont en général en minuscule


// On inclut le controller en fonction de la page demandée, qui renvoie lui-même vers la bonne vue
if (is_file('Controllers/'.$page.'Controller.php')){
    include ('Controllers/'.$page.'Controller.php');  
} 
// si pas de controller de ce nom, redirection vers la page 404
else {
   include ('Controllers/404.php');  
}

?>