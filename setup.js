
var starArray = [];
var starSpeed;

function setup() {
  createCanvas(windowWidth, windowHeight-65);
  for (var i = 0; i < 1000; i++) {
    starArray[i] = new StarSpawn();
  }
}

function draw() {
  starSpeed = map(mouseX, 0, width, -50, 50);
  background(0);
  translate(width / 2, height / 2);
  for (var i = 0; i < starArray.length; i++) {
    starArray[i].update();
    starArray[i].show();
  }
}