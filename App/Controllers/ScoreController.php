<?php 
require_once 'public/Views/View.php';
require 'App/Models/ScoreManager.php';

/**
 * Controller de la page des meilleurs score
 * Récupère les données envoyées par le modèle et génère la vue correspondant
 */

class ScoreController {


    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } else {
            // Si l'url ne présente pas de défaut, on exécute la fonction show()
            $this->show();
        }
    }
    private function show() {
        // On crée une instance de l'entity manager
        $this->scoreManager = new ScoreManager();

        // On en profite pour récupérer les meilleurs scores que l'on affichera à l'utilisateur pour qu'il puisse se comparer avec les autres joueurs
        $bestScores = $this->scoreManager->getBestScores();

        // Si le formulaire a été validé :
        if (isset($_POST['validate'])) {
            // On récupère les variables envoyée en POST et on y applique des filtres afin de sécuriser les données et standardiser l'affichage
            $rawScore = stripslashes(htmlspecialchars($_POST['score']));
            $owner = ucfirst(strtolower(stripslashes(htmlspecialchars($_POST['owner']))));

            // On applique un filtre pour afficher le score (nombre de secondes) au format "x min y s"
            $scoreBeautified=gmdate("i\m\i\\n s\s", $rawScore);

            // Création d'une instance de Score
            $score = new Score();
            // On enregistre les bonnes données dans les bons attributs grâce aux setters
            $score->setOwner($owner);
            $score->setScore($rawScore);
            // Puis on enregistre le score grâce à l'entity manager et sa méthode "createScore()"
            $this->scoreManager->createScore($score);
       
                   
            // Création de la vue grâce à une instance de la classe View, à laquelle on associe les données
            $this->view = new View('Score');
            $this->view->generate(array('scores' => $bestScores, 'lastScore' => $scoreBeautified));

        } else {

            // Si aucun formulaire n'a été validé pour arriver sur la page "/Score", on n'envoie que les meilleurs scores à la vue que l'on génère     
            $this->view = new View('Score');
            $this->view->generate(array('scores' => $bestScores));
        }
    }
}