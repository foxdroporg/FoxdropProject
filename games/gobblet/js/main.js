

var origBoard;
var playerX = 'X';
var playerO = 'O';

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
var numberOfX = 0;
var numberOfO = 0;
var playerTurn = 0;

var gameWon = false;

const cells = document.querySelectorAll('.cell');
startGame();


/* Starts game by pressing left-click, takes away background color from endgame screen */
function startGame() {
	document.querySelector('.endgame').style.display = "none";
	origBoard = Array.from(Array(16).keys());
	gameWon = false;
	for (var i = 0; i < cells.length; i++) {
		cells[i].innerText = '';
		cells[i].style.removeProperty('background-color');
		cells[i].addEventListener('click', turnClick, false);
	}
}

/* Turn is done by left clicking on the mouse. */
function turnClick(square) {
	var size = square.target.clientHeight-5;

	switch(playerTurn%2) {
		case 0:
			// PlayerX
			if ( typeof origBoard[square.target.id] == 'number' && numberOfX!==3) {
				numberOfX++;
				turn(square.target.id, playerX, size);
				if (!gameWon) {	
					playerTurn++;
				} 
			}
			else if (origBoard[square.target.id] == 'X') {	
				numberOfX--;
				origBoard[square.target.id] = parseInt(square.target.id, 10);
				document.getElementById(square.target.id).innerHTML = '';
			}
		break;

		case 1:
			// PlayerO
			if ( typeof origBoard[square.target.id] == 'number' && numberOfO!==3) {
				numberOfO++;
				turn(square.target.id, playerO, size);
				if (!gameWon) {	
					playerTurn++;
				} 
			}
			else if (origBoard[square.target.id] == 'O') {
				numberOfO--;
				origBoard[square.target.id] = parseInt(square.target.id, 10);
				document.getElementById(square.target.id).innerHTML = '';
			}
		break;
	}
	console.log(square, origBoard, "Player: "+playerTurn%2, "X: "+numberOfX, "O: "+numberOfO);
}

function turn(squareId, player, size) {
	origBoard[squareId] = player;
	// ISSUE: square.target.id becomes null when we mix with he innerHTML
	switch(playerTurn%2) {
		case 0:
			document.getElementById(squareId).innerHTML = '<img style="width:'+size+'; height:'+size+'" src="../../images/whiteCircle.png">';
		break;
		case 1:
			document.getElementById(squareId).innerHTML = '<img style="width:'+size+'; height:'+size+'" src="../../images/blackCircle.png">';
		break;
	}
	let gameWon = checkWin(origBoard, player)
	if(gameWon) gameOver(gameWon)
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
	declareWinner(gameWon.player == playerX ? "You win!" : "You lose!");
	numberOfX = 0;
	numberOfO = 0;
	playerTurn = 0;
}



