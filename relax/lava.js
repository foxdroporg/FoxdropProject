/*

Youtube Audio !!!

*/
// This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player1;
function onYouTubeIframeAPIReady() {
  var ctrlq1 = document.getElementById("youtube-audio1");
  ctrlq1.innerHTML = '<img id="youtube-icon1" src=""/><div id="youtube-player1" src=""></div>';
  ctrlq1.style.cssText = 'width:150px;margin:2em auto;cursor:pointer;cursor:hand;display:none';
  ctrlq1.onclick = toggleAudio1;

  player1 = new YT.Player('youtube-player1', {
    height: '0',
    width: '0',
    videoId: ctrlq1.dataset.video,
    playerVars: {
      autoplay: ctrlq1.dataset.autoplay,
      loop: ctrlq1.dataset.loop,
    },
    events: {
      'onReady': onPlayerReady1,
      'onStateChange': onPlayerStateChange1 
    } 
  });
}

function togglePlayButton1(play) {    
  document.getElementById("youtube-icon1").src = play ? "https://i.imgur.com/IDzX9gL.png" : "https://i.imgur.com/quyUPXN.png";
}

function toggleAudio1() {
  if ( player1.getPlayerState() == 1 || player1.getPlayerState() == 3 ) {
    player1.pauseVideo(); 
    togglePlayButton1(false);
  } else {
    player1.playVideo(); 
    togglePlayButton1(true);
  } 
} 

function onPlayerReady1(event) {
  player1.setPlaybackQuality("small");
  document.getElementById("youtube-audio1").style.display = "block";
  togglePlayButton1(player1.getPlayerState() !== 5);
}

function onPlayerStateChange1(event) {
  if (event.data === 0) {
    togglePlayButton1(false); 
  }
}



var song;
var buttonToggle;

var canvas;

function preload() {
  song = loadSound("../soundeffects/lavaFlow.mp3", loaded);
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