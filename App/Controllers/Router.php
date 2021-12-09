<?php
//namespace App\Controllers;
require_once 'public/Views/View.php';
class Router {
         
private $ctrl;
private $view;

public function routeReq() {
    
    try {

        // chargement automatique des classes du dossier Models
        // spl_autoload_register(function($class) {
        //     require_once('App/Models/'.$class.'.php');
        // });

       // on crée une cariable $url
       $url = '';
       // on détermine le controlleur en fonction de la valeur de cette variable
       if (isset($_GET['url'])) {

           // On décompose l'url et applique un filtre
           $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
           
           // On récupère le premier paramètre de l'url, qui sera le controller à aller chercher
           $controller = ucfirst(strtolower($url[0]));
           $controllerClass = $controller."Controller";
           $controllerFile = 'App/Controllers/'.$controller."Controller.php";

           if (file_exists($controllerFile)) {
               // Si le fichier existe on lance la classe trouvée
               //var_dump($controllerClass($url));
               
               require_once $controllerFile;
               $this->ctrl = new $controllerClass($url);
           } else {
               throw new \Exception('Page introuvable', 1);
           }
       }
       else {
        
           require_once(__DIR__.'/HomeController.php');
           $this->ctrl = new HomeController();
       }
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        $this->view = new View('404');
        $this->view->generate(array('errorMessage' => $errorMessage));

    }
}
}