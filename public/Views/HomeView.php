

<div class="page-wrapper home">

    <h1>Jeu de mémoire</h1>

    <div>Associez toutes les paires de cartes avant la fin du chrono. <br> Vous avez 1 min 30.</div>
    <a href="play" class="btn">Jouer</a> <br>

    <section class="meilleursScores">
        <h3 class='margin2'>Les scores à battre</h3>
        <?php 
    foreach ($scores as $score) {
        echo $score->getScore().' secondes, réalisé par '.$score->getOwner().'<br>'; 
    }
    ;?>
    <a href="score" class="btn">Consulter les scores</a>
    </section>
</div>
    


