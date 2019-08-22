window.addEventListener('load', init);

// Available Levels
const levels = {
  easy: 150,
  medium: 150,
  hard: 150
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
let startTime;

var wordIndex = 0;

// DOM elements
const wordInput = document.querySelector('#word-input');
const currentWord = document.querySelector('#current-word');
var currentWordDuplicate;
const scoreDisplay = document.querySelector('#score');
const timeDisplay = document.querySelector('#time');
const wordCountDisplay = document.querySelector('#wordcount');
const message = document.querySelector('#message');
const seconds = document.querySelector('#seconds');
var nextWordDisplay = document.getElementById("scrollingwords");

 // Initialize Game
function init() {
  if(difficulty === "easy") {
    currentLevel = levels.easy;
  } 
  else if (difficulty === "medium") {
    currentLevel = levels.medium;
  } 
  else {
    currentLevel = levels.hard;
  }
  time = currentLevel;
  startTime = time;

  // Load word from array
  showWord(words);

  // Start matching on word input
  wordInput.addEventListener('input', startMatch);

  // Check game status
  statusInterval = setInterval(checkStatus, 50);

  // Call countdown every second
  countdownInterval = setInterval(countdown, 1000);
  focus();
}

// Start match
function startMatch() {
  if (time === currentLevel && wordInput.value.length === 1 && isPlaying === false) {
    // Auto start
    countdownInterval = setInterval(countdown, 1000);
  }
  if (matchWords()) { // <<<
    isPlaying = true;
    showWord(words);  // <<<
    wordInput.value = '';
    wordcount++; 
    score = wordcount / (startTime/60-time/60);
    var successSound = new Audio("../../soundeffects/successfulMatch.mp3");
    successSound.play();
    correctWordBackgroundColor();
  }
  // If score is -1, display 0
  if (score === -1) {
    scoreDisplay.innerHTML = 0;
    wordCountDisplay.innerHTML = 0;
  } else {
    scoreDisplay.innerHTML = Math.round(score);
    wordCountDisplay.innerHTML = wordcount;
  }
}

var boolean = true;
var started = 0;
var str;
// Match currentWord to wordInput
function matchWords() {
  if(currentWordDuplicate === undefined) {
    let wordArray = currentWord.innerHTML.split(' ');
    currentWordDuplicate = wordArray[0]+" ";
  }

  if (wordInput.value === currentWordDuplicate) {
    message.innerHTML = 'Correct!';
    message.style.color = "green";
    wordIndex++;
    started = 0;

    // This takes care of nextWordDisplay
    var newString = currentWord.innerHTML.replace(/span>  /gi, "span>  £"); 
    let wordArray = newString.split("£");
      // Game finished! When last word is typed.
      if (wordIndex === wordArray.length) {
        endGame();
        return true;
      }
    wordArray = wordArray[wordIndex].split(' ');
    currentWordDuplicate = wordArray[0];
    currentWordDuplicate = currentWordDuplicate+" ";
    nextWordDisplay.innerHTML = currentWordDuplicate;
    
    
    return true;
  } 
  else {
    var actual = currentWordDuplicate;
    var userInput = wordInput.value;
    
    const actualArray = actual.split('');
    const userInputArray = userInput.split('');

    let wordArray;
    var arrayPlaceholder = [];

    if (boolean) {
      wordArray = currentWord.innerHTML.split(' ');
    }
    else {
      var newString = currentWord.innerHTML.replace(/span>  /gi, "span>  £"); 
      wordArray = newString.split("£");

      // This resolves a bug with the first word!!
      if (wordIndex === 0 && started === 0) {
        started = 1;
      } 

      for(var k=0; k<wordIndex+started; k++) {
        arrayPlaceholder.push(wordArray[k]);
      }

      // This resolves a bug with the last word!!
      if (wordArray.length === wordIndex+started) {
        
      }
      else {
        wordArray = wordArray[wordIndex+started].split(' ');
        wordArray = arrayPlaceholder.concat(wordArray);
        started = 1;
      }
    }

    actualArray.map((element, i) => {
      let color;
      if (i < userInput.length) {
        element === userInputArray[i] ? color='#42f55a' : color='#f54e42'; 
      }
      actualArray[i] = "<span key="+i+" style=color:"+color+">"+element+"</span>";

      nextWordDisplay.innerHTML = actualArray;
      nextWordDisplay.innerHTML = nextWordDisplay.innerHTML.replace(/,/g, "");
      nextWordDisplay.innerHTML = nextWordDisplay.innerHTML+" ";

      wordArray.splice(wordIndex, 1, nextWordDisplay.innerHTML);
    })

    boolean = false;
    // Wordarray is messed up after first word
    currentWord.innerHTML = wordArray.join(' '); // ' ' or '' 
    
    message.innerHTML = '';
    return false;
  }
}

// Pick & show random word
function showWord(words) {
  if (gameStarted === true) {
    // Current word
    word = wordForCertainLevel(words);
    currentWord.innerHTML = word;
    gameStarted = false;
  }
}

function wordForCertainLevel(words) {
  let randIndex = Math.floor(Math.random() * words.length);
  return words[randIndex];
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
    loseBackgroundColor();
    endGame();
  }
  // Show time
  timeDisplay.innerHTML = time;
}

wordInput.onblur = function() {
  wordInput.placeholder = "Type the text above to begin...";
}

function focus() {
  wordInput.focus();
}

// Check game status
function checkStatus() {
  if (!isPlaying && time === 0) {
    message.innerHTML = 'Game Over!';
    message.style.color = "red";
    wordInput.blur();
    wordInput.value = "";
    clearInterval(countdownInterval);
    setTimeout(() => {
      time = currentLevel;
      timeDisplay.innerHTML = currentLevel;
    }, 500);
  }
}

// Check game status
function endGame() {
  message.innerHTML = 'Game Over!';
  message.style.color = "red";
  wordInput.disabled = true;
  wordInput.placeholder = "Refresh page to play again...";
  wordInput.value = "";
  clearInterval(countdownInterval);
  highscores();
}


function correctWordBackgroundColor() {
  document.body.style.backgroundColor = "green";
  setTimeout(() => {
    document.body.style.backgroundColor = "#202020";
  }, 100);
}

function loseBackgroundColor() {
  document.body.style.backgroundColor = "#ad1515";
  setTimeout(() => {
    document.body.style.backgroundColor = "#202020";
  }, 200);
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
    highscoreForm.append("game", "typetosurviveWPM");

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
        highscores += score[0] + ' ' + score[1] + ' words per minute on ' + score[2] + '<br>';
        i++;
        if(i > 15) {
          return;
        }
    })
      document.getElementById("highscoreTable").innerHTML = "Highscores: <br>" + highscores;
    }).catch(function(error) {
      console.error(error);
    });
  }
}

const words = [
"Having spent most of her life exploring the jungle with her parents nothing could prepare Dora for her most dangerous adventure ever: high school. Always the explorer Dora quickly finds herself leading Boots Diego a mysterious jungle inhabitant and a ragtag group.",
"A kind-hearted street urchin Aladdin vies for the love of the beautiful princess Jasmine the princess of Agrabah. When he finds a magic lamp he uses a genie's magic power to make himself a prince in order to marry her. He is also on a mission to stop the powerful Jafar.",
"A frustrated musician whose musical career is going nowhere despite the faith that his manager Ellie Appleton has in him. However on the night Jack decides to give up the whole world is momentarily hit with a massive blackout during which Jack.",
"Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays a man who befriends a number of fellow prisoners most notably a wise long-term inmate named Red.",
"The Godfather is the head of the Corleone mafia family in New York. He is at the event of his daughter's wedding. Michael Vito's youngest son and a decorated Marine is also present at the wedding.",
"The continuing saga of the Corleone crime family tells the story of a young Vito Corleone growing up in Sicily and in New York. And follows Michael Corleone in the 1950s as he attempts to expand the family business into Las Vegas Hollywood and Cuba.",
"Set within a year after the events of Batman Begins Batman Lieutenant James Gordon and new District Attorney Harvey Dent successfully begin to round up the criminals that plague Gotham City until a mysterious and sadistic criminal mastermind known only as The Joker.",
"The defense and the prosecution have rested and the jury is filing into the jury room to decide if a young man is guilty or innocent of murdering his father. What begins as an open-and-shut case of murder.",
"The final confrontation between the forces of good and evil fighting for control of the future of Middle-earth. Frodo and Sam reach Mordor in their quest to destroy the One Ring while Aragorn leads the forces of good against Sauron's evil army at the stone city of Minas Tirith.",
"Forrest Gump is a simple man with a low IQ but good intentions. He is running through childhood with his best and only friend Jenny. His mama teaches him the ways of life and leaves him to choose his destiny.",
"The future of earth has been riddled by disasters famines and droughts. There is only one way to ensure mankind's survival interstellar travel. A newly discovered wormhole in the far reaches of our solar system allows a team of astronauts to go where no man has gone before.",
"A typical American teenager of the eighties is accidentally sent back to in a plutonium-powered DeLorean time machine invented by a slightly mad scientist. During his often hysterical always amazing trip back in time.",
"In Paris the aristocratic and intellectual Philippe is a millionaire who is interviewing candidates for the position of his carer with his red-haired secretary Magalie. Out of the blue Driss cuts the line of candidates and brings a document from the Social Security.",
"Maximus is a powerful roman general loved by the people and the aging emperor Marcus Aurelius. Before his death the emperor chooses Maximus to be his heir over his own son Commodus and a power struggle leaves Maximus and his family condemned to death.",
"Miles is a New York teen struggling with school friends and on top of that being the new Spider-Man. When he comes across Peter Parker the erstwhile saviour of New York in the multiverse Miles must train to become the new protector of his city."
]