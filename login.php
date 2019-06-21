<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
			<h2 style="color:#FFFFFF">Welcome to Foxdrop</h2>
			<?php
				if (isset($_SESSION['u_id'])) {
					echo '<br><div style="text-align:center"><span style="color:green; font-size:25px">You are logged in!</span></div>';
				}

			?>
	</div>


	<script type="text/javascript">
		function fetchSummoner() {
			function reqListener () {
			    console.log(JSON.parse(this.responseText));
			}

			var summonerName = document.getElementById("summoner").value;

			var oReq = new XMLHttpRequest();
			oReq.addEventListener("load", reqListener());
			oReq.open("GET", 'fetch_summoner.php?summoner=${summonerName}');
			oReq.send();
		}
	</script>


	<form style="text-align:center" action="" method="POST">
		<input type="text" id="summoner" placeholder="Search for summoner..">
		<button type="submit" onClick="fetchSummoner" >Search..</button>
	</form>



	<?php
		require 'vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::create(__DIR__);
		$dotenv->load();
		$APIKEY = $_ENV['LOL_API_KEY'];
		
		/* <pre> tags creates text with a more readable format*/
		//echo '<pre>';
		
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

	?>
</section>



<?php
	include_once 'footer.php';
?>
