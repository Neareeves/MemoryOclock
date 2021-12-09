<?php

require_once('App/Controllers/Router.php');

/**
 * L'index récupère toutes les requètes et met en route le router pour trouver les bons fichiers à envoyer
 */

$router = new Router();
$router->routeReq();