<?php 
require_once 'public/Views/View.php';
require 'App/Models/ScoreManager.php';


class ScoreController {


    public function __construct($url)
    {

        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);

        } else {
            $this->show();
        }
    }
    private function show() {
        $this->scoreManager = new ScoreManager();
        if (isset($_POST['validate'])) {

            $rawScore = stripslashes(htmlspecialchars($_POST['score']));
            $owner = ucfirst(strtolower(stripslashes(htmlspecialchars($_POST['owner']))));
            $scoreBeautified=gmdate("i\m\i\\n s\s", $rawScore);
            
            $score = new Score();
            
            $score->setOwner($owner);
            $score->setScore($rawScore);
            
            $this->scoreManager->createScore($score);
            $bestScores = $this->scoreManager->getBestScores();
        
       
            $this->view = new View('Score');
            $this->view->generate(array('scores' => $bestScores, 'lastScore' => $scoreBeautified));
        } else {
            $bestScores = $this->scoreManager->getBestScores();
        
       
            $this->view = new View('Score');
            $this->view->generate(array('scores' => $bestScores));
        }
        

    }
    

}