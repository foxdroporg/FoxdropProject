var song;
var sliderRate;
var sliderPan;

function setup() {
  createCanvas(200, 200);
  song = loadSound("videos/song.mp3", loaded);
  song.setVolume(0.5);
  sliderRate = createSlider(0, 1.5, 1, 0.01);
  sliderPan = createSlider(-1, 1, 0, 0.01);
}

function loaded() {
  song.play();
}

function draw() {
  background(100);
  song.pan(sliderPan.value());
  song.rate(sliderRate.value());
}