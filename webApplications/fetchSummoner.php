<?php 
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
$dotenv->load();
$APIKEY = $_ENV['LOL_API_KEY'];

$summonerName = $_GET["summonerName"];
$serverName = $_GET["serverName"];
$rawAccountData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/summoner/v4/summoners/by-name/".$summonerName."?api_key=".$APIKEY); // EDIT THIS TO PERMANENT KEY LATER
$decodedData = json_decode($rawAccountData, true);

$name = $decodedData['name'];
$puuid = $decodedData['puuid'];
$summonerLevel = $decodedData['summonerLevel'];
$revisionDate = $decodedData['revisionDate'];
$id = $decodedData['id'];	// EncryptedSummonerId (is used for bascially everything)
$accountId = $decodedData['accountId'];

$seconds = ($revisionDate/1000);	// seconds

function getSpectatorGame($id, $APIKEY) {
	$rawAccountData2 = @file_get_contents("https://euw1.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/".$id."?api_key=".$APIKEY);
	$decodedData2 = json_decode($rawAccountData2, true);
	return $decodedData2;
}
function getServerStatus($serverName, $APIKEY) {
	$rawServerData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/status/v3/shard-data?api_key=".$APIKEY);
	$decodedData = json_decode($rawServerData, true);
	return $decodedData;
}
function getLeagueData($serverName, $id, $APIKEY) {
	$rawLeagueData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/league/v4/entries/by-summoner/".$id."?api_key=".$APIKEY);
	$decodedData = json_decode($rawLeagueData, true);
	return $decodedData;
}
function getMatchlistData($serverName, $accountId, $APIKEY) {
	// Only extracting one game from match history since default is 100 games. Unnecessary overload!
	$rawMatchlistData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/match/v4/matchlists/by-account/".$accountId."?api_key=".$APIKEY); // Before APIKEY you could write: endIndex=1&beginIndex=0& 
	$decodedData = json_decode($rawMatchlistData, true);
	return $decodedData;
}
function getChampionData() {
	$rawChampionListData = @file_get_contents("https://ddragon.leagueoflegends.com/cdn/9.14.1/data/en_US/champion.json");
	$decodedData = json_decode($rawChampionListData, true);
	return $decodedData;
}
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible"
		content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	crossorigin="anonymous">
		<?php
			include_once 'header.php';
		?>
	    <script
		  src="https://code.jquery.com/jquery-3.3.1.slim.js"
		  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
		  crossorigin="anonymous"></script>

		  <style> 
		  	.dotGreen {
			  height: 10px;
			  width: 10px;
			  background-color: #0dff00;
			  border-radius: 50%;
			  display: inline-block;
			}
			.dotRed {
			  height: 10px;
			  width: 10px;
			  background-color: #ad0600;
			  border-radius: 50%;
			  display: inline-block;
			}
		  </style> 
	</head>

	<body>
		<section class="mobile-wrapper">
			<div class="jumbotron mt-5 text-black">
				<p>
				    <button onClick="goBack()" class="btn btn-info">
				      <span class="glyphicon glyphicon-search"></span> Search
				    </button>
					<script type="text/javascript">
						function goBack() {
						  window.history.back();
						}
					</script> 
				</p>
				<h2 class="font-weight-bold text-capitalize" style=" text-align:center; font-size:30px; "> <?php echo "<p style=color:black;text-align:center>", $name; ?> </h2>
		 		
		 		<div class="row mt-1 ">
		 			<div class="col">
						<div class="w-100 mt-2"></div>
							<?php
								echo "<p style=color:black;text-align:center><br>Last seen online on League of Legends: ", date("d-m-Y", $seconds), ".</p>";
								echo "<p style=color:black;text-align:center><br>Level: ", $summonerLevel, ".</p>";
								//echo $id;
								
								$matchlistObject = getMatchlistData($serverName, $accountId, $APIKEY);
								$totalGames = $matchlistObject['totalGames'];
								$latestGame = $matchlistObject['matches'][0];
								
								$mode = '';
								if($latestGame['queue'] == 420) {
									$mode = '5v5 Ranked Solo game';
								} else if ($latestGame['queue'] == 430) {
									$mode = '5v5 Blind Pick game';
								} else if ($latestGame['queue'] == 440) {
									$mode = '5v5 Ranked Flex game';
								} else if ($latestGame['queue'] == 450) {
									$mode = '5v5 ARAM game';
								} else if ($latestGame['queue'] == 470) {
									$mode = '3v3 Ranked Flex game';
								} else if ($latestGame['queue'] == 400) {
									$mode = '5v5 Draft Pick game';
								} else {
									$mode = 'Unknown Game Mode';
								}

								$nameOfChampion = '';
								$championListObject = getChampionData();
								$listOfChampions = $championListObject['data'];
								foreach($listOfChampions as $row) {
								    if ($row['key'] == $latestGame['champion']) {
								    	$nameOfChampion = $row['name'];
								    	break;
								    }
								}

								echo "<p style=color:black;text-align:center><br>Has played a total of: ".$totalGames." games.(Bugged)<br><br><b>Most recent game played</b><br>Date: ".date("d-m-Y", ($latestGame['timestamp']/1000))."<br>Mode: ".$mode."<br>Champion ID: ".$latestGame['champion'].", ".$nameOfChampion.".</p>";
							?>
						<div class="w-100 mt-2"></div>
							<?php
								$leagueObject = getLeagueData($serverName, $id, $APIKEY);
								$soloQueue5v5 = '';
								$rankedTFT = '';
								$flexQueue3v3 = '';
								$flexQueue5v5 = '';
								if(isset($leagueObject[0])) {
									for($k=0; $k < sizeof($leagueObject); $k++) {
										if($leagueObject[$k]['queueType'] == 'RANKED_SOLO_5x5') {
											$soloQueue5v5 = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><br><b>".$soloQueue5v5['queueType']."</b> <br> ".$soloQueue5v5['tier']." ".$soloQueue5v5['rank']." - ".$soloQueue5v5['leaguePoints']." LP <br> Wins ".$soloQueue5v5['wins']." <br> Losses ".$soloQueue5v5['losses']." <br>Winrate: ", 100*number_format($soloQueue5v5['wins']/($soloQueue5v5['wins']+$soloQueue5v5['losses']), 3),"% </p>";
										} 
										else if($leagueObject[$k]['queueType'] == 'RANKED_TFT') {
											$rankedTFT = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><br><b>".$rankedTFT['queueType']."</b> <br> ".$rankedTFT['tier']." ".$rankedTFT['rank']." - ".$rankedTFT['leaguePoints']." LP <br> Wins ".$rankedTFT['wins']." <br> Losses ".$rankedTFT['losses']." <br>Winrate: ", 100*number_format($rankedTFT['wins']/($rankedTFT['wins']+$rankedTFT['losses']), 3),"% </p>";
										}
										else if($leagueObject[$k]['queueType'] == 'RANKED_FLEX_TT') {
											$flexQueue3v3 = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><br><b>".$flexQueue3v3['queueType']."</b> <br> ".$flexQueue3v3['tier']." ".$flexQueue3v3['rank']." - ".$flexQueue3v3['leaguePoints']." LP <br> Wins ".$flexQueue3v3['wins']." <br> Losses ".$flexQueue3v3['losses']." <br>Winrate: ", 100*number_format($flexQueue3v3['wins']/($flexQueue3v3['wins']+$flexQueue3v3['losses']), 3),"% </p>";
										}
										else if($leagueObject[$k]['queueType'] == 'RANKED_FLEX_SR') {
											$flexQueue5v5 = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><br><b>".$flexQueue5v5['queueType']."</b> <br> ".$flexQueue5v5['tier']." ".$flexQueue5v5['rank']." - ".$flexQueue5v5['leaguePoints']." LP <br> Wins ".$flexQueue5v5['wins']." <br> Losses ".$flexQueue5v5['losses']." <br>Winrate: ", 100*number_format($flexQueue5v5['wins']/($flexQueue5v5['wins']+$flexQueue5v5['losses']), 3),"% </p>";
										}
									}
								}

								// /* MAKE SURE TO HIDE ERROR MESSAGES 
								if(@getSpectatorGame($id, $APIKEY)) {
									// Success
									echo "<p style=color:black;text-align:center><br><br><b>LIVE GAME:</b></p>";
									$spectatorGameObject = getSpectatorGame($id, $APIKEY);
									$gameLengthMin = number_format($spectatorGameObject['gameLength']/60, 3);

									$gameQueueConfigId = $spectatorGameObject['gameQueueConfigId'];
									$mode = '';
									if($gameQueueConfigId == 420) {
										$mode = '5v5 Ranked Solo game';
									} else if ($gameQueueConfigId == 430) {
										$mode = '5v5 Blind Pick game';
									} else if ($gameQueueConfigId == 440) {
										$mode = '5v5 Ranked Flex game';
									} else if ($gameQueueConfigId == 450) {
										$mode = '5v5 ARAM game';
									} else if ($gameQueueConfigId == 470) {
										$mode = '3v3 Ranked Flex game';
									} else if ($gameQueueConfigId == 400) {
										$mode = '5v5 Draft Pick game';
									} else {
										$mode = 'Unknown Game Mode';
									}

									$participants = $spectatorGameObject['participants'];
									$listParticipants = array();
									$i = 0;
									foreach($participants as $summoner) {
										$listParticipants[$i] = $summoner['summonerName'];
										$i++;
									}

									echo "<p style=color:black;text-align:center>Game length: ".$gameLengthMin." min.<br>Game Mode: ".$mode."<br><br><b>Teams:</b><br></p>";
									$k=0;
									foreach($listParticipants as $summoner) {
										echo "<p style=color:black;text-align:center>".$summoner."<br></p>";
										if($k == 4) {
											echo "<br><p style=color:black;text-align:center>VS.</p><br>";
										}
										$k++;
									}
								} else {
									// Faliure
									echo "<p style=color:black;text-align:center><br><br><b>Is not in-game.</b></p>";
								}
							?>
					</div>
				</div>
			</div>
		</section>

		<section class="mobile-wrapper">
			<div class="jumbotron mt-5 text-black">
				<h2 class="font-weight-bold text-capitalize" style=" text-align:center; font-size:30px; "> 
					<?php 
						$statusObject = getServerStatus($serverName, $APIKEY);
						$game = $statusObject['services'][0];
						$store = $statusObject['services'][1];
						$website = $statusObject['services'][2];
						$client = $statusObject['services'][3];
						echo "<p style=color:black;text-align:center>", $statusObject['name'], "</p>"; 
					?> 
				</h2>

				<div class="row mt-1 ">
		 			<div class="col">
						<div class="w-100 mt-2"></div>
							<?php
								// Game status
								if($game['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$game['name']." is " .$game['status']. "</p>";
								} else {
									echo "<p style=color:green;text-align:center><span class=dotRed></span>".$game['name']." is " .$game['status']. "</p>";
								}
								// Store status
								if($store['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$store['name']." is " .$store['status']. "</p>";
								} else {
									echo "<p style=color:green;text-align:center><span class=dotRed></span>".$store['name']." is " .$store['status']. "</p>";
								}
								// Website status
								if($website['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$website['name']." is " .$website['status']. "</p>";
								} else {
									echo "<p style=color:green;text-align:center><span class=dotRed></span>".$website['name']." is " .$website['status']. "</p>";
								}
								// Client status
								if($client['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$client['name']." is " .$client['status']. "</p>";
								} else {
									echo "<p style=color:green;text-align:center><span class=dotRed></span>".$client['name']." is " .$client['status']. "</p>";
								}


								
							?>
						<div class="w-100 mt-2"></div>
					</div>
				</div>
			</div>
		</section>

	</body>
</html>



