var cols, rows;
var scl = 20;
var w = 1000;
var h = 500;

var flying = 0;

var terrain = [];

var cnv;

function centerCanvas() {
  var cnvPosX = (windowWidth - width) / 2;
  var cnvPosY = (windowHeight - height) / 2;
  cnv.position(cnvPosX, cnvPosY);
}

function windowResized() {
  centerCanvas();
}

function setup() {
  cnv = createCanvas(600, 400, WEBGL); // For fullscreen make (windowWidth, windowHeight-65)
 centerCanvas();
  cols = w / scl;
  rows = h/ scl;

  for (var x = 0; x < cols; x++) {
    terrain[x] = [];
    for (var y = 0; y < rows; y++) {
      terrain[x][y] = 0; //specify a default value for now
    }
  }
}

function draw() {

  flying -= 0.025;
  var yoff = flying;
  for (var y = 0; y < rows; y++) {
    var xoff = 0;
    for (var x = 0; x < cols; x++) {
      terrain[x][y] = map(noise(xoff, yoff), 0, 1, -80, 80);
      xoff += 0.2;
    }
    yoff += 0.2;
  }


  background(250);
  translate(0, 50);
  rotateX(5*PI/12);
  fill(200,200,200, 50);
  translate(-w/2, -h/2);
  for (var y = 0; y < rows-1; y++) {
    beginShape(TRIANGLE_STRIP);
    for (var x = 0; x < cols; x++) {
      vertex(x*scl, y*scl, terrain[x][y]);
      vertex(x*scl, (y+1)*scl, terrain[x][y+1]);
    }
    endShape();
  }
}