<?php include("Head.php"); ?>
<!-- Dans toutes les vues, on inclue un header et un footer commun.
Cela permet d'ajouter des librairies sur toutes les vues en même temps, 
ou au contraire d'inclure des fichiers particuliers dans certaines vues -->

<div class="page-wrapper home">

    <h1>Jeu de mémoire</h1>

    <div>Associez toutes les paires de cartes avant la fin du chrono. <br> Vous avez 1 min 30.</div>
    <a href="play" class="btn">Jouer</a> <br>

    <section class="meilleursScores">
        <h3>Les scores à battre</h3>
        <?php 
    foreach ($bestScoresEver as $score) {
        echo $score['Score'].' secondes, réalisé par '.$score['Owner'].'<br>'; 
    }
    ;?>
    <a href="score" class="btn">Consulter les scores</a>
    </section>
</div>
    


<?php include "Footer.php"; ?>