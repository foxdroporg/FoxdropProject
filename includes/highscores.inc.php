<?php

// Session start to get the value from Login. Maybe I have done it incorrectly?
session_start();

include_once 'dbh.inc.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$user_score = (int) mysqli_real_escape_string($conn, $_POST['user_score']);
$game = mysqli_real_escape_string($conn, $_POST['game']);

//boolean qualifies = ;

// Insert the user into the database
//if () {
	$sql = "INSERT INTO highscores (username, user_score, game) VALUES ('$username', '$user_score', '$game');";
	mysqli_query($conn, $sql);
//}


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