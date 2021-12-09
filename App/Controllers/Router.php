<?php

require_once 'public/Views/View.php';

/**
 * Routeur, identifie l'url et redirige vers le bon controller 
 */
class Router
{

    private $ctrl;
    private $view;

    public function routeReq()
    {

        // La fonction est placée dans un try and catch pour que l'on puisse récupérer un message d'erreur si jamais ça ne marche pas
        try {

            // Chargement automatique des classes du dossier Models
            spl_autoload_register(function ($class) {
                require_once('App/Models/' . $class . '.php');
            });

            // On crée une variable $url
            $url = '';
            // On va identifier le bon controlleur en fonction de la valeur de cette variable
            if (isset($_GET['url'])) {

                // On décompose l'url et applique un filtre
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                // On récupère le premier paramètre de l'url, qui sera le controller à aller chercher
                $controller = ucfirst(strtolower($url[0]));
                // On génère le nom de la classe à partir de l'url, puis le nom du fichier à aller chercher
                $controllerClass = $controller . "Controller";
                $controllerFile = 'App/Controllers/' . $controller . "Controller.php";

                if (file_exists($controllerFile)) {
                    // Si le fichier existe, on lance la classe trouvée               
                    require_once $controllerFile;
                    $this->ctrl = new $controllerClass($url);
                } else {
                    // S'il n'existe pas, on envoie une exception
                    throw new \Exception('Controller not found', 1);
                }
            } else {
                // Si aucune variable en GET n'est envoyée par l'url, on ira par défaut chercher le controller Home
                require_once(__DIR__ . '/HomeController.php');
                $this->ctrl = new HomeController();
            }
        } catch (\Exception $e) {
            // En cas de mauvais url, on redirige vers la page 404
            $errorMessage = $e->getMessage();
            $this->view = new View('404');
            $this->view->generate(array('errorMessage' => $errorMessage));
        }
    }
}
