<?php

class View
{
    // le fichier vue qu'on enverra
    private $file;
    // le titre de la page 
    private $title;
    public function __construct($action)
    {
        $this->file = 'public/Views/' . $action . 'View.php';
    }
    // On crée une fonction qui génère et affiche la vue et lui envoie les données qu'on a récupérées dans la base de données et stockés dans $data
    public function generate($data) {
        // On définit le contenu à envoyer
        $content = $this->generateFile($this->file, $data);
        // On définie le fichier à envoyer
        $view = $this->generateFile('public/Views/Template.php', array('title' => $this->title, 'content' => $content));
        echo $view;
    }
    private function generateFile($file, $data) {
        if (file_exists($file)) {
            extract($data);

            // commencer la temporisation
            ob_start();
            require $file;

            // On arrête la temporisation pour que les données ne s'affichent pas avant que la vue soit chargée
            return ob_get_clean();


        } else {
throw new Exception("Fichier introuvable", 1);

        }
    }
}
