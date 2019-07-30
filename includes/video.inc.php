<?php

// Session start to get the value from Login. Maybe I have done it incorrectly?
session_start();

include_once 'dbh.inc.php';

$userid = (int) mysqli_real_escape_string($conn, $_POST['userid']);
$embededlink = mysqli_real_escape_string($conn, $_POST['embededlink']);

// Insert the user into the database
	$sql = "INSERT INTO profilevideo (userid, embededlink) VALUES ('$userid', '$embededlink');";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM profilevideo WHERE userid = '$userid';";
	$result = mysqli_query($conn, $sql);

	$data = array();
	while ($row = mysqli_fetch_row($result)) {
		$data[] = $row;
	}

	echo json_encode($data, JSON_NUMERIC_CHECK);
