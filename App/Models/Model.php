<?php

require 'App/Models/Score.php';
/**
 * Ce fichier gère les interractions avec la base de données.
 * C'est ici qu'on instancie un nouvel objet PDO, qu'on lui ajoute des options (setAttributes) sur la manière dont il doit renvoyer les données
 * 
 */

abstract class Model {

    private static $_bdd;
    private static function setBDD() {
        require 'database.php';

        // *_bdd étant un attribut statique de cette class, on l'utilise avec self:: et non $this->
        self::$_bdd = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);

        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$_bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    // Récupère la connexion existante ou en crée une s'il n'y en a pas
    protected function getBDD() {
        if (self::$_bdd == null) {
            self::setBDD();
            return self::$_bdd;
        }
    }

    // Requète destinée à récupérer de la base de données, les cinq meilleurs scores
    // Elle prend en paramètre un nom de table et un objet
    protected function getBests($table, $obj) {
        $this->getBDD();
        $var = [];
        $query = self::$_bdd->prepare('SELECT * FROM '.$table.' ORDER BY score ASC LIMIT 5');
        $query->execute();

        // la variable $data va reccueillir les données et les stocker dans l'objet qu'on lui donne
        while ($data = $query->fetch()) {
            $var[] = new $obj($data);
        }
        return $var;
        $query->closeCursor();
    }

    // Requète destinée à stocker le score du joueur qui vient de réussir une partie
    protected function storeNewScore(Score $score) {
        $this->getBDD();

        // On prépare la requète puis, dans un second temps, on lie les valeurs de notre objet "Score"
        $query = self::$_bdd->prepare('INSERT INTO `Score`(`Score`, `Owner`) VALUES (:score, :owner)');
        $query->bindvalue(':score', $score->getScore());
        $query->bindvalue(':owner', $score->getOwner());
        $query->execute();       
    }
}