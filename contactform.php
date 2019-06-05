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
	mail($mailTo, $subject, $txt, $headers);
	header("Location: contact.php?mailWasSent");
}