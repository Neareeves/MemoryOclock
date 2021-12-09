<div class="page-wrapper score">
    <?php
    if (!empty($lastScore)) { ?>
        <div>Bien joué! Vous avez fini le jeu en 
            
            <?php echo $lastScore; ?>
            
        </div>
        <?php    }; ?>
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

