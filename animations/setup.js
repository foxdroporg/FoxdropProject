/* Setup manages the creation of canvas and the animation adaptation to mouse position */
var starArray = [];
var starSpeed;

function preload() {
  songTheme = loadSound("../soundeffects/starWars.mp3", loaded);
  //songTemple = loadSound("soundeffects/templeMarch.mp3", loaded);
}

function setup() {
  // Spread out workload better would be optimal.
  createCanvas(windowWidth, windowHeight-65);
  for (var i = 0; i < 1000; i++) {
    starArray[i] = new StarSpawn();
  }

  songTheme.setVolume(0.8);
  songTheme.loop();
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


function loaded() {
  console.log("Song finished loading, ready to play!");
}

