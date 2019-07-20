<?php 
include_once 'header.php';

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$APIKEY = $_ENV['LOL_API_KEY'];

$summonerName = $_GET["summonerName"];
$rawAccountData = file_get_contents("https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$summonerName."?api_key=".$APIKEY);
$decodedData = json_decode($rawAccountData, true);

$name = $decodedData['name'];
$puuid = $decodedData['puuid'];
$summonerLevel = $decodedData['summonerLevel'];
$revisionDate = $decodedData['revisionDate'];
$id = $decodedData['id'];
$accountId = $decodedData['accountId'];

$seconds = ($revisionDate/1000);	// seconds
echo "<br>";
echo "<p style=color:white;text-align:center><br>", $name, " was last seen online on League of Legends: ", date("d-m-Y", $seconds), ".</p>";
echo "<p style=color:white;text-align:center><br>Level: ", $summonerLevel, ".</p>";

/* MAKE SURE TO HIDE ERROR MESSAGES 
$rawAccountData2 = file_get_contents("https://euw1.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/".$id."?api_key=".$APIKEY);
$decodedData2 = json_decode($rawAccountData2, true);
*/

// <?php die("test");
?>

