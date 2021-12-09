<?php

require 'App/Models/Model.php';


class ScoreManager extends Model {
    // On crée la fonction qui récupère les meilleurs scores
    public function getBestScores() {
        return $this->getBests('Score', 'Score');
    }

    public function createScore(Score $score) {

        return $this->storeNewScore($score);
    }
}