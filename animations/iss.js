var song;
var buttonToggle;

function preload() {
  song = loadSound("soundeffects/satellite.mp3", loaded);
}

function setup() {
	buttonToggle = createButton("Satellit song");
	buttonToggle.mousePressed(togglePlaying);
	centerCanvas();
  	song.setVolume(0.8);
}

function centerCanvas() {
	var cnvPosX = (windowWidth - width) / 2;
  	var cnvPosY = (windowHeight - height) / 4;
  	buttonToggle.position(cnvPosX/2 + 25, cnvPosY/1.5);
}

function windowResized() {
  centerCanvas();
}

function togglePlaying() {
	if (!song.isPlaying()) {
		song.loop();
		buttonToggle.html("Turn off sattelit song");
	} else {
		song.pause();
		buttonToggle.html("Satellit song");
	}
}

function loaded() {
  console.log("Song finished loading, ready to play!");
}