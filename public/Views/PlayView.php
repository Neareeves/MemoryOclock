<div id="play" class="page-wrapper">
    <h1>Nouveau jeu</h1>

    <!-- Cette div n'apparait qu'en cas de succès. Déclenché par le script -->
    <div class="success">
        <h3>C'est gagné!</h3>
        <div id="result"></div>
        <form action="score" method="POST">
            <label for="owner">Quel prénom dois-je inscrire dans la postérité ?</label>
            <input name='owner' type="text" required placeholder="Prénom" pattern="^[A-Za-z '-]+$">
            <input type="submit" class='btn' value="Enregistrer" name='validate'>
            <input id="scoreInput" type="hidden" name="score" value="">
        </form>
    </div>
    <!-- Fin du formulaire de succès -->

    <!-- Cette div n'apparait qu'en cas d'échec au jeu -->
    <div class="failure center">
        <div>Vous avez perdu... Mais pas de panique, vous pouvez retenter votre chance!</div>
        <a href="play" class="btn">Je retente ma chance</a>
    </div>

    <!-- Jeu -->
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
                    <div class="card-back" style="background-image:url('<?php echo 'public/assets/images/' . $number . '.png'; ?>')"></div>
                    <div class="card-front"></div>
                </div>
            <?php
            }; ?>
        </div>

        <!-- Cette div contient la barre de progression ainsi que le temps qui défile -->
        <div class="timer">
            <div id="bar"></div>
            <div id="fullTimePlace">
                Temps de jeu :
                <div class="text">1 min 20</div>
            </div>
        </div>
    </div>
    <a href="home" class="btn">Retour à l'accueil</a>
</div>

<!-- Afin d'éviter l'apparition d'erreurs dans la console lorsque les autres pages s'affichent, 
car elles ne possèdent pas les balises recherchées par le script, 
on injecte le script du jeu directement dans le seul template concerné -->
<script type="text/javascript" src="public/assets/js/script.js"></script>