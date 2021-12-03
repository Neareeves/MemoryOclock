<?php include("Head.php"); ?>

<div id="play" class="page-wrapper">
    <h1>Nouveau jeu</h1>
    <div class="game-wrapper">
        <button class="btn" id="trigger">Commencer le jeu</button>
        <div class="timer">
            <div id="bar"></div>
            <div class="text"></div>
        </div>
        <div class="inside-wrapper">
            <?php
            foreach ($numbers as $key => $number) { ;?>
            <div class="card hidden" data-flip="<?php echo $number;?>">

                
                <div class="card-back" style="background-image:url('<?php echo 'assets/images/'.$number.'.png';?>')"></div>
                <div class="card-front"></div>
            </div>
                <?php
            }; ?>
        </div>
    </div>
    <div class="success">
        <h3>Vous avez gagné!</h3>
        
        <a href="" class="btn">Consulter le palmarès</a>
    </div>
    <div class="failure">
        <a href="/memory/?page=play" class="btn">Je retente ma chance</a>
        <a href="/memory/" class="btn">Retour à la page d'accueil</a>
    </div>
</div>



<?php include "Footer.php"; ?>