<?php
	include_once 'header.php';
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
			<!––<link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
		    <title>Summoner Search</title>
		    <script
			  src="https://code.jquery.com/jquery-3.3.1.slim.js"
			  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
			  crossorigin="anonymous"></script>
		</head>

		<body>
			<section class="mobile-wrapper">
				<div class="jumbotron mt-5 text-black">
					<h2 class="font-weight-bold text-capitalize" style=" text-align:center; font-size:30px; padding-top: 3%">Find summoner <br>on League of Legends</h2>
			 		
			 		<div class="row mt-5 ">
			 			<div class="col">
							<form style="text-align:center" action="fetchSummoner.php" method="GET">
								<input type="text" name="summonerName" id="summonerName" placeholder="Search for summoner..." style="width:11em; height: 2em; font-size: 20px">							  
								
								<div class="w-100 mt-2"></div>
									<select name="serverName" id="serverName" style="width:11em; height: 3em; font-size: 20px">
									  <option value="euw1">Europe West</option>
									  <option value="eun1">Europe Nordic</option>
									  <option value="na1">North America</option>
									  <option value="kr">Korea</option>
									</select>
								<div class="w-100 mt-2"></div>

								<button class="btn btn-lg btn-primary" type="submit" onClick="fetchSummoner" style="width:11em; height: 3em">Search..</button>
							</form>
						</div>
					</div>
				</div>
			</section>
		</body>



	<?php
		/*
		require 'vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::create(__DIR__);
		$dotenv->load();
		$APIKEY = $_ENV['LOL_API_KEY'];

		// <pre> tags creates text with a more readable format
		echo '<pre>';

		// Challenger ladder 3v3
		$challengerLadder = file_get_contents("https://euw1.api.riotgames.com/lol/league/v4/challengerleagues/by-queue/RANKED_FLEX_TT?api_key=" .$APIKEY );

		$ladder = json_decode($challengerLadder, true);
		$entries2 = $ladder['entries'];

		function cmp($a, $b) {
		    return $a["leaguePoints"] < $b["leaguePoints"];
		}

		usort($entries2, "cmp");

		// Christofferos
		$res = file_get_contents("https://euw1.api.riotgames.com/lol/league/v4/entries/by-summoner/_OMvt4ZmmQMiC48txuPopoANDrtfg4cqbTQ0d5caMm0KOTY?api_key=" .$APIKEY );

		$entries = json_decode($res, true);
		$c = $entries[0];
		$name = $c['summonerName'];
		$tier = $c['tier'];
		$rank = $c['rank'];
		$q = $c['queueType'];

		$iterator = 1;
		$pos = 0;
		foreach($entries2 as $entry) {
			$namePos = $entry['summonerName'];
			if ($namePos == 'Christofferos') {
				$pos = $iterator;
				break;
			}
			$iterator = $iterator + 1;
		}

		$postPosString;
		if ($pos == 1) {
			$postPosString = 'st';
		} else if ($pos == 2) {
			$postPosString = 'nd';
		} else if ($pos == 3) {
			$postPosString = 'rd';
		} else {
			$postPosString = 'th';
		}

		echo '<br><br> <p style="color:gold;text-align:center;"> This is the European Leaderboard for the game called League of Legends on the map Twisted Treeline: </p>';
		echo '<br> <p style="color:gold;text-align:center;">'.$name.' (one of the website creators) holds the '.$pos. '' .$postPosString. ' place in Europe. </p> <br>';

		foreach($entries2 as $entry) {
			$name2 = $entry['summonerName'];
			$lp = $entry['leaguePoints'];

			if ($name2 == 'Christofferos' || $name2 == 'Marcoseros' || $name2 == 'Jacoseros') {
				echo '<p style="color:gold;text-align:center;">'.$name2. ' - ' .$lp. 'LP</p>';
			}
			else {
				echo '<p style="color:white;text-align:center;">'.$name2. ' - ' .$lp. 'LP</p>';
			}
		}
		echo '<br><br>';
		*/
	?>
</html>
