const deck = document.getElementById('inside-wrapper');
const cards = document.querySelectorAll('.card');
const trigger = document.getElementById('trigger');
const result = document.getElementById('result');
let isTriggered = false;
let hasSomeCardTurned = false;
let card1, card2;
let enoughClicks = false;
let timer= 1;

// gestion du temps
function countTime() {
//    somediv.l'indice de la barre.value = ;
let timePlace = document.querySelector('.text');
timePlace.innerHTML = timer+' secondes';
timer++;
}


trigger.style.display = "block";
function turnAround() {
    if (enoughClicks) {
        return;
    }
    if (this === card1) {
        return;
    }
    if(isTriggered == false) {
        return;
    }
    this.classList.add('turnAround');
    if (!hasSomeCardTurned) {
        hasSomeCardTurned = true;
        card1 = this;
        return;
    }
    card2 = this;
    hasSomeCardTurned = false;
    enoughClicks = true;

    checkIfCardMatch();
}

function disableFlipping() {
    card1.removeEventListener('click', turnAround);
    card2.removeEventListener('click', turnAround);
    getReadyForNewTry();
}

function goBackToNormal() {
    setTimeout(() => {
        card1.classList.remove('turnAround');
        card2.classList.remove('turnAround');
        getReadyForNewTry();
    }, 1000);
}

function getReadyForNewTry() {
    card1 = null;
    card2 = null;
    hasSomeCardTurned = false;
    enoughClicks = false;
}

function checkIfCardMatch() {
    if (card1.dataset.flip === card2.dataset.flip) {
        console.log('it\'s a match!');
        card1.classList.remove('hidden');
        card2.classList.remove('hidden');
        disableFlipping();

// check if it's the last one. If yes, show input to write name and store it in the database

let stillHidden = document.querySelectorAll('.hidden');
console.log(stillHidden);
// if it's ok : 
if (stillHidden.length === 0) {

    document.querySelector('.success').style.display = 'block';
    result.innerHTML = 'Bravo, vous avez résolu le jeu dans le temps imparti, en '+timer+' secondes';
    // then stopper le chrono
    
}
        return;
    } else {
        console.log('it\'s not a match!');
    }
    goBackToNormal();
}

function makeProgressBar(duration, callback) {
    const progressBar = document.getElementById('bar');
    isTriggered = true;


    trigger.style.display = 'none';
    // à l'intérieur
    const innerBar = document.createElement('div');
    innerBar.className = 'innerBar';

    innerBar.style.animationDuration = duration;

    // //eventually couple acallback?
     if (typeof(callback) === 'function') {
         innerBar.addEventListener('animationend', callback);
     }
    progressBar.appendChild(innerBar);

    // on peut lancer la barre
    innerBar.style.animationPlayState = 'running';
    setInterval(countTime, 1000);

}
trigger.addEventListener('click', function() {
    makeProgressBar('40s', function() {
        // has won ? et sinon, displya none la bar
        alert('sorry, you\'ve lost');
    });
})




cards.forEach(card => {
    card.addEventListener('click', turnAround);

});




// flip one at the time






// check match and return true
// flippedCards = document.querySelectorAll('.cards');

// function haveMatched() {
//     if (flippedCards[0] === flippedCards[1]) {
//         console.log('the cards matched');
//         return true;
//     }
// }