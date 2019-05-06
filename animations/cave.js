var song;
var buttonToggle;

var canvas;

function preload() {
  song = loadSound("soundeffects/caveLife.mp3", loaded);
}

function setup() {
  song.setVolume(0.5);
  song.play();
}

function loaded() {
  console.log("Song finished loading, ready to play!");
}