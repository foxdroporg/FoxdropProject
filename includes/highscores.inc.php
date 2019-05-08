<?php

include_once 'dbh.inc.php';

$user_id = mysqli_real_escape_int($conn, $_POST['id']);
$user_score = mysqli_real_escape_int($conn, $_POST['score']);
$game = mysqli_real_escape_string($conn, $_POST['game']);

/*
You need to create the table before you can insert elements into it.
*/
CREATE TABLE highscores (
	user_score int(11) not null,
	user_id int(11) not null,
	game varchar(256) not null 
);

$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('K', 'W', 'kri.wer@telia.com', 'Chris', 'adgsdf');";
mysqli_query($conn, $sql);

/*
// Insert the user into the database
$sql = "INSERT INTO highscores (user_id, user_score, game) VALUES ('$user_id', '$user_score', '$game');";
mysqli_query($conn, $sql);
exit();
