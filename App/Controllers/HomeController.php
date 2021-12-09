<?php
require_once 'public/Views/View.php';
require 'App/Models/ScoreManager.php';

/**
 * Controller de la page d'accueil (un controller par vue)
 * Récupère les données des Models et les renvoie vers la vue qu'il génère
 */

class HomeController
{
    private $scoreManager;

    public function __construct(?array $url = [])
    {
        // On récupère un tableau dans lequel est stocké la fin de l'url, récupérée grace à $_GET, par le routeur
        // Il ne doit y avoir qu'un index. S'il y en a plus, on interjète une exception
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } else {
            // Si non, on exécute la méthode scores()
            $this->scores();
        }
    }

    // Fonction qui récupère les meilleurs scores enregistrés dans la base de données et génère la vue
    private function scores() {
        // On instancie la classe ScoreManager pour exécuter sa méthode getBestScores()
        $this->scoreManager = new ScoreManager();
        $scores = $this->scoreManager->getBestScores();
        // On instancie la classe View pour utiliser sa méthode generate()
        $this->view = new View('Home');
        // On envoie avec un tableau contenant les données récupérées par l'entity manager, que l'on stocke dans score
        $this->view->generate(array('scores' => $scores));
    }
}
