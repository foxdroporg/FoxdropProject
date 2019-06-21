<?php 


if (isset($_POST["reset-request-submit"])) {
	
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	//Localhost address: 
	//$url = "http://localhost/FoxdropProject/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

	//Online Server address: (Check Suspected Spam filter when email is sent)
	//$url = "www.foxdrop.000webhostapp.com/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
	$url = "http://foxdrop.000webhostapp.com/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
	
	$expires = date("U") + 1800;

	require 'dbh.inc.php'; 

	$userEmail = $_POST["email"];

	$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "Error occured!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

	$sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "Error occured!";
		exit();
	} else {
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

	$to = $userEmail;

	$subject = 'Reset your password for Foxdrop';

	$message = '<p>We recieved a password reset request. The link to reset your password can be found below.</p>';
	$message .= '<p>Here is your password reset link: </br>';
	$message .= '<a href="' . $url . '">' . $url . '</a></p>';

	$headers = "From: Foxdrop <first.last@gmail.com>\r\n";
	$headers .= "Reply-To: <first.last@gmail.com>\r\n";
	$headers .= "Content-type: text/html\r\n";

	require '../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(__DIR__);
	$dotenv->load();
	$PASSWORD = $_ENV['NO_REPLY_PASS'];

	//
	require '../PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer; //new PHPMailer()
	//$mail->isSMTP(); //Enable this line in localhost
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587; //465-ssl or 587-tls
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls'; //ssl for local

	$mail->Username = 'foxdrop.no.reply@gmail.com';	// foxdrop.no.reply@gmail.com
	$mail->Password = $PASSWORD;	

	$mail->setfrom('foxdrop.no.reply@gmail.com'); //Original: $mail->SetFrom('no-reply@howcode.org');  // $headers
	$mail->addAddress($to); //$to

	$mail->isHTML(true); // nothing in brackets
	$mail->Subject = $subject;
	$mail->Body = $message;
	
	if(!$mail->send()){
		//echo "Message could not be sent!";	
	}
	else {
		//echo "Message has been sent!"; // Looks ugly but is good to show the user it was a success. 
	}

	//$mail->Send();
	// mail($to, $subject, $message, $headers);	 // Need a mail server for this to be able to work. 

	header("Location: ../reset-password.php?reset=successful");

} 
else {
	header("Location: ../index.php");
}