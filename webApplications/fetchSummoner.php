
<?php 
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
$dotenv->load();
$APIKEY = $_ENV['LOL_API_KEY'];

$summonerName = $_GET["summonerName"];
$summonerName = preg_replace('/\s+/', '%20', $summonerName);
$serverName = $_GET["serverName"];
$rawAccountData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/summoner/v4/summoners/by-name/".$summonerName."?api_key=".$APIKEY); // EDIT THIS TO PERMANENT KEY LATER
$decodedData = json_decode($rawAccountData, true);

$profileIconId = $decodedData['profileIconId'];
$name = $decodedData['name'];
$puuid = $decodedData['puuid'];
$summonerLevel = $decodedData['summonerLevel'];
$revisionDate = $decodedData['revisionDate'];
$id = $decodedData['id'];	// EncryptedSummonerId (is used for bascially everything)
$accountId = $decodedData['accountId']; // EncryptedAccountId

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
	$rawMatchlistData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/match/v4/matchlists/by-account/".$accountId."?endIndex=1&beginIndex=0&api_key=".$APIKEY); // Before APIKEY you could write: endIndex=1&beginIndex=0& 
	$decodedData = json_decode($rawMatchlistData, true);
	return $decodedData;
}
function getChampionData() {
	$rawChampionListData = @file_get_contents("https://ddragon.leagueoflegends.com/cdn/9.14.1/data/en_US/champion.json");
	$decodedData = json_decode($rawChampionListData, true);
	return $decodedData;
}
function getChampionMastery($serverName, $id, $APIKEY) {
	$rawChampionMasteryData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/".$id."?api_key=".$APIKEY);
	$decodedData = json_decode($rawChampionMasteryData, true);
	return $decodedData;
}
function getFullMatchList($serverName, $accountId, $APIKEY) {
	// 100 games is too much, preformance issues again! Restrict to 50 games.
	$rawMatchList = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/match/v4/matchlists/by-account/".$accountId."?endIndex=50&beginIndex=0&queue=420&api_key=".$APIKEY);
	$decodedData = json_decode($rawMatchList, true);
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
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
				    <button onClick="goBack()" class="btn btn-primary">
				      <span class="glyphicon glyphicon-search"></span> Search
				    </button>
					<script type="text/javascript">
						function goBack() {
						  window.history.back();
						}
					</script> 
				</p>
				<h2 class="font-weight-bold text-capitalize" style="text-align:center; font-size:30px;"> 
					<?php 
						$image = "http://ddragon.leagueoflegends.com/cdn/9.14.1/img/profileicon/".$profileIconId.".png";
						echo '<img src="'.$image.'" style="width:6em;height:6em;"/>';
					?>
					<?php 
						echo "<p style=color:black;text-align:center>".$name."</p>"; 
					?> 
				</h2>
		 		<div class="row mt-1 ">
		 			<div class="col">
						<div class="w-100 mt-2"></div>
							<?php
								
								//echo $id;
								
								$matchlistObject = getMatchlistData($serverName, $accountId, $APIKEY);
								$totalGames = $matchlistObject['totalGames'];
								$latestGame = $matchlistObject['matches'][0];
								// Get game duration
								$rawData = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/match/v4/matches/".$latestGame['gameId']."?api_key=".$APIKEY);  
								$decodedData = json_decode($rawData, true);
								$gameDuration = $decodedData;


								
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

								$championListMasteryObject = getChampionMastery($serverName, $id, $APIKEY);
								$firstScore = 0;
								$firstChampionId = 0;
								$secondScore = 0;
								$secondChampionId = 0;
								$thirdScore = 0;
								$thirdChampionId = 0;
								if (isset($championListMasteryObject[0])) {
									$firstScore = $championListMasteryObject[0]['championPoints'];
									$firstChampionId = $championListMasteryObject[0]['championId'];
								}
								if (isset($championListMasteryObject[1])) {
									$secondScore = $championListMasteryObject[1]['championPoints'];
									$secondChampionId = $championListMasteryObject[1]['championId'];
								}
								if (isset($championListMasteryObject[2])) {
									$thirdScore = $championListMasteryObject[2]['championPoints'];
									$thirdChampionId = $championListMasteryObject[2]['championId'];
								}

								// Get win rates
								$fullMatchlistObject = getFullMatchList($serverName, $accountId, $APIKEY);
								$topThreeChampionsPlayedArray = array();
								$amountOfTimesPlayed = array();
								$gameID = array();
								$i = 0;

								foreach($fullMatchlistObject['matches'] as $match) {
									if(!in_array($match['champion'], $topThreeChampionsPlayedArray)) {
										array_push($topThreeChampionsPlayedArray, $match['champion']);
										array_push($amountOfTimesPlayed, 1);
									}
									else {
										$champIndex = array_search($match['champion'], $topThreeChampionsPlayedArray);
										$amountOfTimesPlayed[$champIndex]++;
									}

									// Try to get each WIN or LOSE for each game.
									$gameID[$i][0] = $match['champion'];
									$gameID[$i][1] = $match['gameId'];
									$i++;
								}

								function maxNitems($array, $n = 5){
									asort($array);
									return array_slice(array_reverse($array, true),0,$n, true);
								}

								$mostPlayed = array();
								$mostPlayed = array_keys(maxNitems($amountOfTimesPlayed));

								/* PREFORMANCE ISSUES - takes too long to load the win rates
								function printTheWins($champion, $gameID, $serverName, $APIKEY) {
									// Try to get each WIN or LOSE for each game.
									$totalGames = 0.0;
									$wins = 0.0;
									$losses = 0.0;
									$i = 0;
									foreach($gameID as $gameIDFind) {
										if($gameIDFind[0] === $champion) {
											$rawMatchList = @file_get_contents("https://".$serverName.".api.riotgames.com/lol/match/v4/matches/".$gameIDFind[1]."?api_key=".$APIKEY);
											$decodedData = json_decode($rawMatchList, true);
											foreach($decodedData['participants'] as $player) {
												if($player['championId'] === $gameIDFind[0]) {
													$teamIndex = 1;
													if($player['teamId'] === 100) { // 100 = blue side, 200 = red side
														$teamIndex = 0;
													}
													if($decodedData['teams'][$teamIndex]['win'] === 'Win') {
														$wins++;
														$totalGames++;
														//echo 'LAST GAME ON THIS CHAMP WAS A - WIN<br><br>';
													}
													else if($decodedData['teams'][$teamIndex]['win'] === 'Fail'){
														$losses++;
														$totalGames++;
														//echo 'LAST GAME ON THIS CHAMP WAS A - FAIL<br><br>';
													}
													break; // Break foreach loop if the correct player was found (out of the 10 players)
												}
											}
											//var_dump($decodedData['participants']);
											if($i == 9) break; // 10 games win ratio
											$i++;
										}
									}
									$winratio = round(100*($wins/$totalGames), 0);
									echo ''.$winratio.'%</p>';
								}
								*/
								

								echo "<hr>";
								echo "<p style=color:#007bff;text-align:center>Ranked Solo (Past 50 Games):<br> </p>";
								foreach($mostPlayed as $nr) {
									$games = $amountOfTimesPlayed[$nr];
									foreach($listOfChampions as $row) {
										if ($row['key'] == $topThreeChampionsPlayedArray[$nr]) {
											echo "<p style=color:black;text-align:center;margin-bottom: 0px>" .$row['name']." (".$games. " played)</p>";
											//printTheWins($topThreeChampionsPlayedArray[$nr], $gameID, $serverName, $APIKEY); // Preformance issues
										} 
									}
								}

								$timeStr = date('Gi.s', $latestGame['timestamp']/1000); // Add two hours for online website
								if(strlen($timeStr) === 6) {
									$timeStr = substr_replace($timeStr, ':', 1, 0);
								}
								else {
									$timeStr = substr_replace($timeStr, ':', 2, 0);
								}
								$timeStr = str_replace('.', ':', $timeStr);
								$gameDuration = round(($gameDuration['gameDuration']/60), 0);

								// Get mastery points champs
								$firstChampion = '';
								$secondChampion = '';
								$thirdChampion = '';
								foreach($listOfChampions as $row) {
								    if ($row['key'] == $firstChampionId) {
								    	$firstChampion = $row['name'];
								    } 
								    else if ($row['key'] == $secondChampionId) {
								    	$secondChampion = $row['name'];
								    } 
								    else if ($row['key'] == $thirdChampionId) {
								    	$thirdChampion = $row['name'];
									}
								}
					
								echo "<hr>";

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
											echo "<p style=color:black;text-align:center><b><span style=color:#007bff>".$soloQueue5v5['queueType']."</span></b> <br> ".$soloQueue5v5['tier']." ".$soloQueue5v5['rank']." - ".$soloQueue5v5['leaguePoints']." LP <br> Wins ".$soloQueue5v5['wins']." <br> Losses ".$soloQueue5v5['losses']." <br>Winrate: ", 100*number_format($soloQueue5v5['wins']/($soloQueue5v5['wins']+$soloQueue5v5['losses']), 3),"% </p>";
										} 
										else if($leagueObject[$k]['queueType'] == 'RANKED_TFT') {
											$rankedTFT = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><b><span style=color:#007bff>".$rankedTFT['queueType']."</span></b> <br> ".$rankedTFT['tier']." ".$rankedTFT['rank']." - ".$rankedTFT['leaguePoints']." LP <br> Wins ".$rankedTFT['wins']." <br> Losses ".$rankedTFT['losses']." <br>Winrate: ", 100*number_format($rankedTFT['wins']/($rankedTFT['wins']+$rankedTFT['losses']), 3),"% </p>";
										}
										else if($leagueObject[$k]['queueType'] == 'RANKED_FLEX_TT') {
											$flexQueue3v3 = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><b><span style=color:#007bff>".$flexQueue3v3['queueType']."</span></b> <br> ".$flexQueue3v3['tier']." ".$flexQueue3v3['rank']." - ".$flexQueue3v3['leaguePoints']." LP <br> Wins ".$flexQueue3v3['wins']." <br> Losses ".$flexQueue3v3['losses']." <br>Winrate: ", 100*number_format($flexQueue3v3['wins']/($flexQueue3v3['wins']+$flexQueue3v3['losses']), 3),"% </p>";
										}
										else if($leagueObject[$k]['queueType'] == 'RANKED_FLEX_SR') {
											$flexQueue5v5 = $leagueObject[$k];
											echo "<p style=color:black;text-align:center><b><span style=color:#007bff>".$flexQueue5v5['queueType']."</span></b> <br> ".$flexQueue5v5['tier']." ".$flexQueue5v5['rank']." - ".$flexQueue5v5['leaguePoints']." LP <br> Wins ".$flexQueue5v5['wins']." <br> Losses ".$flexQueue5v5['losses']." <br>Winrate: ", 100*number_format($flexQueue5v5['wins']/($flexQueue5v5['wins']+$flexQueue5v5['losses']), 3),"% </p>";
										}
									}
								}

								echo "<hr>";

								// /* MAKE SURE TO HIDE ERROR MESSAGES 
								if(@getSpectatorGame($id, $APIKEY)) {
									// Success
									echo "<p style=color:black;text-align:center><br><span style='color:green'><b>LIVE GAME:</b></span></p>";
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

									echo "<p style=color:black;text-align:center>Game length: ".$gameLengthMin." min.<br>".$mode."<br><br><span style='color:#007bff'><b>Teams:</b></span><br></p>";
									$k=0;
									foreach($listParticipants as $summoner) {
										$tempSummoner = $summoner;
										$tempSummoner = preg_replace('/\s+/', '%20', $tempSummoner);
										echo "<a href='http://foxdrop.000webhostapp.com/webApplications/fetchSummoner.php?summonerName=".$tempSummoner."&serverName=".$serverName."'><p style=color:black;text-align:center>".$summoner."<br></p></a>";
										if($k == 4) {
											echo "<br><p style=color:black;text-align:center><span style='color:#007bff'>VS.</span></p><br>";
										}
										$k++;
									}
								} else {
									// Faliure
									echo "<p style=color:black;text-align:center><br><br><b>Is not in-game right now.</b></p>";
								}
								echo "<br><hr>";
								
								echo "<p style=color:black;text-align:center><br>Last seen online: ", date("d-m-Y", $seconds), ".</p>";

								// Top one is with totalGames but it is currently bugged (as of: 2019-10-18)
								// echo "<p style=color:black;text-align:center><br>Has played a total of: ".$totalGames." games.(Bugged)<br><br><b>Most recent game played</b><br>Date: ".date("d-m-Y", ($latestGame['timestamp']/1000))."<br>Mode: ".$mode."<br>Champion ID: ".$latestGame['champion'].", ".$nameOfChampion.".</p>";
								echo "<p style=color:black;text-align:center><br><b><span style=color:#007bff>Most recent game played:</span></b><br>".$mode."<br>".$nameOfChampion." - (ID: ".$latestGame['champion'].")<br>Match started: ".date("d-m-Y", ($latestGame['timestamp']/1000)).", ".$timeStr." GMT<br>Game length: ".$gameDuration." min.</p>";
								
								echo "<p style=color:black;text-align:center><b><span style=color:#007bff>Champion Mastery:</b></span><br>".$firstChampion." - ".$firstScore." points<br>".$secondChampion." - ".$secondScore." points<br>".$thirdChampion." - ".$thirdScore." points</p>";
								
								echo "<p style=color:black;text-align:center><br>Account level: ", $summonerLevel, ".</p>";
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
						echo "<p style=color:black;text-align:center>", $statusObject['name'], " - Service Status</p>"; 
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
									echo "<p style=color:red;text-align:center><span class=dotRed></span> ".$game['name']." is not " .$game['status']. "</p>";
								}
								// Store status
								if($store['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$store['name']." is " .$store['status']. "</p>";
								} else {
									echo "<p style=color:red;text-align:center><span class=dotRed></span> ".$store['name']." is not " .$store['status']. "</p>";
								}
								// Website status
								if($website['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$website['name']." is " .$website['status']. "</p>";
								} else {
									echo "<p style=color:red;text-align:center><span class=dotRed></span> ".$website['name']." is not " .$website['status']. "</p>";
								}
								// Client status
								if($client['status'] == 'online') {
									echo "<p style=color:green;text-align:center><span class=dotGreen></span> ".$client['name']." is " .$client['status']. "</p>";
								} else {
									echo "<p style=color:red;text-align:center><span class=dotRed></span> ".$client['name']." is not " .$client['status']. "</p>";
								}


								
							?>
						<div class="w-100 mt-2"></div>
					</div>
				</div>
			</div>
		</section>

	</body>
</html>



