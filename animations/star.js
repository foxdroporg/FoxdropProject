/* StarSpawn determines where on the canvas a star should spawn */
function StarSpawn() {

  this.x = random(-width, width);
  this.y = random(-height, height);
  this.z = random(width);
  this.previousZ = this.z;

  this.update = function() {
    this.z = this.z - starSpeed;
    if (this.z < 1) {
      this.z = width;
      this.x = random(-width, width);
      this.y = random(-height, height);
      this.previousZ = this.z;
    }
    else if (this.z > 4500) {
      this.z = windowWidth;
      this.x = random(-windowWidth, windowWidth);
      this.y = random(-windowHeight, windowHeight);
      this.previousZ = this.z;
    }
  }

/* Draws the ellipses and speed dashes */
  this.show = function() {
    fill(255);
    noStroke();

    var sx = map(this.x / this.z, 0, 1, 0, width);
    var sy = map(this.y / this.z, 0, 1, 0, height);

    if (this.z > 1 && this.z < 2500) {
      var r = map(this.z, 0, width, 20, 0);
      ellipse(sx, sy, r, r);
    }
    if (this.z > 2500 && this.z < 4500) {
      var r = map(this.z, 0, width, 20, 0);
      ellipse(0, 0, 0, 0);
    }

    var px = map(this.x / this.previousZ, 0, 1, 0, width);
    var py = map(this.y / this.previousZ, 0, 1, 0, height);

    this.previousZ = this.z;

    stroke(255);
    line(px, py, sx, sy);

  }
  
}