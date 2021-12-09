<?php include "Head.php"; ?>

<div class="page-wrapper score">
    <h1>Les meilleurs scores</h1>
    <?php
    if (!empty($score)) { ?>
        <div>Vous avez fini le jeu en 

            <?php echo $score; ?>

        </div>
    <?php    }; ?>
    <div>
        <h4>Voici les cinq meilleurs scores de tous les temps</h4>
        <?php
        foreach ($bestScoresEver as $score) {
            echo $score['Score'] . ' secondes, réalisé par ' . $score['Owner'] . '<br>';
        }; ?>
    </div>
    <a href="play" class="btn">Nouvelle partie</a>
</div>

<?php include "Footer.php"; ?>