<link rel="shortcut icon" type="image/png" href="../../images/firefoxLogo.png">
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

				    <script
					  src="https://code.jquery.com/jquery-3.3.1.slim.js"
					  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
					  crossorigin="anonymous"></script>

					<script src="main.js"></script>
				</head>

				<h1 style="color:#FFFFFF">Difficulty</h1>

				<body bgcolor="#202020">

					<form class="signup-form" action="difficulty/easy.php">
						<button type="submit" name="submit">Easy</button>
					</form>
					<form class="difficulty-form" action="difficulty/medium.php">
						<button type="submit" name="submit">Medium</button>
					</form>
					<form class="difficulty-form" action="difficulty/insane.php">
						<button type="submit" name="submit">Insane</button>
					</form>

					<?php
						session_start();
						include_once '../../includes/dbh.inc.php';

						$sql = "SELECT * FROM scores WHERE game = 'snake' ORDER BY user_score DESC LIMIT 10";
						$result = mysqli_query($conn, $sql);

						$data = array();
						while ($row = mysqli_fetch_row($result)) {
							$data[] = $row;
						}

						echo '<span style="color:#FFF;text-align:center;">LEADERBOARD for Snake: <br></span>';
				//		$distinctUsernameArr = array();
						foreach ($data as &$value) {
					//		if (!in_array($value[0], $distinctUsernameArr)) {
								echo '<span style="color:#FFF;text-align:center;">' . $value[0] . ' - ' . $value[1] . ' points</span>';
								echo "<br>";
					//			$distinctUsernameArr[] = $value[0];
					//		}
						}
					?>


					<div style="color: white; position: absolute; left:5%; bottom:5%"><b>Instructions:</b> Move snake with ARROW KEYS or W-A-S-D KEYS. <br> <b>Warning:</b> Each time you reach +10 points you will respawn at the bottom left of the screen, be aware of your points while playing! <br> Note: Sound effects are included.</div>


				</body>
			</html>
	</div>
</section>
