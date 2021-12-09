<?php
require_once 'public/Views/View.php';
//namespace App\Controllers;
//use ScoreManager;
require 'App/Models/ScoreManager.php';
class HomeController
{
    private $scoreManager;
    public function __construct(?array $url = [])
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } else {
            $this->scores();
        }
    }
    private function scores() {
        $this->scoreManager = new ScoreManager();
        $scores = $this->scoreManager->getBestScores();
        $this->view = new View('Home');
        $this->view->generate(array('scores' => $scores));
    }
}
