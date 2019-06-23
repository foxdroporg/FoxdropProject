<?php

if (isset($_POST['submit'])) {

	include_once 'dbh.inc.php';

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$mail = mysqli_real_escape_string($conn, $_POST['mail']);
	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$message = mysqli_real_escape_string($conn, $_POST['message']);
	//Error handlers
	//Check for empty fields
	if (empty($name) || empty($mail) || empty($subject) || empty($message)) {
		header("Location: ../contact.php?contact=empty");
		exit();
	} 
	else {
		//Check if email is valid
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../contact.php?contact=invalidEmail");
			exit();
		}
		else {
		$mailTo = "foxdrop.contact@gmail.com";
		$headers = "From: " .$mailFrom;
		$txt = "You have recieved an e-mail from " .$name. ".\n\n".$message;

		// mail() function does not work with gmail according to the internet. So, a hosting service e-mail will be needed which then can forward the mail to gmail.
		// local server 
		mail($mailTo, $subject, $txt, $headers);

		//online server, not yet working. Read through reset-request.inc.php to understand how to fix this.
		/*
		require '../vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::create(__DIR__);
		$dotenv->load();
		$PASSWORD = $_ENV['NO_REPLY_PASS'];

		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer; 
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587; 
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; 

		$mail->Username = 'foxdrop.no.reply@gmail.com';
		$mail->Password = $PASSWORD;

		$mail->setfrom('foxdrop.no.reply@gmail.com'); // $mailFrom
		$mail->addAddress('foxdrop.contact@gmail.com'); 

		$mail->isHTML(true); 
		$mail->Subject = $subject;
		$mail->Body = $message;
		
		if(!$mail->send()){
			echo "Message could not be sent!";	
		}
		else {
			//echo "Message has been sent!"; // Looks ugly but is good to show the user it was a success. 
		}
		*/

		header("Location: ../contact.php?contact=mailWasSent");
		}
	}
}