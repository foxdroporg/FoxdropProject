// Keep track of our socket connection
var socket;
var player1;
var player2;

function setup() {
  createCanvas(1900, 945);
  player1 = new Blob(20, 20, 10);
  player2 = new Blob(40, 40, 10);
  // Start a socket connection to the server
  // Some day we would run this server somewhere else
  /* socket = io.connect("http://localhost:3000");
  socket.on("mouse", newDrawing); */
}
/* 
function newDrawing(data) {
  noStroke();
  fill(255, 0, 100);
  ellipse(data.x, data.y, 36, 36);
}

function mouseDragged() {
  console.log("Sending: ");

  var data = {
    x: mouseX,
    y: mouseY,
  };
  socket.emit("mouse", data);

  noStroke();
  fill(255);
  ellipse(mouseX, mouseY, 36, 36);
}
 */

function draw() {
  background(0);

  player1.show();
  player1.update();
  player1.keyPressed();
  player1.keyReleased();

  // player2.show();
  //player2.keyPressed();
}

/* 
function setup() {
  createCanvas(400, 400);
  background(0);
  // Start a socket connection to the server
  // Some day we would run this server somewhere else
  socket = io.connect("http://localhost:3000");
  // We make a named event called 'mouse' and write an
  // anonymous callback function
  socket.on(
    "mouse",
    // When we receive data
    function (data) {
      console.log("Got: " + data.x + " " + data.y);
      // Draw a blue circle
      fill(0, 0, 255);
      noStroke();
      ellipse(data.x, data.y, 20, 20);
    }
  );
}

function draw() {
  // Nothing
}

function mouseDragged() {
  // Draw some white circles
  fill(255);
  noStroke();
  ellipse(mouseX, mouseY, 20, 20);
  // Send the mouse coordinates
  sendmouse(mouseX, mouseY);
}

// Function for sending to the socket
function sendmouse(xpos, ypos) {
  // We are sending!
  console.log("sendmouse: " + xpos + " " + ypos);

  // Make a little object with  and y
  var data = {
    x: xpos,
    y: ypos,
  };

  // Send that object to the socket
  socket.emit("mouse", data);
}
 */