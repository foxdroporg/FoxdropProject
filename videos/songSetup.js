var song;
var sliderRate;
var sliderPan;
var buttonToggle;
var buttonReset;
var amp;
var canvas;

function setup() {
  canvas = createCanvas(450, 450);
  song = loadSound("videos/song.mp3", loaded);
  song.setVolume(0.5);

  buttonToggle = createButton("Play");
  buttonToggle.mousePressed(togglePlaying);
  buttonReset = createButton("Reset");
  buttonReset.mousePressed(resetPlaying);

  sliderRate = createSlider(0.85, 1.15, 1, 0.01);
  sliderPan = createSlider(-1, 1, 0, 0.01);

  centerCanvas();

  amp = new p5.Amplitude();
}

function centerCanvas() {
  var cnvPosX = (windowWidth - width) / 2;
  var cnvPosY = (windowHeight - height) / 4;
  canvas.position(cnvPosX, cnvPosY);
  buttonToggle.position(cnvPosX + 10, cnvPosY + 10);
  buttonReset.position(cnvPosX + 380, cnvPosY + 10);
  sliderRate.position(cnvPosX + 140, cnvPosY + 420);
  sliderPan.position(cnvPosX + 140, cnvPosY + 10);
}

/* Makes sure position stays the same regardless of window resizing */
function windowResized() {
  centerCanvas();
}


function togglePlaying() {
	if (!song.isPlaying()) {
		song.play();
		buttonToggle.html("Pause");
	} else {
		song.pause();
		buttonToggle.html("Play");
	}
}

function resetPlaying() {
	song.stop();
	buttonToggle.html("Play");
}

function loaded() {
  console.log("Song finished loading, ready to play!");
}

function draw() {
  var val1 = sliderRate.value();
  var val2 = sliderPan.value();
  background(val1, 100, 100, 1);

  var vol = amp.getLevel();

  fill(255,0,0);
  ellipse(width/2, height/2, 1250*vol, 1250*vol);

  song.pan(sliderPan.value());
  song.rate(sliderRate.value());
}