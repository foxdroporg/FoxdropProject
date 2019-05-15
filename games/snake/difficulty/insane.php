<link rel="shortcut icon" type="image/png" href="../../../images/firefoxLogo.png">
<?php session_start(); ?>


<section class="main-container">
	<div class="main-wrapper">
		<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<meta http-equiv="X-UA-Compatible"
					content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
				    <title>Snake</title>

				    <style>
				    	body {
				    		display: flex;
				    		align-items: center;
				    		justify-content: center;
				    		background: #202020;
				    	}
				    </style>

						<script>
				    	var U_UID = "<?php if(isset($_SESSION['u_uid'])) echo $_SESSION['u_uid']; else echo "false"; ?>";
				    </script>

				    <script
					  src="https://code.jquery.com/jquery-3.3.1.slim.js"
					  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
					  crossorigin="anonymous"></script>

					<script src="insane.js"></script>
				</head>

				<body bgcolor="#202020">

					<table id="game-area" align="center"></table>

					<p id="game-status" align="center"> <font color="green">Good luck!</font></p>
					<p class="game-score" align="center"> <font color="green">Your score is:</font> <span id="game-score" style="color: lightgreen"></span></p>

					<div style="color:white; text-align: center; padding: 5%; font-size: 25px" id="highscoreTable"></div>

				</body>
			</html>
	</div>
</section>
