<?php
/**
 * La Classe Score représente l'entité Score : Le score que nous stockerons à la fin d'une partie réussie
 * Elle possède deux attributs : score (le temps mis par l'utilisateur pour terminer la partie) et owner (le prénom du joueur)
 */

class Score {
    // Les attributs sont privés, on ne peut y accéder en dehors de la classe qu'en passant par une méthode
    private $score;
    private $owner;
    
    // Les deux fonctions suivantes ont pour objectif d'hydrater l'entité avec des valeurs, lorsqu'il y en a
    // c'est-à-dire lui donner ce dont elle a besoin pour remplir l'objet que l'on vient d'instancer
    public function __construct(?array $data=[])
    {
        $this->hydrate($data);
    }

    // Chaque clé du tableau $data correspond à un attribut. 
    // En ajoutant une majuscule au début et en concaténant l'expression, on peut accéder au setter de chacune des clés. 
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) { 
                $this->$method($value);
            }
        }
    }

    // Setters des attributs. Permettent d'assigner une valeur à l'objet $score, instancié à partir de la classe Score
    public function setOwner($owner) {
        $this->owner = $owner;
    }
    public function setScore($score) {
        $this->score = $score;
    }

    // Getters des attributs. Permettent de récupérer une valeur de l'objet $score
    public function getOwner() {
        return $this->owner;
    }
    public function getScore() {
        return $this->score;
    }
}