<?php

if (isset($_POST['post'])) {

	include_once 'dbh.inc.php';

	$postid = (int)mysqli_real_escape_string($conn, $_POST['postid']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);

	$sql = "UPDATE posts SET hearts=hearts+1 WHERE id=$postid;";
  	mysqli_query($conn, $sql);

  	$sqlSecond = "INSERT INTO postshearts (post_id, username) VALUES ('$postid' , '$username');";
  	mysqli_query($conn, $sqlSecond);

	header("Location: ../contact.php?heart=success");
	exit();
}