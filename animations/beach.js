var song;
var buttonToggle;

var canvas;

function preload() {
  song = loadSound("soundeffects/beach.mp3", loaded);
}

function setup() {
  song.setVolume(0.5);
  song.play();
}

function loaded() {
  console.log("Song finished loading, ready to play!");
}

function noscroll() {
  window.scrollTo( 0, 0 );
}

// add listener to disable scroll
window.addEventListener('scroll', noscroll);