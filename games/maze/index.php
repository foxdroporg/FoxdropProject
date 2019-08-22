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
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
				    <title>Maze</title>

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
				</head>

					<body bgcolor="#202020">
						<header class="bg-dark text-center text-white p-3 mb-5">
							<h1>Maze</h1>
						</header>

						<h1 style="color:#FFFFFF; text-align:center">Difficulty</h1>
						<br>
						<!-- Buttons -->
	                    <div style="text-align:center; width: 10em; margin:0px auto;">
	                        <form class="difficulty-form" action="difficulty/easy.php">
	                            <button type="submit" class="btn-success btn-lg btn-block" name="difficulty" value="easy">Easy</button>
	                        </form>
	                        <form class="difficulty-form" action="difficulty/medium.php">
	                            <button type="submit" class="btn-warning btn-lg btn-block" name="difficulty" value="medium" style="color:white">Medium</button>
	                        </form>
	                        <form class="difficulty-form" action="difficulty/insane.php">
	                            <button type="submit" class="btn-danger btn-lg btn-block" name="difficulty" value="insane">Insane</button>
	                        </form>
	                    </div>

	                    <!-- Instructions -->
	                     <div class="row mt-5">
	                        <div class="col-md-12">
	                            <div class="card card-body bg-dark text-white">
	                            <h5 style="text-align:center"><b>Instructions</b></h5>
	                            <p style="text-align:center">Move with ARROW KEYS, W-A-S-D KEYS or both simultaneously. There is a time limit to reach the golden treasure. Reach the golden treasure and your time is reset.
								</p>
								<p style="text-align:center"> 
									<b>Note:</b> Sound effects are included.
								</p>
	                            </div>
	                        </div>
	                    </div>

	                    <!-- Highscores -->
	                    <div class="row mt-1">
	                        <div class="col-md-12">
	                            <div class="card card-body bg-dark text-white">
	                            <h5 style="text-align:center"><b>Highscores</b></h5>
		                            <p style="text-align:center"> 
										<?php
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

											$sql = "SELECT * FROM scores WHERE game = 'maze' ORDER BY user_score DESC"; 
											$result = mysqli_query($conn, $sql);
											$data = array();
											$uniqueUsername = array();
											
											while ($row = mysqli_fetch_row($result)) {
												if(!in_array($row[0], $uniqueUsername)) {
													$uniqueUsername[] = $row[0];
													$data[] = $row;
												}
											}
											foreach ($data as &$value) {
													echo '<span style="color:#FFF;text-align:center;">' . $value[0] . ' - ' . $value[1] . ' points</span>';
													echo "<br>";
											}
										?>
									</p>
	                            </div>
	                        </div>
	                    </div>
					</body>
			</html>
	</div>
</section>
