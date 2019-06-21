<?php

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$mailFrom = $_POST['mail'];
	$message = $_POST['message'];

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

	header("Location: contact.php?mailWasSent");
}