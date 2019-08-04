// Article to work from: https://rossta.net/blog/finding-four-in-a-row-ftw.html


var origBoard;
const playerX = 'X';
const playerO = 'O';

// Create function to check for wins. 
const winCombos = [
	[0,1,2],
	[3,4,5],
	[6,7,8],
	[0,3,6],
	[1,4,7],
	[2,5,8],
	[0,4,8],
	[6,4,2]
]

var numberOfX = 0;
var numberOfO = 0;
var playerTurn = 0;

var colCount = 8;
var rowCount = 8;

var gameWon = false;

const cells = document.querySelectorAll('.cell');
startGame();


var matrix = Array(8).fill(Array(0, 0, 0, 0, 0, 0, 0, 0, 0));

/* Starts game by pressing left-click, takes away background color from endgame screen */
function startGame() {
	document.querySelector('.endgame').style.display = "none";
	origBoard = Array.from(Array(64).keys());
	gameWon = false;
	for (var i = 0; i < cells.length; i++) {
		cells[i].innerText = '';
		cells[i].style.removeProperty('background-color');
		cells[i].addEventListener('click', turnClick, false);
	}
}

const min = num => Math.max(num - 3, 0);
const max = (num, max) => Math.min(num + 3, max);

const { row: focalRow, col: focalCol } = lastChecker;
const minCol = min(focalCol);
const maxCol = max(focalCol, this.colCount-1);
const minRow = min(focalRow);
const maxRow = max(focalRow, this.rowCount-1);



/* Turn is done by left clicking on the mouse. */
function turnClick(square) {
	//console.log(origBoard);
	//console.log(square);

	switch(playerTurn%2) {
		case 0:
			// PlayerX
			if ( typeof origBoard[square.target.id] == 'number') {
				numberOfX++;
				turn(square.target.id, playerX);
				if (!gameWon) {	
					playerTurn++;
				}
				var row = Math.floor(square.target.id / 8);
				var col = square.target.id % 8; // 0 means it is first col, 7 last col.
				matrix[row][col] = 1;
			}
		break;

		case 1:
			// PlayerO
			if ( typeof origBoard[square.target.id] == 'number') {
				numberOfO++;
				turn(square.target.id, playerO);
				if (!gameWon) {	
					playerTurn++;
				}
				var row = Math.floor(square.target.id / 8);
				var col = square.target.id % 8; // 0 means it is first col, 7 last col.
				matrix[row][col] = 2;
			}
		break;
	}
	console.log(matrix);
	//console.log(numberOfX);
	//console.log(numberOfO);
}

function turn(squareId, player) {
	origBoard[squareId] = player;
	document.getElementById(squareId).innerText = player;
	var color = playerTurn%2==0 ? "red" : "orange";
	document.getElementById(squareId).style.color = color;
	
	var rowId = Math.floor(square.target.id / 8);
	var colId = square.target.id % 8; 
	const markObject = { 
		row: rowId, 
		col: colId 
	};
	let gameWon = checkForWin(markObject); 

	if(gameWon) {
		gameOver(gameWon);
	}
}



checkForWin(markObject) {
  if (!markObject) return;

  const min = num => Math.max(num - 3, 0);
  const max = (num, max) => Math.min(num + 3, max);

  const { row: focalRow, col: focalCol } = markObject;
  const minCol = min(focalCol);
  const maxCol = max(focalCol, this.colCount-1);
  const minRow = min(focalRow);
  const maxRow = max(focalRow, this.rowCount-1);
  const coords = { focalRow, focalCol, minRow, minCol, maxRow, maxCol };
  console.log(coords);

  return this.checkHorizontalSegments(coords) ||
    this.checkVerticalSegments(coords) ||
    this.checkForwardSlashSegments(coords) ||
    this.checkBackwardSlashSegments(coords);
}

console.log(coords);
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


checkHorizontalSegments(coords.focalRow, coords.minCol, coords.maxCol) {
      for (let row = focalRow, col = minCol; col <= maxCol; col++) {
        const winner = this.getWinner([row, col], [row, col+1], [row, col+2], [row, col+3]);
        if (winner) return winner;
      }    
    }
    
checkVerticalSegments(focalRow, focalCol, minRow, maxRow) {
  for (let col = focalCol, row = minRow; row <= focalRow; row++) {
    const winner = this.getWinner([row, col], [row+1, col], [row+2, col], [row+3, col]);
    if (winner) return winner;
  }
}

checkForwardSlashSegments(focalRow, focalCol, minRow, minCol, maxRow, maxCol) {
  const startForwardSlash = (row, col) => {
    while(row > minRow && col > minCol) { row--; col--; }
    return [row, col]
  }
  for (let [row, col] = startForwardSlash(focalRow, focalCol); row <= maxRow && col <= maxCol; row++, col++) {
    const winner = this.getWinner([row, col], [row+1, col+1], [row+2, col+2], [row+3, col+3]);
    if (winner) return winner;
  }
}

checkBackwardSlashSegments({ focalRow, focalCol, minRow, minCol, maxRow, maxCol }) {
  const startBackwardSlash = (row, col) => {
    while(row < maxRow && col > minCol) { row++; col--; }
    return [row, col]
  }
  for (let [row, col] = startBackwardSlash(focalRow, focalCol); row >= minRow && col <= maxCol; row--, col++) {
    const winner = this.getWinner([row, col], [row-1, col+1], [row-2, col+2], [row-3, col+3]);
    if (winner) return winner;
  }
}
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

function gameOver(gameWon) {
	for (let index of winCombos[gameWon.index]) {
		document.getElementById(index).style.backgroundColor = 
			gameWon.player == playerX ? "green" : "green";
	}
	for(var i = 0; i < cells.length; i++){
		cells[i].removeEventListener('click', turnClick, false);
	}
	declareWinner(gameWon.player == playerX ? "Player X wins!" : "Player O wins!");
	numberOfX = 0;
	numberOfO = 0;
	playerTurn = 0;
}

function declareWinner(who) {
	gameWon = true;
	console.log(who);
	document.querySelector(".endgame").style.display = "block";
	document.querySelector(".endgame .text").innerText = who;
}



