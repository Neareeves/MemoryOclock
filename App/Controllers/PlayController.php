<?php

require 'App/Models/ScoreManager.php';

/**
 * Controller de la page de jeu.
 * Récupère les données des Models et les renvoie vers la vue qu'il génère
 */

class PlayController
{
    
    public function __construct($url)
    {
        // On récupère un tableau dans lequel est stocké la fin de l'url, récupérée grace à $_GET, par le routeur
        // Il ne doit y avoir qu'un index. S'il y en a plus, on interjète une exception
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } else {
            // Si non, on exécute la fonction play()
            $this->play();
        }
    }

    // Fonction qui crée une variable $number qui servira à afficher les cartes de manière aléatoire sur le deck
    private function play() {

        // On crée un tableau
        $numbers = [];
        // On le remplit deux fois avec les chiffres de 1 à 12, comme les noms des cartes
        for ($i=13, $j=1; $i < 24, $j < 13; $i++, $j++) { 
            $numbers[$j] = $j;
            $numbers[$i] = $j; 
           
        };
       // On mélange le tableau pour que les cartes soient disposées aléatoirement
       shuffle($numbers);
       // On génère la vue en instanciant la classe View, et en utilisant sa méthode générate
       $this->view = new View('Play');
       // On envoie avec la vue le tableau des nombres
       $this->view->generate(array('numbers'=>$numbers));
    }

}