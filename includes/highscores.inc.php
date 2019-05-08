<?php

// Session start to get the value from Login. Maybe I have done it incorrectly?
session_start();

include_once 'dbh.inc.php';

$user_id = mysqli_real_escape_int($conn, $_POST['id']);
$user_score = mysqli_real_escape_int($conn, $_POST['score']);
$game = mysqli_real_escape_string($conn, $_POST['game']);


// Insert the user into the database
$sql = "INSERT INTO highscores (user_id, user_score, game) VALUES ('$user_id', '$user_score', '$game');";
mysqli_query($conn, $sql);







// UTKAST: Write out the highscores table
	/*	
	$sql = "SELECT * FROM highscores;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo $row['user_uid'] . "<br>";		// Column access
		}
	}
	*/