<?php

// Session start to get the value from Login. Maybe I have done it incorrectly?
session_start();

include_once 'dbh.inc.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$user_score = (int) mysqli_real_escape_string($conn, $_POST['user_score']);
$game = mysqli_real_escape_string($conn, $_POST['game']);

// Insert the user into the database
	$sql = "INSERT INTO scores (username, user_score, game) VALUES ('$username', '$user_score', '$game');";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM scores WHERE game = '$game' ORDER BY user_score DESC"; // SELECT * FROM scores WHERE game = '$game' ORDER BY user_score DESC LIMIT 10
	$result = mysqli_query($conn, $sql);

	$uniqueUsername = array();
	$data = array();
	while ($row = mysqli_fetch_row($result)) {
		if(!in_array($row[0], $uniqueUsername)) {
			$uniqueUsername[] = $row[0];
			$data[] = $row;
		}
	}

	echo json_encode($data, JSON_NUMERIC_CHECK);
