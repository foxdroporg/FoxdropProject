var song;
var buttonToggle;

var canvas;

function preload() {
  song = loadSound("../soundeffects/rain.mp3", loaded);
}

function setup() {
  song.setVolume(0.8);
  song.loop();
   buttonToggle = createButton("Play");
  buttonToggle.mousePressed(togglePlaying);
  buttonToggle.position(windowWidth/50, windowHeight/4);
}

function loaded() {
  console.log("Song finished loading, ready to play!");
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

function noscroll() {
  window.scrollTo( 0, 0 );
}

// add listener to disable scroll
window.addEventListener('scroll', noscroll);