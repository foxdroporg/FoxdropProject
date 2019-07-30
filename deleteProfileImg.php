<?php
ob_start();
include_once 'header.php';
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
// Local
/*
$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
$dbName = $_ENV['DB_LOCAL_NAME'];
*/
// Public
$dbServername = $_ENV['DB_SERV_NAME']; 
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$userid = $_SESSION['u_id'];

$filename = "uploads/profile".$userid.".*";
$fileinfo = glob($filename);
$fileext = explode(".", $fileinfo[0]);
$fileactualext = $fileext[1];

$file = "uploads/profile".$userid.".".$fileactualext;

if (!unlink($file)) {
	echo "File was not deleted.";
}
else {
	//echo "File was deleted!";
}

$sql = "UPDATE profileimg SET status=1 WHERE userid='$userid';";
mysqli_query($conn, $sql);
header("Location: /profilePage.php?deleteImg=success");
exit();
ob_end_flush();
?> 