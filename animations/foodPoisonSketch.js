var vehicles = [];
var food = [];
var poison = [];

var debug;
var canvas;

// >>> SPAWN: AGENTS, FOOD, POISON <<<
function setup() {
  canvas = createCanvas(640, 360);
  for (var i = 0; i < 5; i++) {
    // 15
    var x = random(width);
    var y = random(height);
    vehicles[i] = new Vehicle(x, y);
  }

  for (var i = 0; i < 25; i++) {
    var x = random(25, width - 25);
    var y = random(25, height - 25);
    food.push(createVector(x, y));
  }

  for (var i = 0; i < 10; i++) {
    var x = random(25, width - 25);
    var y = random(25, height - 25);
    poison.push(createVector(x, y));
  }

  debug = createCheckbox();
  centerCanvas();
}

// >>> CANVAS IN MIDDLE <<<
function centerCanvas() {
  var cnvPosX = (windowWidth - width) / 2;
  var cnvPosY = (windowHeight - height) / 2;
  canvas.position(cnvPosX, cnvPosY);
  debug.position(cnvPosX + 310, cnvPosY + 370);
}

// >>> SPAWN: AGENTS - ON USER COMMAND <<<
function mouseDragged() {
  vehicles.push(new Vehicle(mouseX, mouseY));
}

// >>> DRAW <<<
function draw() {
  background(51);

  // Food Generator
  if (random(1) < 0.1) {
    var x = random(25, width - 25);
    var y = random(25, height - 25);
    food.push(createVector(x, y));
  }

  // Poison Generator
  if (random(1) < 0.01) {
    var x = random(25, width - 25);
    var y = random(25, height - 25);
    poison.push(createVector(x, y));
  }

  // Food Properties: position and size
  for (var i = 0; i < food.length; i++) {
    fill(0, 255, 0);
    noStroke();
    ellipse(food[i].x, food[i].y, 4, 4);
  }

  // Poison Properties: position and size
  for (var i = 0; i < poison.length; i++) {
    fill(255, 0, 0);
    noStroke();
    ellipse(poison[i].x, poison[i].y, 12, 12); // 8
  }

  // Agent Properties: for more info look in "Vechicle.js" file
  for (var i = vehicles.length - 1; i >= 0; i--) {
    vehicles[i].boundaries();
    vehicles[i].behaviors(food, poison);
    vehicles[i].update();
    vehicles[i].display();

    var newVehicle = vehicles[i].clone();
    if (newVehicle != null) {
      vehicles[i].blink();
      vehicles.push(newVehicle);
    }

    if (vehicles[i].dead()) {
      var x = vehicles[i].position.x;
      var y = vehicles[i].position.y;
      food.push(createVector(x, y));
      vehicles.splice(i, 1);
    }
  }
}
