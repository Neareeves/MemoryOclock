<?php include "Head.php"; ?>

<div class="page-wrapper score">
    <h1>Les meilleurs scores</h1>
    <?php
    if (!empty($lastRegisteredScore)) { ?>
        <div>Vous avez fait le score de

            <?php echo $lastRegisteredScore["Score"]; ?>

        </div>
    <?php    }; ?>
    <div>
        <h4>Voici les dix meilleurs scores de tous les temps</h4>
        <?php
        foreach ($bestScoresEver as $score) {
            echo $score['Score'] . ' secondes, réalisé par ' . $score['Owner'] . '<br>';
        }; ?>
    </div>
    <a href="/memory/?page=play" class="btn">Nouvelle partie</a>
</div>

<?php include "Footer.php"; ?>