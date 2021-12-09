<?php
//namespace App\Models;

class Score {
    private $score;
    private $owner;
    

    public function __construct(?array $data=[])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
               
                $this->$method($value);

            }
        }
    }
    public function setOwner($owner) {
        $this->owner = $owner;
    }
    public function setScore($score) {
        $this->score = $score;
    }
    public function getOwner() {
        return $this->owner;
    }
    public function getScore() {
        return $this->score;
    }
}