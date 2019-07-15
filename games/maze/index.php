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
					<!––<link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
				    <title>Maze</title>

				    <style>
				    	body {
				    		display: flex;
				    		align-items: center;
				    		justify-content: center;
				    		background: #202020;
				    	}
				    </style>
				</head>

			<h1 style="color:#FFFFFF">Difficulty</h1>

					<body>
						<form class="signup-form" action="difficulty/easy.php">
							<button type="submit" name="submit">Easy</button>
						</form>
						<form class="difficulty-form" action="difficulty/medium.php">
							<button type="submit" name="submit">Medium</button>
						</form>
						<form class="difficulty-form" action="difficulty/insane.php">
							<button type="submit" name="submit">Insane</button>
						</form>

						<div style="color: white; position: absolute; left:5%; bottom:5%"><b>Instructions:</b> Move with ARROW KEYS or W-A-S-D KEYS or both. <br> There is a time limit to reach the golden treasure. Reach the golden treasure and your time is reset. <br> <b>Note:</b> Sound effects are included.</div>

							<?php
								echo '<span style="color:#FFF;text-align:center;"><br>LEADERBOARD for Maze: <br><br></span>';
								/* dbh.inc.php has a path to autoload.php that does not work from this directory... This is why we have re-written the code from (dbh.inc.php) file here. */ 
									include '../../vendor/autoload.php';
									$dotenv = Dotenv\Dotenv::create(dirname(dirname(__DIR__)));
									$dotenv->load();
									// Local
									/*
									$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
									$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
									$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
									$dbName = $_ENV['DB_LOCAL_NAME'];
									*/
									// Online 
									$dbServername = $_ENV['DB_SERV_NAME']; 
									$dbUsername = $_ENV['DB_USERNAME'];
									$dbPassword = $_ENV['DB_PASSWORD'];
									$dbName = $_ENV['DB_NAME'];
									
									$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

								$sql = "SELECT * FROM scores WHERE game = 'maze' ORDER BY user_score DESC LIMIT 10";
								$result = mysqli_query($conn, $sql);

								$data = array();
								while ($row = mysqli_fetch_row($result)) {
									$data[] = $row;
								}

								foreach ($data as &$value) {
										echo '<span style="color:#FFF;text-align:center;">' . $value[0] . ' - ' . $value[1] . ' points</span>';
										echo "<br>";
								}
							?>

						



					</body>
					

			</html>
	</div>
</section>
