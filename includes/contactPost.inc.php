<?php

if (isset($_POST['post'])) {

	include_once 'dbh.inc.php';

	$body = mysqli_real_escape_string($conn, $_POST['postbody']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);

	$sql = "INSERT INTO posts (body, posted_at, username, hearts) VALUES ('$body', NOW(), '$username', '0');";
  	mysqli_query($conn, $sql);
	header("Location: ../contact.php?post=success");
	
	exit();
}