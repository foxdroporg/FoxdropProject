window.addEventListener('load', init);

// Available Levels
const levels = {
  easy: 5,
  medium: 3,
  hard: 2
};

// Globals
var difficulty = "";
var MYLIBRARY = MYLIBRARY || (function(){
  var _args = {}; // private
  return {
      init : function(Args) {
          _args = Args;
          difficulty = _args[0];
      }
  };
}());

let currentLevel;
let time;
let score = 0;
let wordcount = 0;
let isPlaying = true;
let countdownInterval;
let statusInterval;
let gameStarted = true;

// DOM elements
const wordInput = document.querySelector('#word-input');
const currentWord = document.querySelector('#current-word');
const scoreDisplay = document.querySelector('#score');
const timeDisplay = document.querySelector('#time');
const wordCountDisplay = document.querySelector('#wordcount');
const message = document.querySelector('#message');
const seconds = document.querySelector('#seconds');
var nextWordDisplay = document.getElementById("scrollingwords");

 // Initialize Game
function init() {
  // To change level
  if(difficulty === "easy") {
    currentLevel = levels.easy;
  } 
  else if (difficulty === "medium") {
    currentLevel = levels.medium;
  } 
  else {
    currentLevel = levels.hard;
  }
  //console.log(currentLevel);
  //console.log(difficulty);
  time = currentLevel;

  // Show number of seconds in UI
  //seconds.innerHTML = currentLevel;
  // Load word from array
  showWord(words);
  // Start matching on word input
  wordInput.addEventListener('input', startMatch);
  // Check game status
  statusInterval = setInterval(checkStatus, 50);
  // Call countdown every second
  countdownInterval = setInterval(countdown, 1000);
}

// Start match
function startMatch() {
  if (time === currentLevel && wordInput.value.length === 1 && isPlaying === false) {
    // Auto start
    countdownInterval = setInterval(countdown, 1000);
  }
  if (matchWords()) {
    isPlaying = true;
    showWord(words);
    wordInput.value = '';
    score += time;
    wordcount++; 
    var successSound = new Audio("../../soundeffects/successfulMatch.mp3");
	  successSound.play();
    time = currentLevel + 1;
  }
  // If score is -1, display 0
  if (score === -1) {
    scoreDisplay.innerHTML = 0;
    wordCountDisplay.innerHTML = 0;
  } else {
    scoreDisplay.innerHTML = score;
    wordCountDisplay.innerHTML = wordcount;
  }
}

// Match currentWord to wordInput
function matchWords() {
  if (wordInput.value.toLowerCase() === currentWord.innerHTML) {
    message.innerHTML = 'Correct!';
    message.style.color = "green";
    return true;
  } else {
    message.innerHTML = '';
    return false;
  }
}

// Pick & show random word
function showWord(words) {
  let level = 0;
  if(wordcount > 15) {
    level = 1;
  } else if(wordcount > 30) {
    level = 2;
  }
  if (gameStarted === true) {
    // Next word
    const randIndexFirst = Math.floor(Math.random() * words[level].length);
    nextWordDisplay.innerHTML = words[level][randIndexFirst];
    // Current word
    const randIndex = Math.floor(Math.random() * words[level].length);
    currentWord.innerHTML = words[level][randIndex];
    gameStarted = false;
  }
  else {
    currentWord.innerHTML = nextWordDisplay.innerHTML;
    const randIndexFirst = Math.floor(Math.random() * words[level].length);
    nextWordDisplay.innerHTML = words[level][randIndexFirst];
  }
}

// Countdown timer
function countdown() {
  // Make sure time is not run out
  if (time > 0) {
    // Decrement
    time--;
  } else if (time === 0) {
    // Game is over
    isPlaying = false;
    var gameOverSound = new Audio("../../soundeffects/gameOver.mp3");
	  gameOverSound.play();
    highscores();
  }
  // Show time
  timeDisplay.innerHTML = time;
}

wordInput.onblur = function() {
  wordInput.placeholder = "Type the text above to begin...";
}

// Check game status
function checkStatus() {
  if (!isPlaying && time === 0) {
    message.innerHTML = 'Game Over!';
    message.style.color = "red";
    score = 0;
    wordcount = 0;
    wordInput.blur();
    wordInput.value = "";
    clearInterval(countdownInterval);
    setTimeout(() => {
      time = currentLevel;
      timeDisplay.innerHTML = currentLevel;
    }, 500);
  }
}

function highscores() {
  console.log("User logged in? " + U_UID);
  if(U_UID == "false") {
    document.getElementById("highscoreTable").innerHTML = "Please sign up and log in on Foxdrop to see the highscores for this game!";
  }
  else {
    var highscoreForm = new FormData();

    highscoreForm.append("username", U_UID);
    highscoreForm.append("user_score", score);
    highscoreForm.append("game", "typetosurvive");

    fetch("../../../includes/scores.inc.php", {
      method: 'POST',
      body: highscoreForm
    }).then(function (response) {
      return response.json();
    })
    .then(function(scores) {
      var highscores = '';
      var i = 0;
      scores.forEach(function(score) {
        highscores += score[0] + ' ' + score[1] + ' points on ' + score[2] + '<br>';
        i++;
    })
      document.getElementById("highscoreTable").innerHTML = "Highscores: <br>" + highscores;
    }).catch(function(error) {
      console.error(error);
    });
  }
}


const words = [
  // 7 - 10 letters
  [
    'nonbasic',
    'destoor',
    'incitable',
    'unburdens',
    'wisedome',
    'halluxes',
    'apricotty',
    'googles',
    'spoiler',
    'titleless',
    'unroots',
    'neuropath',
    'colluded',
    'perillas',
    'overplayed',
    'lasting',
    'vintaging',
    'bestowal',
    'resorptive',
    'anklelock',
    'nonprofit',
    'purporting',
    'stinginess',
    'shortfall',
    'pseudos',
    'underseas',
    'decennary',
    'inherency',
    'birdsongs',
    'rounder',
    'sulcular',
    'bestrewing',
    'orchester',
    'semilunar',
    'over-egged',
    'collected',
    'vibrate',
    'farepayers',
    'handlers',
    'command',
    'royalize',
    'deconsider',
    'neckline',
    'unprofited',
    'competent',
    'navigant',
    'bottine',
    'undermined',
    'advancing',
    'fascicled',
    'cheaters',
    'uncopied',
    'posterise',
    'snowpeople',
    'dissolve',
    'pilsners',
    'squadrons',
    'subareal',
    'unbalanced',
    'scrollbars',
    'baggages',
    'terminal',
    'megapod',
    'deadlinks',
    'pasture',
    'inaccurate',
    'whiskies',
    'activates',
    'orthoptics',
    'treetop',
    'superalert',
    'wakeless',
    'obediently'
  ],
  // 11 - 14 letters
  [
    'counterflows',
    'nightmarishly',
    'vaniloquent',
    'rejuvenescence',
    'degranulation',
    'unguiculated',
    'circumferent',
    'reconsolidate',
    'irresistibly',
    'unbookmarked',
    'colonialism',
    'futureproofs',
    'manipulated',
    'typecasting',
    'trichomonads',
    'antispanking',
    'seclusionist',
    'sprightfully',
    'dictatorship',
    'radionuclidic',
    'powerboating',
    'pictorially',
    'solicitousness',
    'harbourmasters',
    'choreographer',
    'unidentifiable',
    'patrimonially',
    'pulverising',
    'perturbance',
    'rebelliousness',
    'magnetometers',
    'hydrography',
    'nonexistent',
    'insufficiency',
    'digressional',
    'weatherstrips',
    'technicolored',
    'unappealing',
    'dessertspoons',
    'unlimitedness',
    'distillations',
    'hairdresser',
    'aerodromics',
    'countermine',
    'zombifications',
    'chiaroscurists',
    'wordprocessed',
    'unmagnified'
  ],
  // 15 - 20 letters
  [
    'cutegirlfromnyc',
    'hexafluoroplatinate',
    'unprincipledness',
    'antiferromagnet',
    'misrepresentative',
    'unpredictability',
    'interrogation-points',
    'hypersomnolence',
    'conventionalises',
    'frontozygomatic',
    'intercommunicated',
    'unacquaintedness',
    'uninterestingly',
    'andrographolide',
    'bioanthropology',
    'crystallization',
    'undiplomatically',
    'understandability',
    'debathification',
    'paradoxicalness',
    'environmentalists',
    'psychopathologies',
    'noncontributing',
    'osseointegration',
    'branchiocardiac',
    'neuropharmacologist',
    'extraterrestrials',
    'sulfadimethoxine',
    'renaturalization',
    'externalization',
    'dihydrotestosterone',
    'isothiocyanates',
    'metametaphysics',
    'complimentarily',
    'customizability',
    'inconveniencing',
    'micrometastasis',
    'dialectological',
    'triphenylmethane',
    'magnetosensitive',
    'institutionally',
    'disacknowledged',
    'unmanageableness',
    'technologically',
    'indisputableness',
    'operationalised',
    'manoeuvrability',
    'deglobalization',
    'susceptibilities',
    'immunoregulation',
    'microfabrication',
    'instrumentation',
    'psychotherapeutics',
    'multilocational',
    'inauspiciousness',
    'superheavyweight',
    'imprescriptible',
    'uncomprehendingly'
  ]
];