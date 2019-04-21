var columns, rows;
var scale = 20;
var w = 1400; // 1400
var h = 1200; // 1200

var flyingPerspective = 0; 

var mountainTerrain = [];

// We create a grid of polygons. Shift/rotate it according to the x-axis. Finally we the Z-h of verticies in the polygons. 
function setup() {
  createCanvas(600, 600, WEBGL); //createCanvas(1920, 900, WEBGL);
  columns = w / scale;
  rows = h/ scale;

  for (var x = 0; x < columns; x++) {
    mountainTerrain[x] = [];
    for (var y = 0; y < rows; y++) {
      mountainTerrain[x][y] = 0; //specify a default value to start with.
    }
  }
}

function draw() {
  flyingPerspective -= 0.1;
  var yoffset = flyingPerspective;
  for (var y = 0; y < rows; y++) {
    var xoffset = 0;
    for (var x = 0; x < columns; x++) {
      mountainTerrain[x][y] = map(noise(xoffset, yoffset), 0, 1, -100, 100);  // Noise is an built-in function in processing. It forces neighboring verticies to stay close to each other in Z-h.    
      xoffset += 0.2;
    }
    yoffset += 0.2;
  }

  background(0);
  stroke(255);
  noFill();

  translate(width/2, height/2 + 50);
  rotateX(PI/3);
  translate(-w/2, -h/2);

  for (var y = 0; y < rows-1; y++) {
    beginShape(TRIANGLE_STRIP);
    for (var x = 0; x < columns; x++) {
      vertex(x*scale, y*scale, mountainTerrain[x][y]);
      vertex(x*scale, (y+1)*scale, mountainTerrain[x][y+1]);
    }
    endShape();
  }
}