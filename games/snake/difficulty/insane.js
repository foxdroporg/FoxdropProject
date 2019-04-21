$(document).ready(function(){

	class Rectangle {
		constructor(x1, x2, y1, y2) {
			this.x1 = x1;
			this.x2 = x2;
			this.y1 = y1;
			this.y2 = y2;
		}
		collisionDetection(checkx, checky) {
			if(checkx >= this.x1 && checkx <= this.x2 && checky >= this.y1 && checky <= this.y2)
				return true;
			else
				return false;
		}
	}

	let gameArea = $("#game-area");
	let maxGameArea = 20;
	var hasPressed = false;
	
	var easyDifficulty = 10;
	var mediumDifficulty = 20;
	var hardDifficulty = 30;
	var maxedDifficulty = 40;

	var rectangleList = [];

	let playerLength = 4;
	let playerPos = {
		"tr": 18,
		"td": 0
	};
	let playerDir = {
		"up": 1,
		"right": 2,
		"down": 3,
		"left": 4
	};
	let currentPlayerDir = playerDir["right"];

	// First point 
	let pointPosX = Math.floor(Math.random() * 19) + 0;
	let pointPosY = Math.floor(Math.random() * 19) + 0;
	let pointPos = {
		"posX": pointPosX,
		"posY": pointPosY
	};

	let frameCount = 0;

	let gameScore = 0;
	
	let playerIsDead = false;

	function drawGameArea() {
		for (let index = 0; index < maxGameArea; index++) {
			gameArea.append("<tr class='tr" + index + "'></tr>");
			
			let thisTr = $(".tr" + index);

			for(let indexTd = 0; indexTd < maxGameArea; indexTd++) {
				thisTr.append("<td class='tr" + index + "td" + indexTd + "'></td>");
			}
		}
	}

	drawGameArea();


	function drawPoint() {
		let setPointPos = $(".tr" + pointPos["posY"] + "td" + pointPos["posX"]);

		setPointPos.addClass("draw-point");
	}

	drawPoint();

	function playerEatsPoint() {
		let setPointPos = $(".tr" + pointPos["posY"] + "td" + pointPos["posX"]);
		
		//Remove point that was eaten.
		setPointPos.removeClass("draw-point");

		gameScore += 1;

		// Add walls for each difficulty level.
		if (gameScore == easyDifficulty) {	//10
			playerPos = {
				"tr": 18,
				"td": 0
			};
			currentPlayerDir = playerDir["right"];
			document.getElementById("game-status").innerHTML = "";
			document.getElementById("game-status").innerHTML = "<span class='color-class2'>" + "Easy...";

			rectangleList.push(new Rectangle(5, 9, 5, 6), new Rectangle(15, 16, 10, 14));			

			for(let i = 0; i < rectangleList.length; i++) {
				for(let j = rectangleList[i].x1; j <= rectangleList[i].x2; j++) {
					for(let k = rectangleList[i].y1; k <= rectangleList[i].y2; k++) {
						document.getElementById("game-area").rows[k].cells[j].style.backgroundColor = "#ff6600";		
					}		
				}
			}
		}

		if (gameScore == mediumDifficulty) {	//25
			playerPos = {
				"tr": 18,
				"td": 0
			};
			currentPlayerDir = playerDir["right"];
			document.getElementById("game-status").innerHTML = "";
			document.getElementById("game-status").innerHTML = "<span class='color-class3'>" + "Not bad. <br>Difficulty: Medium";

			rectangleList.push(new Rectangle(2, 8, 11, 11), new Rectangle(4, 11, 16, 16), new Rectangle(14, 16, 3, 5));

			for(let i = 0; i < rectangleList.length; i++) {
				for(let j = rectangleList[i].x1; j <= rectangleList[i].x2; j++) {
					for(let k = rectangleList[i].y1; k <= rectangleList[i].y2; k++) {
						document.getElementById("game-area").rows[k].cells[j].style.backgroundColor = "#ff6600";		
					}		
				}
			}
		}

		if (gameScore == hardDifficulty) {	//50
			playerPos = {
				"tr": 18,
				"td": 0
			};
			currentPlayerDir = playerDir["right"];
			document.getElementById("game-status").innerHTML = "";
			document.getElementById("game-status").innerHTML = "<span class='color-class4'>" + "Impressive! <br>Difficulty: Hard";
		
			rectangleList.push(new Rectangle(5, 5, 0, 0), new Rectangle(5, 5, 3, 5), new Rectangle(0, 0, 6, 6), new Rectangle(3, 4, 6, 6));

			for(let i = 0; i < rectangleList.length; i++) {
				for(let j = rectangleList[i].x1; j <= rectangleList[i].x2; j++) {
					for(let k = rectangleList[i].y1; k <= rectangleList[i].y2; k++) {
						document.getElementById("game-area").rows[k].cells[j].style.backgroundColor = "#ff6600";		
					}		
				}
			}
		}
		
		if (gameScore == maxedDifficulty) { //75
			playerPos = {
				"tr": 18,
				"td": 0
			};
			currentPlayerDir = playerDir["right"];
			document.getElementById("game-status").innerHTML = "";
			document.getElementById("game-status").innerHTML = "<span class='color-class5'>" + "Legendary!! <br>Difficulty: Maxed Out";

			rectangleList.push(new Rectangle(6, 6, 9, 10), new Rectangle(3, 3, 12, 13), new Rectangle(16, 16, 17, 17), new Rectangle(12, 12, 8, 8), new Rectangle(18, 18, 1, 1), new Rectangle(17, 17, 13, 13));

			for(let i = 0; i < rectangleList.length; i++) {
				for(let j = rectangleList[i].x1; j <= rectangleList[i].x2; j++) {
					for(let k = rectangleList[i].y1; k <= rectangleList[i].y2; k++) {
						document.getElementById("game-area").rows[k].cells[j].style.backgroundColor = "#ff6600";		
					}		
				}
			}
		}

		// Add a point on a free spot!
		let newSpawn = false;
		do {
			newSpawn = false;
			pointPosX = Math.floor(Math.random() * 19) + 0;
			pointPosY = Math.floor(Math.random() * 17) + 0;
			for(let i = 0; i < rectangleList.length; i++) {
				if(rectangleList[i].collisionDetection(pointPosX, pointPosY)) {
					newSpawn = true;
				}
			}
		}
		while (newSpawn)
		
		pointPos = {
			"posX": pointPosX,
			"posY": pointPosY
		};

		setPointPos = $(".tr" + pointPos["posY"] + "td" + pointPos["posX"]);

		setPointPos.addClass("draw-point");

		playerLength += 1;


	}

	
	document.addEventListener("keydown", function(event) {
		//console.log(event); 
		if (event.which == 38 && currentPlayerDir != playerDir["down"] && !hasPressed) {
			currentPlayerDir = playerDir["up"];
			hasPressed = true;
		} else if (event.which == 39 && currentPlayerDir != playerDir["left"] && !hasPressed) {
			currentPlayerDir = playerDir["right"];
			hasPressed = true;
		} else if (event.which == 40 && currentPlayerDir != playerDir["up"] && !hasPressed) {
			currentPlayerDir = playerDir["down"];
			hasPressed = true;
		} else if (event.which == 37 && currentPlayerDir != playerDir["right"] && !hasPressed) {
			currentPlayerDir = playerDir["left"];
			hasPressed = true;
		}
	});
	

	function drawPlayer() {
		frameCount += 1;
		let getPlayerPos;

		switch (currentPlayerDir) {
			case 1:
				playerPos["tr"] -= 1;
				getPlayerPos = $(".tr" + playerPos["tr"] + "td" + playerPos["td"]);
				getPlayerPos.addClass("draw-player framecount" + frameCount);
				break;
			case 2: 
				playerPos["td"] += 1;
				getPlayerPos = $(".tr" + playerPos["tr"] + "td" + playerPos["td"]);
				getPlayerPos.addClass("draw-player framecount" + frameCount);
				break;
			case 3:
				playerPos["tr"] += 1;
				getPlayerPos = $(".tr" + playerPos["tr"] + "td" + playerPos["td"]);
				getPlayerPos.addClass("draw-player framecount" + frameCount);
				break;
			case 4:
				playerPos["td"] -= 1;
				getPlayerPos = $(".tr" + playerPos["tr"] + "td" + playerPos["td"]);
				getPlayerPos.addClass("draw-player framecount" + frameCount);
				break;
			default:
				alert("Error drawing player!");
				break;
		}
		let calcPlayerTailPos = frameCount - playerLength;
		let getPlayerTailPos = $(".framecount" + calcPlayerTailPos);
		getPlayerTailPos.removeClass("draw-player framecount" + calcPlayerTailPos);
	}

	function scoreHandler() {
		document.getElementById("game-score").innerHTML = gameScore;
	}

	scoreHandler();

	var hasBeenPrinted = false;

	function deathHandler() {
		var i = 0; 
		var txt = "GAME OVER! Refresh page to play again.";
		if (hasBeenPrinted == false) {
			document.getElementById("game-status").innerHTML = "";
			setInterval(typeWriter, 100);
			typeWriter();
		}

		function typeWriter() {
			if (i < txt.length) {
				document.getElementById("game-status").innerHTML += "<span class='color-class'>" + txt.charAt(i);
				if (i == 9) {
					document.getElementById("game-status").innerHTML += "<br>";
				}
				i++;
			}
		}
		hasBeenPrinted = true;
	}

	setInterval(function(){
		let checkNextPlayerPosX = playerPos["tr"];
		let checkNextPlayerPosY = playerPos["td"];

		switch (currentPlayerDir) {
			case 1:
				checkNextPlayerPosX -= 1;
				break;
			case 2: 
				checkNextPlayerPosY += 1;
				break;
			case 3:
				checkNextPlayerPosX += 1;
				break;
			case 4:
				checkNextPlayerPosY -= 1;
				break;
			default:
				alert("Error checking player collision!");
				break;
		}

		//Check worm collision against spawned obstacles
		for(let i = 0; i < rectangleList.length; i++) {
			if(rectangleList[i].collisionDetection(playerPos["td"], playerPos["tr"])) {
				deathHandler();
				playerIsDead = true;
			}
		}

		// Death by wall touch
		if (playerPos["tr"] == 20 || playerPos["td"] == 20 || playerPos["tr"] == -1 || playerPos["td"] == -1) {
			deathHandler();
			playerIsDead = true;
		}
		// Death by eating self
		else if ($(".tr" + checkNextPlayerPosX + "td" + checkNextPlayerPosY).hasClass("draw-player")) {
			deathHandler();
			playerIsDead = true;
		}
		//Gain point
		else if (playerPos["tr"] == pointPos["posY"] && playerPos["td"] == pointPos["posX"] && playerIsDead == false) {
			playerEatsPoint();
			// Let the player do input again.
			hasPressed = false;
			drawPlayer();
			scoreHandler();
		} 
		//Draw player
		else if (playerIsDead == false) {
			// Let the player do input again.
			hasPressed = false;
			drawPlayer();
		}
	}, 60);

});
