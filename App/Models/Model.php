<?php
//namespace App\Models;

//use PDO;

require 'App/Models/Score.php';
abstract class Model {
    private static $_bdd;
    private static function setBDD() {
        require 'database.php';
        self::$_bdd = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);

        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$_bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    protected function getBDD() {
        if (self::$_bdd == null) {
            self::setBDD();
            return self::$_bdd;
        }
    }
    protected function getBests($table, $obj) {
        $this->getBDD();
        $var = [];
        $query = self::$_bdd->prepare('SELECT * FROM '.$table.' ORDER BY score ASC LIMIT 5');
        $query->execute();

        // la variable $data va reccueillir les données et les stocker dans l'objet qu'on donnera
        while ($data = $query->fetch()) {
            $var[] = new $obj($data);
        }
        return $var;
        $query->closeCursor();
    }
    protected function storeNewScore(Score $score) {
        $this->getBDD();

        $query = self::$_bdd->prepare('INSERT INTO `Score`(`Score`, `Owner`) VALUES (:score, :owner)');
        $query->bindvalue(':score', $score->getScore());
        $query->bindvalue(':owner', $score->getOwner());
        $query->execute();       
    }
}