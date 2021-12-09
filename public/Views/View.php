<?php

/**
 * La class View nous permet de générer les vues associées aux controllers 
 * et d'aller chercher le bon fichier pour compléter la base Template.php
 */

class View
{
    // $file représente le fichier vue que l'on enverra via le controller
    private $file;

    // Le titre de la page 
    private $title;

    public function __construct($action)
    {
        $this->file = 'public/Views/' . $action . 'View.php';
    }

    // On crée une fonction qui génère et affiche la vue 
    // et lui envoie les données qu'on a récupérées dans la base de données et stockées dans $data
    public function generate($data)
    {

        // On définit le contenu à envoyer grâce à la méthode privée generateFile()
        $content = $this->generateFile($this->file, $data);

        // On définit le fichier qui correspond au controller, et qui viendra enrichir le template de base
        $view = $this->generateFile('public/Views/Template.php', array('title' => $this->title, 'content' => $content));
        echo $view;
    }

    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);

            // La méthode ob_start() permet de temporiser le chargement des données.
            // C'est-à-dire que les données sont mises de côté avant d'être envoyées au navigateur,
            // pour éviter que les données ne s'affichent avant que la vue ne soit chargée.

            // On Commence la temporisation
            ob_start();
            // On charge la vue
            require $file;

            // On arrête la temporisation une fois que la vue est chargée et peut être remplie avec les données
            return ob_get_clean();
        } else {
            // Si aucune vue n'est trouvée, on envoie un message d'erreur
            throw new Exception("Fichier introuvable", 1);
        }
    }
}
