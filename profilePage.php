<?php
    include_once 'header.php';

    /* dbh.inc.php has a path to autoload.php that does not work from this directory... This is why we have re-written the code from (dbh.inc.php) file here. */ 
		include 'vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::create(__DIR__);
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
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<section class="main-container">
			<div class="main-wrapper">
				<h2 style="color:#FFFFFF; font-size: 50px">Profile</h2>
				<div class="paragraph" style="padding-top: 3%">
					First name: 
					<?php
						$userID = $_SESSION['u_id'];

						$sqlQuery = "SELECT * FROM users WHERE user_id='$userID'";
						$result = mysqli_query($conn, $sqlQuery);
						$data = array();
						while ($row = mysqli_fetch_row($result)) {
							$data[] = $row;
						}
						foreach ($data as &$value) {
							echo '<span style="color:gold;text-align:center;">' . $value[1] . ' </span>';
						}
					?>
					<br>
					Last name:	
					<?php
						foreach ($data as &$value) {
							echo '<span style="color:gold;text-align:center;">' . $value[2] . ' </span>';
						}
					?>
					<br>
					E-mail:	
					<?php
						foreach ($data as &$value) {
							echo '<span style="color:gold;text-align:center;">' . $value[3] . ' </span>';
						}
					?>
					<br>
					Username:
					<?php
						foreach ($data as &$value) {
							echo '<span style="color:gold;text-align:center;">' . $value[4] . ' </span>';
						}
						$username = $value[4];
					?>	
					<br>
					<br>
					You were the 
					<?php
						foreach ($data as &$value) {
							echo '<span style="color:gold;text-align:center;">' . $value[0] . 'th </span>';
						}
					?>
					user to sign up on Foxdrop
					<br>
					<br>
					Your best scores on our ranked games are: 
					<br>
					<?php
						$sqlQuery = "SELECT game FROM scores";
						$result = mysqli_query($conn, $sqlQuery);
						$data = array();
						while ($row = mysqli_fetch_row($result)) {
							$data[] = $row;
						}
						$nrOfUniqueGames = 0;
						$namesOfUniqueGames = array();
						foreach ($data as &$value) {
							if(!in_array($value[0], $namesOfUniqueGames)) {
								$nrOfUniqueGames++;
								$namesOfUniqueGames[] = $value[0];
							}
						}

						foreach ($namesOfUniqueGames as &$game) {
							$sqlQuery = "SELECT * FROM scores WHERE username = '$username' AND game = '$game' ORDER BY user_score DESC LIMIT 1";
							$result = mysqli_query($conn, $sqlQuery);
							$data = array();
							while ($row = mysqli_fetch_row($result)) {
								$data[] = $row;
							}
							foreach ($data as &$value) {
								echo '<span style="color:gold;text-align:center;">' . $value[1] . ' points in ' .$value[2]. ' <br></span>';
							}
						}
					?> 
					<br>
					<?php

					?> 
					
				</div>
			</div>
		</section>
	</body>
</html>

<?php
	include_once 'footer.php';
?>