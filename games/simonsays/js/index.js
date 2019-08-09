// Using "var" is bad practice since they are global scope. "let" has smaller scope.

let order = [];
let playerOrder = [];
let flash;
let turn;
let good;
let compTurn;
let intervalId;
let strict = false;
let noise = true;
let on = false;
let win;

const turnCounter = document.querySelector("#turn"); // CSS selector. An element with the id turn.
const topLeft = document.querySelector("#topleft");
const topRight = document.querySelector("#topright");
const bottomLeft = document.querySelector("#bottomleft");
const bottomRight = document.querySelector("#bottomright");
const strictButton = document.querySelector("#strict");
const onButton = document.querySelector("#on");
const startButton = document.querySelector("#start");

strictButton.addEventListener('click', (event) => { // Always pass in the event into the function that is executed at 'click'
    console.log(strictButton);
    if (strictButton.checked == true) {
      strict = true;
    } else {
      strict = false;
    }
  });
  
  onButton.addEventListener('click', (event) => {   // Arrow function 
    if (onButton.checked == true) {
      on = true;
      turnCounter.innerHTML = "-";
    } 
    else {
      on = false;
      turnCounter.innerHTML = "";
      clearColor();
      clearInterval(intervalId);
      strictButton.disabled = false;
    }
  });
  
  startButton.addEventListener('click', (event) => {
    if (on || win) {
      strictButton.disabled = true; 
      play();
      console.log("Insane Difficulty: " + strict);
    }
  });
  
  function play() {
    win = false;
    order = [];
    playerOrder = [];
    flash = 0;
    intervalId = 0;
    turn = 1;
    turnCounter.innerHTML = 1;
    good = true;
    for (var i = 0; i < 20; i++) {
      order.push(Math.floor(Math.random() * 4) + 1);
    }
    compTurn = true;
  
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      intervalId = setInterval(gameTurn, 1000);
    } 
    else {
      intervalId = setInterval(gameTurn, 600);
    }
  }
  
  function gameTurn() {
    on = false;
  
    if (flash == turn) {
      clearInterval(intervalId);
      compTurn = false;
      clearColor();
      on = true;
    }
  
    if (compTurn) {
      clearColor();
      setTimeout(() => {
        if (order[flash] == 1) one();
        if (order[flash] == 2) two();
        if (order[flash] == 3) three();
        if (order[flash] == 4) four();
        flash++;
      }, 300);
    }
  }
  
  function one() {
    if (noise) {
      let audio = document.getElementById("clip1");
      audio.play();
    }
    noise = true;
    topLeft.style.backgroundColor = "lightgreen";
  }
  
  function two() {
    if (noise) {
      let audio = document.getElementById("clip2");
      audio.play();
    }
    noise = true;
    topRight.style.backgroundColor = "tomato";
  }
  
  function three() {
    if (noise) {
      let audio = document.getElementById("clip3");
      audio.play();
    }
    noise = true;
    bottomLeft.style.backgroundColor = "yellow";
  }
  
  function four() {
    if (noise) {
      let audio = document.getElementById("clip4");
      audio.play();
    }
    noise = true;
    bottomRight.style.backgroundColor = "lightskyblue";
  }
  
  function clearColor() {
    topLeft.style.backgroundColor = "darkgreen";
    topRight.style.backgroundColor = "darkred";
    bottomLeft.style.backgroundColor = "goldenrod";
    bottomRight.style.backgroundColor = "darkblue";
  }
  
  function flashColor() {
    topLeft.style.backgroundColor = "lightgreen";
    topRight.style.backgroundColor = "tomato";
    bottomLeft.style.backgroundColor = "yellow";
    bottomRight.style.backgroundColor = "lightskyblue";
  }
  
  topLeft.addEventListener('click', (event) => {
    if (on) {
      playerOrder.push(1);
      check();
      one();
      if(!win) {
        setTimeout(() => {
          clearColor();
        }, 300);
      }
    }
  })
  
  topRight.addEventListener('click', (event) => {
    if (on) {
      playerOrder.push(2);
      check();
      two();
      if(!win) {
        setTimeout(() => {
          clearColor();
        }, 300);
      }
    }
  })
  
  bottomLeft.addEventListener('click', (event) => {
    if (on) {
      playerOrder.push(3);
      check();
      three();
      if(!win) {
        setTimeout(() => {
          clearColor();
        }, 300);
      }
    }
  })
  
  bottomRight.addEventListener('click', (event) => {
    if (on) {
      playerOrder.push(4);
      check();
      four();
      if(!win) {
        setTimeout(() => {
          clearColor();
        }, 300);
      }
    }
  })
  
  function check() {
    if (playerOrder[playerOrder.length - 1] !== order[playerOrder.length - 1]) {
      good = false;
    }
  
    if (playerOrder.length == 20 && good) { // Decide when the player wins the game.
      winGame();
      strictButton.disabled = false;
    }
    else if (playerOrder.length == 10 && good && strict) {
      winGame();
      highscores();
      strictButton.disabled = false;
    }
  
    if (good == false) {
      flashColor();
      turnCounter.innerHTML = "NO!";
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        document.body.style.backgroundColor = "#ad1515";
        setTimeout(() => {
          document.body.style.backgroundColor = "#202020";
        }, 200);
      } 
      else {
        if (noise) {
          let audio = document.getElementById("clip5");
          audio.play();
        }
      }
      setTimeout(() => {
        turnCounter.innerHTML = turn;
        clearColor();
  
        if (strict) {
          play();
        } 
        else {
          compTurn = true;
          flash = 0;
          playerOrder = [];
          good = true;
          if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
            intervalId = setInterval(gameTurn, 1000);
          } 
          else {
            intervalId = setInterval(gameTurn, 600);
          }
        }
      }, 600);
  
      noise = false;
    }
    else if (turn == playerOrder.length && good && !win && !strict) {
      turn++;
      playerOrder = [];
      compTurn = true;
      flash = 0;
      turnCounter.innerHTML = turn;
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        document.body.style.backgroundColor = "green";
        setTimeout(() => {
          document.body.style.backgroundColor = "#202020";
        }, 200);
        intervalId = setInterval(gameTurn, 1000);
      } 
      else {
        intervalId = setInterval(gameTurn, 600);
      }
    }
    else if (turn == playerOrder.length && good && !win && strict) {
       // Make game harder. New order every time.
      order = [];
      for (var i = 0; i < turn+1; i++) {
        order.push(Math.floor(Math.random() * 4) + 1);
      }
      turn++;
      playerOrder = [];
      compTurn = true;
      flash = 0;
      turnCounter.innerHTML = turn;
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        document.body.style.backgroundColor = "green";
        setTimeout(() => {
          document.body.style.backgroundColor = "#202020";
        }, 200);
        intervalId = setInterval(gameTurn, 1000);
      } 
      else {
        intervalId = setInterval(gameTurn, 600);
      }
    }
  
  }
  
  function winGame() {
    flashColor();
    turnCounter.innerHTML = "WIN!";
    on = false;
    win = true;
  }

  function highscores() {
  // HIGHSCORE TABLE SHOWN
  console.log("User logged in? " + U_UID);
  if(U_UID == "false") {
    document.getElementById("highscoreTable").innerHTML = "Please sign up and log in on Foxdrop to see the highscores for this game!";
  }
  else {
    var highscoreForm = new FormData();

        highscoreForm.append("username", U_UID);
      highscoreForm.append("user_score", 20);
      highscoreForm.append("game", "simonsaysStrict");

      fetch("../../../includes/scores.inc.php", {
        method: 'POST',
        body: highscoreForm
      }).then(function (response) {
        return response.json();
      }).catch(function(error) {
        console.error(error);
      });
      document.getElementById("highscoreTable").innerHTML = "You have recieved an achievement for reaching 10 points on Simon Says, insane difficulty!";
  }
}