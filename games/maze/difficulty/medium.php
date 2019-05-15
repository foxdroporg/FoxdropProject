<link rel="shortcut icon" type="image/png" href="../../../images/firefoxLogo.png">
<?php session_start(); ?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible"
			content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <title>Maze</title>

		    <style>
		    	body {
		    		align-content: center;
		    		background: #202020;
		    		display: flex;
		    		margin: 0;
		    	}
		    	canvas {
		    		border: solid 1px #fff;
		    		border-left: none;
		    		border-right: none;
		    		image-rendering: pixelated;
		    		height: 100%;
		    		margin: 0 auto;
		    	}
		    </style>
		    <script>
		    	var U_UID = "<?php if(isset($_SESSION['u_uid'])) echo $_SESSION['u_uid']; else echo "false"; ?>";
		    </script>
		    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/p5.min.js"></script>
		    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.dom.min.js"></script>
		    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.sound.min.js"></script>

		    <script type="text/javascript" src="medium.js"></script>
		    <script type="text/javascript" src="cell.js"></script>

		</head>

		<body>
		    <p style="color:white; text-align:center; position: absolute; right: 50%; bottom: -5%; font-size: 125px" id="timer"> <font size="+150">Hurry up!</font></p>
		    <br>
		    <p style="color:white; text-align:center; position: absolute; right: 30%; bottom: -5%; font-size: 125px" id="points"> </p>

		    <div style="color:white; text-align: center; padding: 5%; font-size: 25px" id="highscoreTable"></div>
		</body>

	</html>
