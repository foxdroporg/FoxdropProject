<?php
    include_once 'header.php';
    require 'vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::create(__DIR__);
		$dotenv->load();

		// Local

		$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
		$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
		$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
		$dbName = $_ENV['DB_LOCAL_NAME'];

		// Public
		/*
		$dbServername = $_ENV['DB_SERV_NAME']; 
		$dbUsername = $_ENV['DB_USERNAME'];
		$dbPassword = $_ENV['DB_PASSWORD'];
		$dbName = $_ENV['DB_NAME'];
		*/

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
					<br>
					Random facts of the day: <br>
					<?php
						// NUMBERS API - Random facts about certain numbers
						$response1 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/2/5/date",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => "b9334583cemsh670233cf6f39e65p11ad14jsn75c6538b3a72"
						  )
						);
						$response2 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/10/17/date",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => "b9334583cemsh670233cf6f39e65p11ad14jsn75c6538b3a72"
						  )
						);
						$response3 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/random/trivia?max=30&min=10",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => "b9334583cemsh670233cf6f39e65p11ad14jsn75c6538b3a72"
						  )
						);
						$year = date("Y");
						$response4 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/".$year."/year",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => "b9334583cemsh670233cf6f39e65p11ad14jsn75c6538b3a72"
						  )
						);
						$responseBody1 = $response1->body;
						$responseBody2 = $response2->body;
						$responseBody3 = $response3->body;
						$responseBody4 = $response4->body;
						echo '<span style="color:gold;text-align:center;">' . $responseBody1 . '<br><br></span>';
						echo '<span style="color:gold;text-align:center;">' . $responseBody2 . '<br><br></span>';
						echo '<span style="color:gold;text-align:center;">' . $responseBody3 . '<br><br></span>';
						echo '<span style="color:gold;text-align:center;">' . $responseBody4 . '<br><br></span>';
						

						$response5 = Unirest\Request::post("https://NasaAPIdimasV1.p.rapidapi.com/getEPICEarthImagery",
						  array(
						    "X-RapidAPI-Host" => "NasaAPIdimasV1.p.rapidapi.com",
						    "X-RapidAPI-Key" => "b9334583cemsh670233cf6f39e65p11ad14jsn75c6538b3a72",
						    "Content-Type" => "application/x-www-form-urlencoded"
						  )
						);
						$responseBody5 = $response5->body;
						var_dump($responseBody5);
						//echo '<span style="color:gold;text-align:center;">' . $responseBody5{{["to"]}} . '<br><br></span>';
						
					?>
					
					<p style="text-align: center">
						<span style="color:white; text-align:center; font-size: 30px"></span><br><br><br>

						<span id="numbers0" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
					</p>
				

					<script type="text/javascript">
					/*
						async function getGithubCommits() {
							const response = await fetch('http://numbersapi.com/42');
							const data = await response.json();

							data[0] !== undefined ? document.getElementById('numbers0').textContent = data[0].commit.message : document.getElementById('numbers0').textContent = "";
						}


						getGithubCommits()
							.then(response => {
								console.log('Fetch successful!');
							})
							.catch(error => {
								console.error(error);
							});
					*/
					</script>
				</div>
			</div>
		</section>
	</body>
</html>

<?php
	include_once 'footer.php';
?>