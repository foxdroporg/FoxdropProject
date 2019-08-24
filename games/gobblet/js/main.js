var origBoard;
var playerX = 'X';
var playerO = 'O';
var scaleFactor; 
var mobile;
var ipad = false;

//console.log(window.innerWidth);
if(window.innerWidth < 768) {
 scaleFactor = 1.0;
 mobile = true;
} 
else if(window.innerWidth >= 768 && window.innerWidth < 1000) {
 ipad = true;
 scaleFactor = 2.2;
}
else {
 scaleFactor = 2.2;
 mobile = false;
}

const winCombos = [
	[0,1,2, 3],
	[0,5,10,15],
	[0,4,8,12],
	[1,5,9,13],
	[2,6,10,14],
	[3,7,11,15],
	[3,6,9,12],
	[4,5,6,7],
	[8,9,10,11],
	[12,13,14,15]
]
var playerTurn = 0;
var removedPiece = false;
var selectedCircle = 0;
var radiusString;	// Is used when a piece is moved from one cell to another.
var forceToMovePiece = -1; // -1 = inactive

var whitePieces = [
	[1, 1, 1, 1],	// Stack 1. Display 0 if piece of size is on playing field.
	[1, 1, 1, 1],	// Stack 2
	[1, 1, 1, 1]	// Stack 3
];
var blackPieces = [
	[1, 1, 1, 1],	// Stack 1
	[1, 1, 1, 1],	// Stack 2
	[1, 1, 1, 1]	// Stack 3
];

var origBoardMemory = [	// 16 cells
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
	[0, 0, 0, 0],
];

var threeInARowArr = [
	[0,1,2],
	[1,2,3],
	[4,5,6],
	[5,6,7],
	[8,9,10],
	[9,10,11],
	[12,13,14],
	[13,14,15], // All Horizontal
	[0,4,8],
	[4,8,12],
	[1,5,9],
	[5,9,13],
	[2,6,10],
	[6,10,14],
	[3,7,11],
	[7,11,15], // All Vertical
	[4,9,14],
	[0,5,10],
	[5,10,15],
	[1,6,11],
	[2,5,8],
	[3,6,9],
	[6,9,12],
	[7,10,13] // All Diagonal
];

var gameWon = false;

/* IMPORTANT to support Mobile Devices*/
let widthCanvas;
let heightCanvas;
if(!mobile) {
	widthCanvas = 500;
	heightCanvas = 350;
} else {
	widthCanvas = 272;
	heightCanvas = 190;
}

let large = width/8; 
let medium = width/10;
let small = width/15;
let mini = width/30;


const cells = document.querySelectorAll('.cell');
startGame();

function reloadPage() {
	location.reload(); 
}

/* Starts game by pressing left-click, takes away background color from endgame screen */
function startGame() {
	document.querySelector('.endgame').style.display = "none";
	origBoard = Array.from(Array(16).keys());
	gameWon = false;
	for (var i = 0; i < cells.length; i++) {
		cells[i].innerText = '';
		cells[i].style.removeProperty('background-color');
		if(mobile === false) {
			cells[i].addEventListener('click', turnClick, false);
		}
		else if (mobile === true || ipad === true){
			cells[i].addEventListener('touchstart', (event) => {
				event.preventDefault();
				turnClick(event);
			}, false); 
		} 
	}
	const canvas = document.querySelector("#canvas");
	if(mobile === false) {
		canvas.addEventListener('click', turnClickCanvas, false); 
	}
	else if (mobile === true || ipad === true){
		canvas.addEventListener('touchstart', (event) => { 
			event.preventDefault();
			turnClickCanvas(event);
		}, false); 
	}
}

function turnClickCanvas(square) {
	let x;
	let y;
	if(mobile === false) {
		x = (square.clientX - square.explicitOriginalTarget.offsetLeft);
		y = (square.clientY - square.explicitOriginalTarget.offsetTop);
	} else if (mobile === true || ipad === true){
		//console.log(square);
		x = (square.touches[0].clientX - square.touches[0].target.offsetLeft);
		y = (square.touches[0].clientY - square.touches[0].target.offsetTop);
		//window.alert("Touched Canvas " + x + " " + y);
	}
	// width & height is for canvas does not work if 
	const points = [
		[widthCanvas/6, heightCanvas/5],	// 1st Circle White
		[widthCanvas/2, heightCanvas/5],
		[widthCanvas/1.2, heightCanvas/5],
		[widthCanvas/6, heightCanvas/1.5],	// 1st Circle Black
		[widthCanvas/2, heightCanvas/1.5],
		[widthCanvas/1.2, heightCanvas/1.5]
	];
	var minDist;
	var placeholder;
	var circleIndex = 0;
	points.forEach((element, i) => {
		if(i==0) {
			minDist = Math.sqrt(Math.pow(element[0]-x, 2)+Math.pow(element[1]-y, 2));
			return;
		}
		placeholder = Math.sqrt(Math.pow(element[0]-x, 2)+Math.pow(element[1]-y, 2));
		if(placeholder < minDist) {
			minDist = placeholder;
			circleIndex = i;
		}
	});
	selectedCircle = circleIndex;
}

/*
let gameWon = checkWin(origBoard, player);
if(gameWon) gameOver(gameWon);
*/
function turnClick(square) {
	//console.log(square);
	let radius; 
	if(square.target.id === forceToMovePiece) {
		return;
	}

	switch(playerTurn%2) {
		case 0:
			// PlayerX
			if ( typeof origBoard[square.target.id] == 'number' ) {
				if(removedPiece) { 
					radius = parseFloat(radiusString.substring(radiusString.lastIndexOf(":") + 1, radiusString.lastIndexOf(";"))); 
					turn(square.target.id, playerX, radius);
					if (!gameWon) {	
						playerTurn++;
					} 
					removedPiece = false;
					origBoardMemoryInsert(radius/scaleFactor, square.target.id, "WHITE");
					forceToMovePiece = -1;
				}
				else if(selectedCircle <= 2) {
					radius = determineCircleRadius("WHITE");
					if(radius !== 0) { 
						turn(square.target.id, playerX, radius*scaleFactor);
						origBoardMemoryInsert(radius, square.target.id, "WHITE");
						updateCanvas('X', 'REMOVE');
						if (!gameWon) {	
							playerTurn++;
						} 
						turnMessage("BLACK");
					}
				}
				gameWon = checkWin(origBoard, playerO);
				if(gameWon) gameOver(gameWon);
			}
			else if (origBoard[square.target.id] == 'X' && !removedPiece && selectedCircle === -1) {
				origBoard[square.target.id] = parseInt(square.target.id, 10); 

				radiusString = document.getElementById(square.target.id).innerHTML;	
				radius = parseFloat(radiusString.substring(radiusString.lastIndexOf(":") + 1, radiusString.lastIndexOf(";"))); 
				origBoardMemoryRemove(radius/scaleFactor, square.target.id);
				document.getElementById(square.target.id).innerHTML = '';

				if(checkForGobblet(radius/scaleFactor, square.target.id)) {
					let radiusAndPlayer = findGobbletUnder(radius/scaleFactor, square.target.id);
					if(radiusAndPlayer[1] === 'O') playerTurn++;
					turnPickedUpGobblet(square.target.id, radiusAndPlayer[1], radiusAndPlayer[0]*scaleFactor); 
					if(radiusAndPlayer[1] === 'O') playerTurn--;
				}
				forceToMovePiece = square.target.id;
				removedPiece = true;
				turnMessage("WHITE");
			}
			else if ((origBoard[square.target.id] == 'X' || origBoard[square.target.id] == 'O') && removedPiece) {	// Gobblet over own OR enemy
				radius = parseFloat(radiusString.substring(radiusString.lastIndexOf(":") + 1, radiusString.lastIndexOf(";"))); 
				if(checkCellAvailablilty(radius/scaleFactor, square.target.id)) {
					origBoardMemoryInsert(radius/scaleFactor, square.target.id, "WHITE");
					turn(square.target.id, playerX, radius); 
					if (!gameWon) {	
						playerTurn++;
					} 
					removedPiece = false;
					turnMessage("BLACK");
					forceToMovePiece = -1;
					gameWon = checkWin(origBoard, playerO);
					if(gameWon) gameOver(gameWon);
				}
			}
			else if(checkThreeInARow(origBoard, playerO) && origBoard[square.target.id] == 'O' && !removedPiece) {
				radius = determineCircleRadius("WHITE");
				if(radius !== 0 && checkCellAvailablilty(radius, square.target.id)) { 
					turn(square.target.id, playerX, radius*scaleFactor);
					origBoardMemoryInsert(radius, square.target.id, "WHITE"); 
					updateCanvas('X', 'REMOVE');
					if (!gameWon) {	
						playerTurn++;
					} 
					turnMessage("BLACK");
					gameWon = checkWin(origBoard, playerO);
					if(gameWon) gameOver(gameWon);
				}
			}
		break;

		case 1:
			// PlayerO
			if ( typeof origBoard[square.target.id] == 'number' ) {
				if(removedPiece) {
					radius = parseFloat(radiusString.substring(radiusString.lastIndexOf(":") + 1, radiusString.lastIndexOf(";"))); 
					turn(square.target.id, playerO, radius);
					if (!gameWon) {	
						playerTurn++;
					} 
					removedPiece = false;
					origBoardMemoryInsert(radius/scaleFactor, square.target.id, "BLACK");
					forceToMovePiece = -1;
				}
				else if(selectedCircle >= 3) {
					radius = determineCircleRadius("BLACK")
					if(radius !== 0) {
						turn(square.target.id, playerO, radius*scaleFactor);
						origBoardMemoryInsert(radius, square.target.id, "BLACK");
						updateCanvas('O', 'REMOVE');
						if (!gameWon) {	
							playerTurn++;
						} 
						turnMessage("WHITE");
					}
				}
				gameWon = checkWin(origBoard, playerX);
				if(gameWon) gameOver(gameWon);
			}
			else if (origBoard[square.target.id] == 'O' && !removedPiece && selectedCircle === -1) { 
				origBoard[square.target.id] = parseInt(square.target.id, 10); 

				radiusString = document.getElementById(square.target.id).innerHTML;	
				radius = parseFloat(radiusString.substring(radiusString.lastIndexOf(":") + 1, radiusString.lastIndexOf(";"))); 
				origBoardMemoryRemove(radius/scaleFactor, square.target.id);
				document.getElementById(square.target.id).innerHTML = '';

				if(checkForGobblet(radius/scaleFactor, square.target.id)) {
					let radiusAndPlayer = findGobbletUnder(radius/scaleFactor, square.target.id);
					if(radiusAndPlayer[1] === 'X') playerTurn++;
					turnPickedUpGobblet(square.target.id, radiusAndPlayer[1], radiusAndPlayer[0]*scaleFactor); 
					if(radiusAndPlayer[1] === 'X') playerTurn--;
				}
				forceToMovePiece = square.target.id;
				removedPiece = true;
				turnMessage("BLACK");
			}
			else if ((origBoard[square.target.id] == 'X' || origBoard[square.target.id] == 'O') && removedPiece) { // Gobblet over own OR enemy
				radius = parseFloat(radiusString.substring(radiusString.lastIndexOf(":") + 1, radiusString.lastIndexOf(";"))); 
				if(checkCellAvailablilty(radius/scaleFactor, square.target.id)) {
					origBoardMemoryInsert(radius/scaleFactor, square.target.id, "BLACK");
					turn(square.target.id, playerO, radius); 
					if (!gameWon) {	
						playerTurn++;
					} 
					removedPiece = false;
					turnMessage("WHITE");
					forceToMovePiece = -1;
					gameWon = checkWin(origBoard, playerX);
					if(gameWon) gameOver(gameWon);
				}
			}
			else if(checkThreeInARow(origBoard, playerX) && origBoard[square.target.id] == 'X' && !removedPiece) {
				radius = determineCircleRadius("BLACK");
				if(radius !== 0 && checkCellAvailablilty(radius, square.target.id)) { 
					turn(square.target.id, playerO, radius*scaleFactor);
					origBoardMemoryInsert(radius, square.target.id, "BLACK"); 
					updateCanvas('O', 'REMOVE');
					if (!gameWon) {	
						playerTurn++;
					} 
					turnMessage("WHITE");
					gameWon = checkWin(origBoard, playerX);
					if(gameWon) gameOver(gameWon);
				}
			}
		break;
	}
	selectedCircle = -1;
	//console.log("Memory: ",origBoardMemory);
}

function checkForGobblet(circleRadius, id){
	let radiusID;
	if (circleRadius-large > -0.1 && circleRadius-large < 0.1) {
		radiusID = 1;
	} else if (circleRadius === medium) {
		radiusID = 2;
	} else if (circleRadius === small) {
		radiusID = 3;
	} else if (circleRadius === mini) {
		return false;
	}
	//console.log("radiusID ",radiusID);
	//console.log("Radius ",circleRadius);

	for(let i=0; i<origBoardMemory[id].length; i++){ // i=radiusID 		Used to be.
		if(origBoardMemory[id][i] !== 0) {
			return true;
		}
	}
}

function findGobbletUnder(circleRadius, id){
	// Return array of: radius AND X or O.
	let arrRadiusAndColor = [];
	let colorNumber;
	let radius;
	for(let i=0; i<origBoardMemory[id].length; i++){
		if(origBoardMemory[id][i] !== 0) {
			colorNumber = origBoardMemory[id][i];
			switch(i) {
				case 1:
					radius = medium;
				break;
				case 2:
					radius = small;
				break;
				case 3:
					radius = mini;
				break;
			}
			break;
		}
	}
	if(colorNumber === 1) {
		arrRadiusAndColor[0] = radius;
		arrRadiusAndColor[1] = "X";
		return arrRadiusAndColor;
	} 
	else if(colorNumber === 2) {
		arrRadiusAndColor[0] = radius;
		arrRadiusAndColor[1] = "O";
		return arrRadiusAndColor;
	}
	return;
}

function checkCellAvailablilty(circleRadius, id){
	let numberInCell;
	if (circleRadius-large > -0.1 && circleRadius-large < 0.1) {
		numberInCell = origBoardMemory[id][0];
		return numberInCell == 0;
	} else if (circleRadius === medium) {
		numberInCell = origBoardMemory[id][0];
		if(numberInCell == 0)
			numberInCell = origBoardMemory[id][1];
		return numberInCell == 0;
	} else if (circleRadius === small) {
		numberInCell = origBoardMemory[id][0];
		if(numberInCell == 0)
			numberInCell = origBoardMemory[id][1];
		if(numberInCell == 0)
			numberInCell = origBoardMemory[id][2];
		return numberInCell == 0;
	} else if (circleRadius === mini) {
		numberInCell = origBoardMemory[id][0];
		if(numberInCell == 0)
			numberInCell = origBoardMemory[id][1];
		if(numberInCell == 0)
			numberInCell = origBoardMemory[id][2];
		if(numberInCell == 0)
			numberInCell = origBoardMemory[id][3];
		return numberInCell == 0;
	}
}

function origBoardMemoryInsert(circleRadius, id, color){
	let colorNumber;
	color === "WHITE" ? colorNumber = 1 : colorNumber = 2;
	
	if (circleRadius-large > -0.1 && circleRadius-large < 0.1) {
		origBoardMemory[id][0] = colorNumber;
	} else if (circleRadius === medium) {
		origBoardMemory[id][1] = colorNumber;
	} else if (circleRadius === small) {
		origBoardMemory[id][2] = colorNumber;
	} else if (circleRadius === mini) {
		origBoardMemory[id][3] = colorNumber;
	}
}

function origBoardMemoryRemove(circleRadius, id){
	if(circleRadius-large > -0.1 && circleRadius-large < 0.1) {
		origBoardMemory[id][0] = 0;
	} else if (circleRadius === medium) {
		origBoardMemory[id][1] = 0;
	} else if (circleRadius === small) {
		origBoardMemory[id][2] = 0;
	} else if (circleRadius === mini) {
		origBoardMemory[id][3] = 0;
	}
}


// updateCanvas is now only used to remove from canvas.
function updateCanvas(playerTurn, action) {
	let radius;
	switch(playerTurn) {
		case 'X':
			switch(selectedCircle) {
				case 0:
					for(i=0; i < whitePieces[0].length; i++) {
						if(whitePieces[0][i] === 1) {
							whitePieces[0][i] = 0;
							break;
						}
					}
					radius = determineCircleRadius("WHITE");
					removeCircle(width/6, height/5, width/8);
					addCircle(width/6, height/5, radius);
				break;
				case 1:
					for(i=0; i < whitePieces[1].length; i++) {
						if(whitePieces[1][i] === 1) {
							whitePieces[1][i] = 0;
							break;
						}
					}
					radius = determineCircleRadius("WHITE");
					removeCircle(width/2, height/5, width/8);
					addCircle(width/2, height/5, radius);
				break;
				case 2:
					for(i=0; i < whitePieces[2].length; i++) {
						if(whitePieces[2][i] === 1) {
							whitePieces[2][i] = 0;
							break;
						}
					}
					radius = determineCircleRadius("WHITE");
					removeCircle(width/1.2, height/5, width/8);
					addCircle(width/1.2, height/5, radius);
				break;
			}
		break;
		
		case 'O':
			switch(selectedCircle) {
				case 3:
					for(i=0; i < blackPieces[0].length; i++) {
						if(blackPieces[0][i] === 1) {
							blackPieces[0][i] = 0;
							break;
						}
					}
					radius = determineCircleRadius("BLACK");
					removeCircle(width/6, height/1.5, width/8);
					addCircle(width/6, height/1.5, radius);
				break;
				case 4:
					for(i=0; i < blackPieces[1].length; i++) {
						if(blackPieces[1][i] === 1) {
							blackPieces[1][i] = 0;
							break;
						}
					}
					radius = determineCircleRadius("BLACK");
					removeCircle(width/2, height/1.5, width/8);
					addCircle(width/2, height/1.5, radius);
				break;
				case 5:
					for(i=0; i < blackPieces[2].length; i++) {
						if(blackPieces[2][i] === 1) {
							blackPieces[2][i] = 0;
							break;
						}
					}
					radius = determineCircleRadius("BLACK");
					removeCircle(width/1.2, height/1.5, width/8);
					addCircle(width/1.2, height/1.5, radius);
				break;
			}
		break;
	}
	//console.log("White: ",whitePieces);
	//console.log("Black: ",blackPieces);
}

function determineCircleRadius(color){
	let sizeID;
	let radius;
	if(color==="WHITE") {
		for(var i=0; i<whitePieces[selectedCircle].length; i++) {
			if (whitePieces[selectedCircle][i] === 1) {
				sizeID = i;
				break;
			}
		}
	}
	else {
		for(var i=0; i<blackPieces[selectedCircle-3].length; i++) {
			if (blackPieces[selectedCircle-3][i] === 1) {
				sizeID = i;
				break;
			}
		}
	}
	switch(sizeID) {
		case 0:
			radius = large;
		break;
		case 1:
			radius = medium;
		break;
		case 2:
			radius = small;
		break;
		case 3:
			radius = mini;
		break;
		default:
			radius = 0;
		break;
	}
	return radius;
}

function removeCircle(x, y, radius) {
	var ctx = c.getContext("2d");
	ctx.beginPath();        
    ctx.arc(x, y, radius, 0, 2 * Math.PI);
    ctx.fillStyle = "rgb(75,109,22)";
    ctx.fill();
}

function addCircle(x, y, radius) {
	var ctx = c.getContext("2d");
	ctx.beginPath();        
    ctx.arc(x, y, radius, 0, 2 * Math.PI);
    if(playerTurn%2 === 0) {
    	ctx.fillStyle = "white";
    }
    else {
    	ctx.fillStyle = "black";
    }
    ctx.fill();
}

function turnMessage(turn) {
	document.querySelector(".playerTurn").style.display = "block";
	if(turn === "WHITE") {
		document.querySelector(".playerTurn .textTurn").innerText = `White's Turn`;
	} else {
		document.querySelector(".playerTurn .textTurn").innerText = `Black's Turn`;
	}
	setTimeout(() => { 
    	document.querySelector(".playerTurn").style.display = "none";
    }, 1000);
}

function turnPickedUpGobblet(squareId, player, size) {
	origBoard[squareId] = player;
	switch(playerTurn%2) {
		case 0:
			document.getElementById(squareId).innerHTML = '<img style="width:'+size+'; height:'+size+';" src="../../images/whiteCircle.png">';
		break;
		case 1:
			document.getElementById(squareId).innerHTML = '<img style="width:'+size+'; height:'+size+';" src="../../images/blackCircle.png">';
		break;
	}
}

function turn(squareId, player, size) {
	origBoard[squareId] = player;
	switch(playerTurn%2) {
		case 0:
			document.getElementById(squareId).innerHTML = '<img style="width:'+size+'; height:'+size+';" src="../../images/whiteCircle.png">';
		break;
		case 1:
			document.getElementById(squareId).innerHTML = '<img style="width:'+size+'; height:'+size+';" src="../../images/blackCircle.png">';
		break;
	}
	let gameWon = checkWin(origBoard, player)
	if(gameWon) gameOver(gameWon)
}

function checkThreeInARow(board, player) {
	// Way to find every index that the player has played in.
	let plays = board.reduce((accumulator, element, index) =>
		(element === player) ? accumulator.concat(index) : accumulator, []);
	
	// Array iterator, "winCombos.entries()"
	for(let [index, win] of threeInARowArr.entries()) {
		if(win.every(elem => plays.indexOf(elem) > -1)) {
			return true;
		}
	}
	return false;
}

function checkWin(board, player) {
	// Way to find every index that the player has played in.
	let plays = board.reduce((accumulator, element, index) =>
		(element === player) ? accumulator.concat(index) : accumulator, []);

	let gameWon = null;
	
	// Array iterator, "winCombos.entries()"
	for(let [index, win] of winCombos.entries()) {
		if(win.every(elem => plays.indexOf(elem) > -1)) {
			// Player has won
			gameWon = {index, player, player: player};
			break;
		}
	}
	return gameWon;
}

function declareWinner(who) {
	gameWon = true;
	console.log(who);
	document.querySelector(".endgame").style.display = "block";
	document.querySelector(".endgame .text").innerText = who;
}

function gameOver(gameWon) {
	for (let index of winCombos[gameWon.index]) {
		document.getElementById(index).style.backgroundColor = 
			gameWon.player == playerX ? "green" : "red";
	}
	for(var i = 0; i < cells.length; i++){
		cells[i].removeEventListener('click', turnClick, false);
	}
	declareWinner(gameWon.player == playerX ? "WHITE WINS!" : "BLACK WINS!");
	playerTurn = 0;
}



