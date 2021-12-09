# Jeu du Memory

Réalisé par Aleth Arrias  
Il est déployé sur un vps OVH à l'adresse http://memory.aleth.online  

## Pour installer le projet
- Importez la base de données 'memory.sql' et entrez ses identifiants de son utilisateur dans le fichier App\Models\database.php
- Et c'est tout!
- Si vous modifiez le css, modifiez le fichier public/assets/scss/style.scss et lancez dans votre terminal la commande de compilation  
`sass --watch public/assets/scss/style.scss:public/assets/css/style.css`

## Pourquoi un projet en php procédural dans un sous-dossier ?

J'ai eu du mal, en lisant les instructions, à saisir le niveau en PHP des apprenants. Si c'était un de leurs premiers projets en PHP, je pense que réaliser un projet simple, sans programmation en orienté objet, serait plus accessible. J'aurais, dans ce projet, utilisé la POO dans quelques exemples pour leur montrer son fonctionnement, sans forcément organiser tout le projet de cette manière. Et dans un second temps, j'aurais pu leur montrer la même chose, organisée en POO pour mettre en relief les différences.  
Si au contraire les étudiants avaient déjà fait plusieurs projets complets en PHP, je leur montrerais directement la version POO, située à la racine.