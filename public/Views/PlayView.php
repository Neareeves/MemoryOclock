<?php include("Head.php"); ?>

<div id="play" class="page-wrapper">
    <h1>Nouveau jeu</h1>
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
    <div class="failure center">
        <div>Vous avez perdu... Mais pas de panique, vous pouvez retenter votre chance!</div>
        <a href="play" class="btn">Je retente ma chance</a>
       
    </div>
    <div class="game-wrapper">
        <button class="btn" id="trigger">Commencer le jeu</button>

        <div class="inside-wrapper">
            <?php
            foreach ($numbers as $key => $number) { ;?>
            <div class="card hidden" data-flip="<?php echo $number;?>">

                
                <div class="card-back" style="background-image:url('<?php echo 'public/assets/images/'.$number.'.png';?>')"></div>
                <div class="card-front"></div>
            </div>
                <?php
            }; ?>
        </div>
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


<script type="text/javascript" src="public/assets/js/script.js"></script>

<?php include "Footer.php"; ?>