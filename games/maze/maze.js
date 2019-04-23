/* GLOBAL VARIABLES: 
w, is a built in name for width and is not to be changed. Since it is p5.js API.
*/
var columns, rows;
var w = 75;
var grid = [];

var current;

var stack = [];

/* Creates canvas and grid of cells */
function setup() {
  createCanvas(windowWidth, windowHeight-65);
  columns = floor(width/w);
  rows = floor(height/w);
  

  for (var   j = 0; j < rows; j++) {
    for (var i = 0; i < columns; i++) {
      var cell = new Cell(i, j);
      grid.push(cell);
    }
  }

  current = grid[0];


}

/* Draws the random action that the "player-cell" is taking in frameRate(...) speed */
function draw() {
  frameRate(30);
  background(51);
  for (var i = 0; i < grid.length; i++) {
    grid[i].show();
  }

  current.visited = true;
  current.highlight();
  // STEP 1
  var next = current.checkNeighbors();
  if (next) {
    next.visited = true;

    // STEP 2
    stack.push(current);

    // STEP 3
    removeWalls(current, next);

    // STEP 4
    current = next;
  } else if (stack.length > 0) {
    current = stack.pop();
  }

}

function index(i, j) {
  if (i < 0 || j < 0 || i > columns-1 || j > rows-1) {
    return -1;
  }
  return i + j * columns;
}

/* Remove walls between last cell visited and current cell visited, when "player-cell" makes a move */
function removeWalls(a, b) {
  var x = a.i - b.i;
  if (x === 1) {
    a.walls[3] = false;
    b.walls[1] = false;
  } else if (x === -1) {
    a.walls[1] = false;
    b.walls[3] = false;
  }
  var y = a.j - b.j;
  if (y === 1) {
    a.walls[0] = false;
    b.walls[2] = false;
  } else if (y === -1) {
    a.walls[2] = false;
    b.walls[0] = false;
  }
}