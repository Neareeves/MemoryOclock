<!-- Template de l'affichage du score -->
<div class="page-wrapper score">
    <?php
    // Si le joueur vient d'enregistrer un noveau score, on l'affiche
    if (!empty($lastScore)) { ?>
        <div>Bien joué! Vous avez fini le jeu en

            <?php echo $lastScore; ?>

        </div>
    <?php    }; ?>
    <!-- Sinon, on n'affiche que les meilleurs scores stockées dans la base de données -->
    <h1>Les meilleurs scores</h1>
    <div>
        <h4>Voici les cinq meilleurs scores de tous les temps</h4>
        <?php
        foreach ($scores as $score) {
            echo $score->getScore() . ' secondes, réalisé par ' . $score->getOwner() . '<br>';
        }; ?>
    </div>
    <a href="play" class="btn">Nouvelle partie</a>
</div>