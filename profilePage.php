<?php
    include_once 'header.php';
    require 'vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(__DIR__);
	$dotenv->load();
	// Local
	/*
	$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
	$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
	$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
	$dbName = $_ENV['DB_LOCAL_NAME'];
	*/
	// Public
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
					<br>
					Interesting trivia fact: <br>
					<?php
						$API_KEY = $_ENV['RAPID_API_KEY'];
						// NUMBERS API - Random facts about certain numbers
						/*
						$response1 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/2/5/date",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => $API_KEY
						  )
						);
						$response2 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/10/17/date",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => $API_KEY
						  )
						);
						*/
						$response3 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/random/trivia?max=30&min=10",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => $API_KEY
						  )
						);
						/*
						$year = date("Y");
						$response4 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/".$year."/year",
						  array(
						    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
						    "X-RapidAPI-Key" => $API_KEY
						  )
						);*/
						
						//$responseBody1 = $response1->body;
						//$responseBody2 = $response2->body;
						$responseBody3 = $response3->body;
						//$responseBody4 = $response4->body;
						//echo '<span style="color:gold;text-align:center;">' . $responseBody1 . '<br><br></span>';
						//echo '<span style="color:gold;text-align:center;">' . $responseBody2 . '<br><br></span>';
						echo '<span style="color:gold;text-align:center;">' . $responseBody3 . '<br><br></span>';
						//echo '<span style="color:gold;text-align:center;">' . $responseBody4 . '<br><br></span>';

						$API_KEY2 = $_ENV['WORDNIK_API_KEY'];
						$date = date("Y-m-d", time());
						$rawAccountData = @file_get_contents("https://api.wordnik.com/v4/words.json/wordOfTheDay?date=".$date."&api_key=".$API_KEY2); 
						$decodedData = json_decode($rawAccountData, true);
						
						$randomWord = $decodedData['word'];
						$meaning = $decodedData['definitions']['text'];

						$examples = $decodedData['examples'];
						$randInt = mt_rand(0 , sizeof($examples)-1);
						$exampleTitle = $examples[$randInt]['title'];
						$exampleInSentence = $examples[$randInt]['text'];

						$note = $decodedData['note'];
						echo '<br><div>Learn a new word daily:</div>'; 
						echo '<span style="color:white;text-align:center;font-size:20px"><span style="color:gold">' . $randomWord . '</span><br><span style="color:white;text-align:center;font-size:20px">'.$meaning.'<br>"'
						.$exampleTitle.'"<br>'.$exampleInSentence.'<br><br>Origin:<br>'.$note.'</span></span>';
						



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



					<h2 style="color:white;font-size: 35px; padding: 0 0 0.5rem 0">Connect Youtube video to account</h2>
				    <h6 style="color:grey; text-align: center;padding: 0 0 1rem 0">How to get embeded link:<br> 1. Click "Share" - 2. Press "Copy" - 3. Paste in the box below</h6>

					<form id="channel-form" style="width: 250px; margin: 0 auto;
				     display: table;">
				      <div class="input-field col s1" style="margin: 0 auto;"> 
				        <input type="text" id="channel-input" placeholder="Youtube Embeded Link..." style="margin: 0 auto;
				     display: table;width: 12rem">
				        <br>
				        <input type="submit" value="Save Youtube Video" class="btn grey lighten-2" style="margin: 0 auto;
				     display: table;">
				      </div>
				    </form>
				    <!--  GET VIDEO VIA INPUT. --->
				    <div class="row" id="video-container" style="width: 350px;margin: 0 auto;
				     display: table;"></div>
				</div>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  				<script language="javascript" type="text/javascript" src="profilePage.js"></script>

			</div>
		</section>
	</body>
</html>

<?php
	include_once 'footer.php';
?>