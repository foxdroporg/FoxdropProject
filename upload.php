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

if(isset($_POST['submit'])) {
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'pdf');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 1500000) {
				$fileNameNew = "profile".$userid.".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew; 
				move_uploaded_file($fileTmpName, $fileDestination);
				$sql = "UPDATE profileimg SET status=0 WHERE userid='$userid';";
				$result = mysqli_query($conn, $sql);
				header("Location: /profilePage.php?upload=success");
				exit();
			}
			else {
				echo "File size was too big! <br>Size limit of image is: 1000mb. <br>Your image size was: ".($fileSize/1000). "mb";
			}
		}
		else {
			echo "There was an internal error in the requested file. It may have been empty.<br>Debugging: input element on profilePage of type='file' returned error code 1.";
		}
	}
	else {
		echo "Sorry, you cannot upload files of this type!<br>Allowed file types are: .jpg .jpeg .png .pdf";
	}
}
ob_end_flush();
?> 