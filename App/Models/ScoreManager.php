<?php

require 'App/Models/Model.php';

/**
 * Ce fichier est l'entity manager de notre classe Score. Elle étent la classe abstraite Model
 */

class ScoreManager extends Model {

    // Fonction qui récupère les meilleurs scores
    public function getBestScores() {
        // Elle utilise la méthode "getBestst()" définie dans la classe Model
        // Qui prend en paramètre une table et un objet
        return $this->getBests('Score', 'Score');
    }

    // Fonction qui enregistre un nouveau score dans la base de données
    public function createScore(Score $score) {
        // Utilise la méthode storeNewScore() définie dans la classe Model
        return $this->storeNewScore($score);
    }
}