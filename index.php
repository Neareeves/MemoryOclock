<?php

//require __DIR__.'/vendor/autoload.php';
//use App\Controllers\Router;


require_once('App/Controllers/Router.php');

$router = new Router();
$router->routeReq();