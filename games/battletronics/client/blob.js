function Blob(x, y, size) {
  this.pos = createVector(x, y);
  var x = this.pos.x;
  var y = this.pos.y;
  var position;
  this.size = 12;
  var vel = createVector(this.x, this.y);

  this.update = function () {
    this.pos.add(position);
  };

  this.keyPressed = function () {
    if (keyCode === UP_ARROW) {
      y -= 3;
    } else if (keyCode === DOWN_ARROW) {
      y += 3;
    }
    if (keyCode === LEFT_ARROW) {
      x -= 3;
    } else if (keyCode === RIGHT_ARROW) {
      x += 3;
    }
    console.log(keyCode);
    //position = (x, y);
  };

  this.keyReleased = function () {
    if (keyCode === UP_ARROW) {
      keyCode = 0;
    } else if (keyCode === DOWN_ARROW) {
      keyCode = 0;
    }
    if (keyCode === LEFT_ARROW) {
      keyCode = 0;
    } else if (keyCode === RIGHT_ARROW) {
      keyCode = 0;
    }
    return false;
  };

  this.show = function () {
    fill(255);
    rect(x, y, this.size, this.size);
  };
}
