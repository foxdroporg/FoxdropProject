function Cell(i,j) {
  this.i = i;
  this.j = j;
  this.walls = [true, true, true, true] // top right bottom left
  this.visited = false;
  
  this.show = function() {
    var x = this.i*scl;
    var y = this.j*scl;
    
    noFill();
    stroke(20);
    strokeWeight(10);
    
    if (this.walls[0]) {
      line(x    , y    , x + scl, y);   // Top
    }
    if (this.walls[1]) {
      line(x + scl, y    , x + scl, y + scl); // Right
    }
    if (this.walls[2]) {
      line(x + scl, y + scl, x    , y + scl); // Bottom
    }
    if (this.walls[3]) {
      line(x    , y + scl, x    , y); // Left
    }
    
    if (this.visited) {
      noStroke();
      fill(31, 150, 33, 100);
      rect(x,y,scl,scl);
    }
  }
  
  this.checkNeighbors = function() {
    var neighbors = []
    
    var top    = grid[index(i  , j-1)];
    var right  = grid[index(i+1, j  )];
    var bottom = grid[index(i  , j+1)];
    var left   = grid[index(i-1, j  )];
    
    if (top && !top.visited      ) {neighbors.push(top   );}
    if (right && !right.visited  ) {neighbors.push(right );}
    if (bottom && !bottom.visited) {neighbors.push(bottom);}
    if (left && !left.visited    ) {neighbors.push(left  );}
    
    if (neighbors.length > 0) {
      var r = floor(random(0,neighbors.length));
      return neighbors[r];
    }else{
      back();
    }
  }
  
  this.highlight = function() {
    if (highlightShow) {
      var x = this.i*scl;
      var y = this.j*scl;

      noStroke();  
      fill(255, 93, 0);
      rect(x,y,scl,scl);
    }
  }
  
  this.visible = function() {
    if (allChecked()) {
      var x = this.i*scl;
      var y = this.j*scl;

      noStroke();
      fill(255, 93, 0);
      rect(x+5,y+5,scl-10,scl-10);
    }
  }
} 