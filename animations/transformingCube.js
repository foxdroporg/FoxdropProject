let angle = 0;
let w = 25;
let ma;
let maxD;

var canvas;

/* Position of canvas on the webpage */
function centerCanvas() {
  var cnvPosX = (windowWidth - width) / 2;
  var cnvPosY = (windowHeight - height) / 4;
  canvas.position(cnvPosX, cnvPosY);
}

/* Makes sure position stays the same regardless of window resizing */
function windowResized() {
  centerCanvas();
}

function setup() {
	canvas = createCanvas(500, 500, WEBGL);
	centerCanvas();
	ma = atan(1 / sqrt(2));
	maxD = dist(0, 0, 200, 200);
}

function draw() {
	background(color(47, 9, 50));
	ortho(-400, 400, 400, -400, 0, 1000);
	rotateX(ma);
	rotateY(-QUARTER_PI);

	for (let z = 0; z < height; z += w) {
		for (let x = 0; x < width; x += w) {
			push();
			let d = dist(x, z, width/2, height/2);
			let offset = map(d, 0, maxD, -PI, PI);
			let a = angle + offset; 
			let h = floor(map(sin(a), -1, 1, 1, 300));
			translate(x - width / 2, 0, z - height / 2);
			normalMaterial();
			box(w - 1, h, w - 1);
			pop();
		}
	}
	angle -= 0.05;
	
}