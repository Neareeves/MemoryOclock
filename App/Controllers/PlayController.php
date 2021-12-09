<?php
//namespace App\Controllers;

//use ScoreManager;
require 'App/Models/ScoreManager.php';
class PlayController
{
    
    public function __construct($url)
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } else {
            $this->play();
        }
    }
    private function play() {
        $numbers = [];

        for ($i=1; $i < 13; $i++) { 
            $numbers[$i] = $i; 
        };
       
        for ($i=13, $j=1; $i < 24, $j < 13; $i++, $j++) { 
            $numbers[$i] = $j; 
           
        };
       
       shuffle($numbers);
       
       $this->view = new View('Play');
       $this->view->generate(array('numbers'=>$numbers));
    }

}