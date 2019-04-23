var columns, rows;
var scl = 20;
var w = 1000;
var h = 500;

var birdPerspective = 0;

var mountainTerrain = [];

var cnv;

function centerCanvas() {
  var cnvPosX = (windowWidth - width) / 2;
  var cnvPosY = (windowHeight - height) / 4;
  cnv.position(cnvPosX, cnvPosY);
}

function windowResized() {
  centerCanvas();
}

function setup() {
  cnv = createCanvas(600, 400, WEBGL); // For fullscreen make (windowWidth, windowHeight-65)
 centerCanvas();
  columns = w / scl;
  rows = h/ scl;

  for (var x = 0; x < columns; x++) {
    mountainTerrain[x] = [];
    for (var y = 0; y < rows; y++) {
      mountainTerrain[x][y] = 0; //specify a default value for now
    }
  }
}

function draw() {
  birdPerspective -= 0.05;
  var yoffset = birdPerspective;
  for (var y = 0; y < rows; y++) {
    var xoffset = 0;
    for (var x = 0; x < columns; x++) {
      mountainTerrain[x][y] = map(noise(xoffset, yoffset), 0, 1, -80, 80);
      xoffset += 0.2;
    }
    yoffset += 0.2;
  }


  background(color(47, 9, 50));
  translate(0, 50);
  rotateX(5*PI/12);
  fill(200,200,200, 50);
  translate(-w/2, -h/2);
  for (var y = 0; y < rows-1; y++) {
    beginShape(TRIANGLE_STRIP);
    for (var x = 0; x < columns; x++) {
      vertex(x*scl, y*scl, mountainTerrain[x][y]);
      vertex(x*scl, (y+1)*scl, mountainTerrain[x][y+1]);
    }
    endShape();
  }
}