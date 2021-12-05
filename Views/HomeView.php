<?php include("Head.php"); ?>

<div class="page-wrapper home">

    <h1>Jeu de mémoire</h1>

    <div>Associez toutes les paires de cartes avant la fin du chrono. <br> Vous avez 1 min 30.</div>
    <a href="/memory/?page=play" class="btn">Jouer</a> <br>

    <section class="meilleursScores">
        <h3>Les scores à battre</h3>
        <?php 
    foreach ($bestScoresEver as $score) {
        echo $score['Score'].' secondes, réalisé par '.$score['Owner'].'<br>'; 
    }
    ;?>
    <a href="/memory/?page=score" class="btn">Consulter les scores</a>
    </section>
</div>
    


<?php include "Footer.php"; ?>