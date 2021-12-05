const deck = document.getElementById('inside-wrapper');
const cards = document.querySelectorAll('.card');
const trigger = document.getElementById('trigger');
const result = document.getElementById('result');
const storeInput = document.getElementById('scoreInput').value;
let isTriggered = false;
let hasSomeCardTurned = false;
let card1, card2;
let enoughClicks = false;
let timer = 1;
let hasWon = false;
trigger.style.display = "block";

// gestion du temps écrit
function displayFlyingTime() {
    let timePlace = document.querySelector('.text');
    let minutes = Math.floor(timer / 60);
    let secondes = timer - minutes * 60;
    timePlace.innerHTML = secondes+' s '+minutes+' min';
    timer++;
}

// Retourner une carte
function turnAround() {
    // Vérifie que deux cartes maximum ont été retournées
    if (enoughClicks) {
        return;
    }
    // Vérifie que le joueur n'a pas recliqué sur la même carte
    if (this === card1) {
        return;
    }
    // Vérifie que le joueur a lancé le chronomètre, sinon, le jeu est bloqué
    if (isTriggered == false) {
        return;
    }
    // On ajoute la classe qui apporte l'animation de retournement de la carte
    this.classList.add('turnAround');
    // On enregistre le fait qu'une première carte a été retournée et on la stocke dans la variable card1
    if (!hasSomeCardTurned) {
        hasSomeCardTurned = true;
        card1 = this;
        return;
    }
    // Si la première carte existe déjà, on stocke la seconde retournée dans la variable card2, puis on stocke le fait que le maximum autorisé de deux cartes découvertes à la fois a été atteint
    card2 = this;
    hasSomeCardTurned = false;
    enoughClicks = true;

    checkIfCardMatch();
}

function disableFlipping() {
    card1.removeEventListener('click', turnAround);
    card2.removeEventListener('click', turnAround);
    deckReinitialisation();
}

// Au bout d'un certain temps, on replace les cartes retournées face cachée en retirant la classe css "turnAround" et lançant la fonction de réinitialisation du deck
function getReadyForNewTry() {
    setTimeout(() => {
        card1.classList.remove('turnAround');
        card2.classList.remove('turnAround');
        deckReinitialisation();
    }, 700);
}

// Réinitialisation du deck pour pouvoir retourner et comparer les deux cartes suivantes
// On efface les valeurs stockées dans les variables card1 et card2, ainsi que les variables qui nous servent à savoir om nous en sommes dans le retournement des cartes
function deckReinitialisation() {
    card1 = null;
    card2 = null;
    hasSomeCardTurned = false;
    enoughClicks = false;
}

// Validation de la paire de cartes retournées
function checkIfCardMatch() {
    // si card1 possède la même valeur dans la propriété data-flip que card2 :
    if (card1.dataset.flip === card2.dataset.flip) {
        // Alors la paire est validée
        // console.log('it\'s a match!');
        // On enlève la classe "hidden" de la div .card puisqu'elles resteront face découverte, étant validées
        card1.classList.remove('hidden');
        card2.classList.remove('hidden');
        disableFlipping();

        // Il faut maintenant tester si cette paire est la dernière à être découverte, et donc, si le jeu est terminé ou non.
        // On comptabilise le nombre de cartes qui ont encore leur classe "hidden", et qui n'ont donc pas encore été validées.
        let stillHidden = document.querySelectorAll('.hidden');
        
        // S'il ne reste plus de carte possédant encore la classe "hidden", le jeu est fini.
        if (stillHidden.length === 0) {
        document.getElementById('scoreInput').value = timer;
            result.innerHTML = 'Bravo, vous avez résolu le jeu dans le temps imparti, en ' + timer + ' secondes.';
            document.querySelector('.success').style.display = 'block';
            hasWon = true;
            // then stopper le chrono
            document.getElementById('bar').style.display= 'none';

            console.log(scoreInput);

            //store score inside hidden input
            
        }
        return;
    } else {
        //console.log('it\'s not a match!');
    }
    getReadyForNewTry();
}

// gestion de la barre de progression 
function makeProgressBar(duration, callback) {
    // On récupère l'élément dans lequel sera installée la barre
    const progressBar = document.getElementById('bar');

    // Le temps est lancé, le jeu peut commencer. On peut cacher le bouton de lancement.
    isTriggered = true;
    trigger.style.display = 'none';


    // à l'intérieur
    const innerBar = document.createElement('div');
    innerBar.className = 'innerBar';

    innerBar.style.animationDuration = duration;

    // //eventually couple acallback?
    if (typeof (callback) === 'function') {
        console.log('inside callback');
        innerBar.addEventListener('animationend', callback);
    }
    progressBar.appendChild(innerBar);

    // On lance l'animation de la barre, et l'affichage du temps, mis à jour chaque seconde
    innerBar.style.animationPlayState = 'running';
    setInterval(displayFlyingTime, 1000);

}

// Le temps est lancé lorsque le joueur clique sur le bouton de lancement du jeu (trigger).
trigger.addEventListener('click', function () {
    makeProgressBar('80s', function () {
        // has won ? et sinon, displya none la bar
        // un setinterval pour récupérer la valeur de haswon régulièrement ?
        if (!hasWon) {
            alert('sorry, you\'ve lost');
            document.getElementsByClassName('failure').style.display = 'block';
        }
    });
})




cards.forEach(card => {
    card.addEventListener('click', turnAround);
});
