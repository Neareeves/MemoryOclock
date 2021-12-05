<?php include("Head.php"); ?>

<div id="play" class="page-wrapper">
    <h1>Nouveau jeu</h1>
    <div class="success">
        <h3>C'est gagné!</h3>
        <div id="result"></div>
        <form action="/memory/?page=score" method="POST">
            <label for="owner">Tape ton prénom pour qu'il entre dans la postérité</label>
            <input name='owner' type="text" required placeholder="Prénom" pattern="^[A-Za-z '-]+$">
            <input type="submit" class='btn' value="Enregistrer" name='validate'>
            <input id="scoreInput" type="hidden" name="score" value="">
        </form>

    </div>
    <div class="failure">
        <a href="/memory/?page=play" class="btn">Je retente ma chance</a>
        <a href="/memory/" class="btn">Retour à la page d'accueil</a>
    </div>
    <div class="game-wrapper">
        <button class="btn" id="trigger">Commencer le jeu</button>

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
        <div class="timer">
            <div id="bar"></div>
            <div class="text"></div>
        </div>
    </div>
    <a href="/memory/" class="btn">Retour à l'accueil</a>
</div>


<script type="text/javascript" src="assets/js/script.js"></script>

<?php include "Footer.php"; ?>