// cards récupère toutes les cartes, c'est-à-dire les div qui ont la classe "card"
const cards = document.querySelectorAll('.card');
// trigger récupère le bouton sur lequel il faut cliquer pour lancer le chrono et la partie
const trigger = document.getElementById('trigger');
// result récupère l'élément html dans lequel figurera le score si le joueur gagne la partie
const result = document.getElementById('result');
// storeInput récupère un input hidden dans lequel sera stockée le score si le joueur gagne, et qui sera envoyé avec le reste du formulaire pour être stocké dans la page de données.
const storeInput = document.getElementById('scoreInput').value;

// les variables ci-dessous sont des switchs. Càd qu'elles permettent de suivre un état (ex. une carte est retournée, le chrono est lancé, le joueur a gagné...). On commence le jeu par les initialiser en leur assignant une valeur "false".
// isTriggered marque le lancement du chronomètre et le début du jeu.
let isTriggered = false;
let isOneCardFlipped = false;
let alreadyTwoCardsFliped = false;
// card1 et card2 représentent deux cartes retournées
let card1, card2;
// le timer va comptabiliser le temps, seconde après seconde
let timer = 1;
// hasWon indiquera en passant à true que le joueur a gagné
let hasWon = false;
trigger.style.display = "block";



// Retourner une carte
function flipCard() {
    // Vérifie que deux cartes maximum ont été retournées
    if (alreadyTwoCardsFliped) {
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
    if (!isOneCardFlipped) {
        isOneCardFlipped = true;
        card1 = this;
        return;
    }
    // Si la première carte existe déjà, on stocke la seconde carte retournée dans la variable card2, puis on stocke le fait que le maximum autorisé de deux cartes découvertes à la fois a été atteint
    card2 = this;
    isOneCardFlipped = false;
    alreadyTwoCardsFliped = true;

    checkIfCardsMatch();
}
// cette fonction empêche de retourner plus de carte
function disableFlipping() {

    card1.removeEventListener('click', flipCard);
    card2.removeEventListener('click', flipCard);
    deckReinitialisation();
}

// Au bout d'un certain temps, on replace les cartes retournées face cachée en retirant la classe css "turnAround" et lançant la fonction de réinitialisation du deck (on remet les cartes face cachée). On utilise setTimeout pour mettre un délai avant l'execution de la fonction et laisser au joueur le temps de se rappeler des cartes.
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
    isOneCardFlipped = false;
    alreadyTwoCardsFliped = false;
}

// Validation de la paire de cartes retournées
function checkIfCardsMatch() {
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
            // then stopper le chrono aleth
            document.getElementById('bar').style.display= 'none';
          
        }
        return;
    } else {
        //console.log('it\'s not a match!');
    }
    getReadyForNewTry();
}


// gestion du temps

// gestion de l'affichage du temps qui passe
function displayFlyingTime() {
    if (hasWon === false) {
        // On récupère une div dans laquelle sera injecté le temps chaque seconde. 
        // Le temps est calculé par un timer, incrémenté chaque seconde.
        // Les variables minute et temps servent à afficher le temps d'une manière plus lisible pour l'utilisateur
        let timePlace = document.querySelector('.text');
        let minutes = Math.floor(timer / 60);
        let secondes = timer - minutes * 60;
        timePlace.innerHTML = minutes+' min '+secondes+' s ';
        timer++;
    } else {
        
        return;
    }
}

// gestion de la barre de progression 
function makeProgressBar(duration, callback) {
    // On récupère l'élément dans lequel sera installée la barre
    const progressBar = document.getElementById('bar');
    
    // Le temps est lancé, le jeu peut commencer. On peut cacher le bouton de lancement.
    isTriggered = true;
    trigger.style.display = 'none';
    
    
    // à l'intérieur, on crée une autre div
    const innerBar = document.createElement('div');
    innerBar.className = 'innerBar';
    
    // Fixe la durée du chrono
    innerBar.style.animationDuration = duration;
    
    // On prévoit d'exécuter une fonction lors de la fin de l'animation, c'est-à-dire lorsque le temps (duration) fixé en paramètre de la fonction sera écoulé.
    if (typeof (callback) === 'function') {
        innerBar.addEventListener('animationend', callback);
    }
    progressBar.appendChild(innerBar);

    // On lance l'animation de la barre, et l'affichage du temps, mis à jour chaque seconde grâce à setInterval()
    innerBar.style.animationPlayState = 'running';
    setInterval(displayFlyingTime, 1000);
    
}

// Le temps est lancé lorsque le joueur clique sur le bouton de lancement du jeu (trigger).
trigger.addEventListener('click', function () {
    makeProgressBar('80s', function () {
        // si à la fin du temps, le joueur n'a pas gagné :
        if (!hasWon) {
            alert('Oh non! Il semble que vous ayez perdu :(');
            // On repasse la gâchette à false pour empêcher de retourner d'autres cartes et finir le jeu, on fait apparaître une div à l'utilisateur et on stoppe le passage du temps.
            isTriggered = false;
            
            // aleth ne fonctionne pas
            document.getElementById('fullTimePlace').style.display = "none";
            document.querySelector('.failure').style.display = 'block';
        }
    });
})



// écouteur d'évenement sur les cartes : au click, il applique la fonction flipCard()
cards.forEach(card => {
    card.addEventListener('click', flipCard);
});
