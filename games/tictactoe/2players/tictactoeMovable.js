/* GLOBAL VARIABLES: 
origBoard, the playfield
playerX, user always plays as X
playerO, AI-opponent always plays as O
winCombos, keeps track of the winner.
*/
var origBoard;
const playerX = 'X';
const playerO = 'O';

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

var gameWon = false;

const cells = document.querySelectorAll('.cell');
startGame();

/* Starts game by pressing left-click, takes away background color from endgame screen */
function startGame() {
	document.querySelector('.endgame').style.display = "none";
	origBoard = Array.from(Array(9).keys());
	gameWon = false;
	for (var i = 0; i < cells.length; i++) {
		cells[i].innerText = '';
		cells[i].style.removeProperty('background-color');
		cells[i].addEventListener('click', turnClick, false);
	}
}

/* Turn is done by left clicking on the mouse. */
function turnClick(square) {
	console.log(origBoard);
	console.log(square);

	switch(playerTurn%2) {
		case 0:
			// PlayerX
			if ( typeof origBoard[square.target.id] == 'number' && numberOfX!==3) {
				numberOfX++;
				turn(square.target.id, playerX);
				if (!gameWon) {	
					playerTurn++;
				} 
			}
			else if (origBoard[square.target.id] == 'X') {
				numberOfX--;
				origBoard[square.target.id] = parseInt(square.target.id, 10);
				document.getElementById(square.target.id).innerText = '';
			}
		break;

		case 1:
			// PlayerO
			if ( typeof origBoard[square.target.id] == 'number' && numberOfO!==3) {
				numberOfO++;
				turn(square.target.id, playerO);
				if (!gameWon) {	
					playerTurn++;
				} 
			}
			else if (origBoard[square.target.id] == 'O') {
				numberOfO--;
				origBoard[square.target.id] = parseInt(square.target.id, 10);
				document.getElementById(square.target.id).innerText = '';
			}
		break;
	}
	console.log(numberOfX);
	console.log(numberOfO);
}


function turn(squareId, player) {
	origBoard[squareId] = player;
	document.getElementById(squareId).innerText = player;
	var color = playerTurn%2==0 ? "red" : "orange";
	document.getElementById(squareId).style.color = color;
	
	let gameWon = checkWin(origBoard, player);
	if(gameWon) {
		gameOver(gameWon);
	}
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



