var columns, rows;
var nrOfLevels = 0;
var scl = 40;
var grid = [];
var stack = [];

var current;
var player;
var finish;

var highlightShow = true;

var counter = 0;
var timeleft = 45;  // 45

function setup() {
  createCanvas(900, 700); //createCanvas(windowWidth/3, windowHeight/1.3-65);
  columns = floor(width/scl);
  rows = floor(height/scl);

  for (var j = 0; j < rows; j++) {
    for (var i = 0; i < columns; i++) {
      var cell = new Cell(i,j);
      grid.push(cell);
    }
  }
  current = grid[0];
  player = grid[0];
  var randomSpawnX = floor(random(columns/2, columns));
  var randomSpawnY = floor(random(rows/2, rows));
  finish = grid[index(randomSpawnX, randomSpawnY)];

  var timer = select('#timer');
  var points = select('#points');
  var interval = setInterval(timeIt, 1000);

  function timeIt() {
    timeleft = (45 - 3*nrOfLevels); // 45 instead of 10
    counter++;
    timer.html(timeleft - counter);
    points.html(nrOfLevels);

    // Game over - Time ran out.
    if (timeleft - counter <= 0) {

      console.log("User logged in? " + U_UID);
      if(U_UID == "false") {
        document.getElementById("highscoreTable").innerHTML = "Please sign up and log in on Foxdrop to see the highscores for this game!";
      }
      else {
        var highscoreForm = new FormData();

        highscoreForm.append("username", U_UID);
        highscoreForm.append("user_score", nrOfLevels);
        highscoreForm.append("game", "maze");

        fetch("../../../includes/scores.inc.php", {
          method: 'POST',
          body: highscoreForm
        }).then(function (response) {
          return response.json();
        })
        .then(function(scores) {
          console.log(scores)

          var highscores = '';
          var distinctUsernameArr = [];
          var i = 0;
          scores.forEach(function(score) {
            if(!distinctUsernameArr.includes(score[0])) {
              highscores += score[0] + ' ' + score[1] + ' points on ' + score[2] + '<br>';
            }
            distinctUsernameArr[i] = score[0];
            i++;
          })

          document.getElementById("highscoreTable").innerHTML = "Highscores: <br>" + highscores;
        }).catch(function(error) {
          console.error(error);
        });
      }


      var gameOverSound = new Audio("../../../soundeffects/gameOver.mp3");
      gameOverSound.play();
      clearInterval(interval);
      alert('TIMEOUT! Game over.');
      timeleft = 0;
      counter = 0;
      noLoop();
    }
  }

}

function index(i, j) {
  if (i < 0 || j < 0 || i > columns-1 || j > rows -1) {
    return -1;
  }
  return i + j * columns;
}

function draw() {
  frameRate(60);
  for (var i = 0; i < grid.length; i++) {
    grid[i].show();
  }

  player.visible();
  finish.visible();

  let n = 50;
  for (var i = 0; i < n; i++) {
    current.visited = true;

    if (i == n - 1) {
      current.highlight();
    }
    var next = current.checkNeighbors();

    if (next) {
      next.visited = true;
      removeLine(current,next);
      current = next;
      stack.push(current);
    }
  }
}

back = function() {
  if (!allChecked()) {
    stack.pop();
    current = stack[stack.length-1];
  }else{
    highlightShow = false;
  }
}

allChecked = function() {
  var finished = true;
  for (var i = 0; i < grid.length-1; i++) {
    if (!grid[i].visited) {
      finished = false;
    }
  }
  if (finished) {
    return true;
  }
  else {
    counter = 0;
    return false;
  }
}

removeLine = function(a, b) {
    var x = a.i - b.i;
    var y = a.j - b.j;
    if (y === 1) {a.walls[0] = false; b.walls[2] = false;} // top
    else if (x === -1 ) {a.walls[1] = false; b.walls[3] = false;} // right
    else if (y === -1 ) {a.walls[2] = false; b.walls[0] = false;} // bottom
    else if (x === 1) {a.walls[3] = false; b.walls[1] = false;}     // left
}



  document.addEventListener("keydown", function(event) {
    //console.log(event);
    if (event.which == 38 && !player.walls[0] || event.which == 87 && !player.walls[0]) {
      player = grid[index(player.i, player.j-1)];
    }
    else if (event.which == 39 && !player.walls[1] || event.which == 68 && !player.walls[1]) {
      player = grid[index(player.i+1, player.j)];
    }
    else if (event.which == 40 && !player.walls[2] || event.which == 83 && !player.walls[2]) {
      player = grid[index(player.i, player.j+1)];
    }
    else if (event.which == 37 && !player.walls[3] || event.which == 65 && !player.walls[3]) {
      player = grid[index(player.i-1, player.j)];
    }

    if (player === finish) {
      reset();
    }
  });


reset = function() {

  var goalReachedMazeSound = new Audio("../../../soundeffects/goalReachedMaze.mp3");
  goalReachedMazeSound.play();

  counter = 0;
  nrOfLevels++;
  grid = []
  fill(31, 150, 33, 100);

  for (var j = 0; j < rows; j++) {
    for (var i = 0; i < columns; i++) {
      var cell = new Cell(i,j);
      grid.push(cell);
    }
  }

  current = grid[0];
  player = grid[0];

  var randomSpawnX = floor(random(columns/2, columns));
  var randomSpawnY = floor(random(rows/2, rows));
  console.log("New point spawned at:", randomSpawnX, ",",randomSpawnY);

  finish = grid[index(randomSpawnX, randomSpawnY)];
}
