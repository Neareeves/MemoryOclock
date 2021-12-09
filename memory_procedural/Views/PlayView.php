<?php include("Head.php"); ?>
<!-- Dans toutes les vues, on inclue un header et un footer commun.
Cela permet d'ajouter des librairies sur toutes les vues en même temps, 
ou au contraire d'inclure des fichiers particuliers dans certaines vues -->

<div id="play" class="page-wrapper">
    <h1>Nouveau jeu</h1>
    <!-- Cette div n'apparaît qu'en cas de victoire -->
    <div class="success">
        <h3>C'est gagné!</h3>
        <div id="result"></div>

        <form action="score" method="POST">
            <label for="owner">Tape ton prénom pour qu'il entre dans la postérité</label>
            <input name='owner' type="text" required placeholder="Prénom" pattern="^[A-Za-z '-]+$">
            <input type="submit" class='btn' value="Enregistrer" name='validate'>
            <input id="scoreInput" type="hidden" name="score" value="">
        </form>

    </div>
    <!-- Cette div n'apparait qu'en cas d'échec -->
    <div class="failure center">
        <div>Vous avez perdu</div>
        <a href="play" class="btn">Je retente ma chance</a>
        <a href="/home" class="btn">Retour à la page d'accueil</a>
    </div>

    <!-- Le deck -->
    <div class="game-wrapper">
        <button class="btn" id="trigger">Commencer le jeu</button>

        <div class="inside-wrapper">
            <?php
             // Les cartes se composent d'une div principale dans laquelle se trouvent un front et un back
            // On crée une boucle qui génère toutes les cartes, tant qu'il y a de numéros dans le tableau envoyé par le controller
            // Afin d'afficher les cartes, on les a renommées de 1 à 12, on y accède grâce à un background-image
            foreach ($numbers as $key => $number) {; ?>
             <!-- Le dataset 'flip' nous permet de comparer deux cartes pour savoir si la paire est juste -->
                <div class="card hidden" data-flip="<?php echo $number; ?>">


                    <div class="card-back" style="background-image:url('<?php echo 'assets/images/' . $number . '.png'; ?>')"></div>
                    <div class="card-front"></div>
                </div>
            <?php
            }; ?>
        </div>

        <!-- Cette div héberge la barre de progression -->
        <div class="timer">
            <div id="bar"></div>
            <div>
                Temps de jeu :
                <div class="text">1 min 20</div>
            </div>
        </div>
    </div>
    <a href="home" class="btn">Retour à l'accueil</a>
</div>

<!-- Inclusion du fichier javascript seulement dans cette vue 
car c'est la seule qui en a besoin et qui possède les éléments html récupérés par le script -->
<script type="text/javascript" src="assets/js/script.js"></script>

<?php include "Footer.php"; ?>