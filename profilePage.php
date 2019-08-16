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

	if (isset($_SESSION["u_id"])) {	// Username = $_SESSION["u_uid"], User ID = $_SESSION["u_id"]
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

					<?php
						$userID = $_SESSION['u_id'];
						$sql = "SELECT * FROM users WHERE user_id='$userID'";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$user_id = $row['user_id'];
								$sqlImg = "SELECT * FROM profileimg WHERE userid='$user_id'";
								$resultImg = mysqli_query($conn, $sqlImg);
								if(mysqli_num_rows($resultImg) == 0) {
									$sqlAdd = "INSERT INTO profileimg (userid, status) VALUES ('$user_id', 1)";
									$resultAdd = mysqli_query($conn, $sqlAdd);
								}
								while ($rowImg = mysqli_fetch_assoc($resultImg)) {
									echo "<div style='text-align:center'>";
										if($rowImg['status'] == 0) {
											$filename = "uploads/profile".$userID.".*";
											$fileinfo = glob($filename);
											$fileext = explode(".", $fileinfo[0]);
											$fileactualext = $fileext[1];
											echo "<img style='width:220px; height:220px' src='uploads/profile".$user_id.".".$fileactualext."?".mt_rand()."''>";
										}
										else {
											echo "<img style='width:220px; height:220px' src='uploads/profiledefault.jpg'>";
										}
									echo "</div>";
								}	
							}
						}
						else {
							echo "There are no users signed up yet on this website!";
						}

					?>

					<form action="upload.php" method="POST" enctype="multipart/form-data" style="text-align: center;">
						<input type="file" name="file">
						<button type="submit" name="submit">UPLOAD</button>
					</form>

					<form action="deleteProfileImg.php" method="POST" style="text-align: center;">
						<button type="submit" name="submit">DELETE</button>
					</form>

					<br><br>
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
					<hr>
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
								if ($value[2] === 'typetosurviveWPM') {
									echo '<span style="color:gold;text-align:center;">' . $value[1] . ' words per minute in ' .$value[2]. ' <br></span>';
								} 
								else {
									echo '<span style="color:gold;text-align:center;">' . $value[1] . ' points in ' .$value[2]. ' <br></span>';
								}
							}
						}
					?> 
					<br>
					<hr>
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
						/*
						echo '<br><div>Unusual words in English:</div>'; 
						
						echo '<span style="color:white;text-align:center;font-size:20px"><span style="color:gold">' . $randomWord . '</span><br><span style="color:white;text-align:center;font-size:20px">'.$note.'<br>'
						.$meaning.'<br>'.$exampleInSentence.'<br><div style="margin:0% 5% 0% 5%">- '.$exampleTitle.'<br></span></span>';
						*/

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




					<?php
					/* IF USER HAS NEVER added a video then a default video will be displayed*/
						$userID = $_SESSION['u_id'];
						$sql = "SELECT * FROM users WHERE user_id='$userID'";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$user_id = $row['user_id'];
								$sqlVid = "SELECT * FROM profilevideo WHERE userid='$user_id'";
								$resultVid = mysqli_query($conn, $sqlVid);
								if(mysqli_num_rows($resultVid) == 0) {
									// Hard Coded Link To a Video for new users.
									$sqlAdd = "INSERT INTO profilevideo (userid, embededlink) VALUES ('$user_id', 'YxqkheLDdM4')"; // Removed this part: https://youtu.be/
									$resultAdd = mysqli_query($conn, $sqlAdd);
								}
								if(mysqli_num_rows($resultVid) > 1) {
									$idRemove = 0;
									while ($rowVid = mysqli_fetch_assoc($resultVid)) {
										if($rowVid['id'] > $idRemove) {
											$idRemove = $rowVid['id'];
										}
									}
									$sqlDel = "DELETE FROM profilevideo WHERE id!='$idRemove' AND userid='$user_id'"; 
									$resultDel = mysqli_query($conn, $sqlDel);
									
									// We need to re-select from table because we now removed a row.
									$sqlVid = "SELECT * FROM profilevideo WHERE userid='$user_id'";
									$resultVid = mysqli_query($conn, $sqlVid);
								}
								while ($rowVid = mysqli_fetch_assoc($resultVid)) {
									$embededLink = $rowVid['embededlink'];
								?>

					<script>
						var U_ID = "<?php if(isset($_SESSION['u_id'])) echo $_SESSION['u_id']; else echo "false"; ?>";		
					</script>

					<h2 style="color:white;font-size: 35px; padding: 0 0 0.5rem 0">Connect a youtube video to profile</h2>

				    <!--  GET VIDEO VIA INPUT. --->
				    <div class="video" id="video-container" style="width: 350px;margin: 0 auto; display: table;">
				    	<br>
				    	<div class="video">
				        <?php 
				        	echo '<iframe width="100%" height="100%"   src="https://www.youtube.com/embed/'.$embededLink.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				        ?>
				        </div>
				    </div>

				    <h6 style="color:grey; text-align: center;padding: 0 0 1rem 0">How to get embeded link:<br> 1. Click "Share" - 2. Press "Copy" - 3. Paste in the box below</h6>

					<form id="channel-form" style="width: 220px; margin: 0 auto; display: table;">
				    	<div class="input-field col s1" style="margin: 0 auto;"> 
				        <input type="text" id="channel-input" placeholder="Youtube Embeded Link..." style="margin: 0 auto; display: table; font-size: 18px">
				        <br>
				        <input type="submit" value="Save Youtube Video" class="btn grey lighten-2" style="margin: 0 auto; display: table; font-size: 18px; width: 196px; background-color: lightblue; cursor: pointer; ">
				      </div>
				    </form>

				</div>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  				<script language="javascript" type="text/javascript" src="profilePage.js"></script>

	  				<?php
	  							}	
							}
						}
						else {
							echo "There are no users signed up yet on this website!";
						}
	  				?>

			</div>
		</section>
	</body>
</html>



<?php
	}
	include_once 'footer.php';
?>