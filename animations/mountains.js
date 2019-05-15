/* Global Variables: 
  columns, rows    //divides grid into parts
  scl              //variable name is not to be changed - is a p5.js keyword for scale
  w                //variable name is not to be changed - is a p5.js keyword for width 
  h                //variable name is not to be changed - is a p5.js keyword for height 
  birdPerspecive   //affects the grid's movementspeed 
  mountainTerrain  //holds information about positioning of verticies on polygons.
  canvas           //canvas is the whole window for the animation.
*/
var columns, rows;
var scl = 20;
var w = 1250;
var h = 850;

var birdPerspective = 0;

var mountainTerrain = [];

var song;
var buttonToggle;

var canvas;

function preload() {
  song = loadSound("soundeffects/birdFlybyMountainView.mp3", loaded);
}

/* Position of canvas on the webpage */
function centerCanvas() {
  var cnvPosX = (windowWidth - width) / 2;
  var cnvPosY = (windowHeight - height) / 4;
  canvas.position(cnvPosX, cnvPosY);
  buttonToggle.position(cnvPosX + 10, cnvPosY + 10);
}

/* Makes sure position stays the same regardless of window resizing */
function windowResized() {
  centerCanvas();
}

/* Creates canvas and two dimensional array */
function setup() {
  canvas = createCanvas(600, 400, WEBGL);           // For fullscreen make (windowWidth, windowHeight-65)
  //song = loadSound("soundeffects/birdFlyByMountainView.mp3", loaded);
  song.setVolume(0.6);
  buttonToggle = createButton("Unmute");
  buttonToggle.mousePressed(togglePlaying);
  centerCanvas();
  columns = w / scl;
  rows = h/ scl;

  for (var x = 0; x < columns; x++) {
    mountainTerrain[x] = [];
    for (var y = 0; y < rows; y++) {
      mountainTerrain[x][y] = 0;                    //specify a default value for now
    }
  }
}

/* Draws the animation of mountainTerrain. "noise" is built in p5.js and smooths out neighboring verticies. "beginShape" creates the polygons*/
function draw() {
  birdPerspective -= 0.1;
  var yoffset = birdPerspective;
  for (var y = 0; y < rows; y++) {
    var xoffset = 0;
    for (var x = 0; x < columns; x++) {
      mountainTerrain[x][y] = map(noise(xoffset, yoffset), 0, 1, -100, 125);
      xoffset += 0.2;
    }
    yoffset += 0.2;
  }

  ambientMaterial(70, 130, 230); //You could have this to get rid of Grid lines.
 

  background(color(47, 9, 50));
  translate(0, 50);
  rotateX(5*PI/12);
  fill(200,200,200, 50);
  translate(-w/2, -h/2);
  for (var y = 0; y < rows-1; y++) {
    beginShape(TRIANGLE_STRIP);
    for (var x = 0; x < columns; x++) {
      // texture(); // Something with texture is needed!
      vertex(x*scl, y*scl, mountainTerrain[x][y]);
      vertex(x*scl, (y+1)*scl, mountainTerrain[x][y+1]);
    }
    endShape();
  }
}

function togglePlaying() {
  if (!song.isPlaying()) {
    song.loop();
    buttonToggle.html("Mute");
  } else {
    song.pause();
    buttonToggle.html("Unmute");
  }
}

function loaded() {
  console.log("Song finished loading, ready to play!");
}