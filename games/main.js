$(document).ready(function(){

	let gameArea = $("#game-area");
	let maxGameArea = 20;

	let playerLength = 4;
	let playerPos = {
		"tr": 9,
		"td": 9
	};
	let playerDir = {
		"up": 1,
		"right": 2,
		"down": 3,
		"left": 4
	};
	let currentPlayerDir = playerDir["right"];

	let pointPosX = Math.floor(Math.random() * 19) + 0;
	let pointPosY = Math.floor(Math.random() * 19) + 0;
	let pointPos = {
		"posX": pontPosX,
		"posY": pointPosY
	};


	let framCount = 0;

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
		let setPointPos = $(".tr" + pointPos["posX"] + "td" + pointPos["posY"]);

		setPointPos.addClass("draw-point");
	}

	drawPoint();

	function playerEatsPoint() {
		let setPointPos = $(".tr" + pointPos["posX"] + "td" + pointPos["posY"]);
		
		setPointPos.removeClass("draw-point");

		pointPosX = Math.floor(Math.random() * 19) + 0;
		pointPosY = Math.floor(Math.random() * 19) + 0;

		pointPos = {
			"posX": pointPosX,
			"posY": pointPosY
		};

		setPointPos = $(".tr" + pointPos["posX"] + "td" + pointPos["posY"]);

		setPointPos.addClass("draw-point");

		gameScore += 1;

		playerLength += 1;
	}


	document.addEventListener("keydown", function(event) {
		console.log(event);    
		if (event.which == 38) {
			currentPlayerDir = playerDir["up"];
		} else if (event.which == 39) {
			currentPlayerDir = playerDir["right"];
		} else if (event.which == 40) {
			currentPlayerDir = playerDir["down"];
		} else if (event.which == 37) {
			currentPlayerDir = playerDir["left"];
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
		let getPlayerTailPos = $(".framecount" + getPlayerTailPos);
		getPlayerTailPos.removeClass("draw-player framecount" + calcPlayerTailPos);
	}

	function scoreHandler() {
		document.getElementById("game-score").innerHTML = gameScore;
	}

	scoreHandler();

	function deathHandler() {
		document.getElementById("game-status").innerHTML = "You Loose!";
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

		// Death by wall touch
		if (playerPos["tr"] == 20 || playerPos["td"] == 20 || playerPos["tr"] == -1 || playerPos["td"] == -1) {
			deathHandler();
			playerIsDead = true;
		}
		// Death by eating self
		else if ($(".tr" + checkedNextPlayerPosX + "td" + checkedNextPlayerPosY).hasClass("draw-player")) {
			deathHandler();
			playerIsDead = true;
		}
		//Gain point
		else if (playerPos["tr"] == pointPos["posX"] && playerPos["td"] == pointPos["posY"] && playerIsDead == false) {
			playerEatsPoint();
			drawPlayer();
			scoreHandler();
		} 
		//Draw player
		else if (playerIsDead == false) {
			drawPlayer();
		}
	}, 500);

});