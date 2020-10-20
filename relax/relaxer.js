var song;
var buttonToggle;

var canvas;

const container = document.querySelector(".container");
const text = document.querySelector(".text");

const totalTime = 7500;
const breatheTime = (totalTime / 5) * 2;
const holdTime = totalTime / 5;

breatheAnimation();

function breatheAnimation() {
  console.log("HIT");
  text.innerHTML = "Breathe In!";
  container.className = "container grow";

  setTimeout(() => {
    text.innerText = "Hold";

    setTimeout(() => {
      text.innerText = "Breathe Out!";
      container.className = "container shrink";
    }, holdTime);
  }, breatheTime);
}

setInterval(breatheAnimation, totalTime);

function preload() {
  song = loadSound("../soundeffects/ocean.mp3", loaded);
}

function setup() {
  song.setVolume(0.8);
  song.loop();
  buttonToggle = createButton("Play");
  buttonToggle.mousePressed(togglePlaying);
  buttonToggle.position(windowWidth / 50, windowHeight / 4);
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
  window.scrollTo(0, 0);
}

// add listener to disable scroll
window.addEventListener("scroll", noscroll);
