function StarSpawn() {

  this.x = random(-width, width);
  this.y = random(-height, height);
  this.z = random(width);
  this.tempz = this.z;

  this.update = function() {
    this.z = this.z - starSpeed;
    if (this.z < 1) {
      this.z = width;
      this.x = random(-width, width);
      this.y = random(-height, height);
      this.tempz = this.z;
    }
  }

  this.show = function() {
    fill(255);
    noStroke();

    var tempx = map(this.x / this.z, 0, 1, 0, width);
    var tempy = map(this.y / this.z, 0, 1, 0, height);

    var r = map(this.z, 0, width, 16, 0);
    ellipse(tempx, tempy, r, r);

    var px = map(this.x / this.tempz, 0, 1, 0, width);
    var py = map(this.y / this.tempz, 0, 1, 0, height);

    this.tempz = this.z;

    stroke(255);
    line(px, py, tempx, tempy);

  }
  
}