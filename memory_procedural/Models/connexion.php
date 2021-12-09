<?php 

// Les identifiants de l'utilisateur de la base de données sont dans un fichier à part pour éviter de les pusher dans le repository
// Le fichier database définit les variables suivantes : $host, $db, $user, $pass, $charset
include('database.php');

// initialisation de PDO qui nous servira à communiquer avec la base mysql
$dbh = "mysql:host=$host;dbname=$db;charset=$charset";

// On définit des options pour indiquer à PDO de quelle manière on souhaite recevoir les données
$options = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
	$dbh = new PDO($dbh, $user, $pass, $options);
	
} catch (PDOException $e) {
	// En cas d'échec de l'instanciation d'un objet PDO, on crée un message d'erreur
	echo 'Connexion échouée : ' . $e->getMessage();
}


?>