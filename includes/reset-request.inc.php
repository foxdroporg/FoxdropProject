<?php 

if (isset($_POST["reset-request-submit"])) {
	
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "http://localhost/loginsystem/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	require 'dbh.inc.php';

	$userEmail = $_POST["email"];

	$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "Error occured!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

	$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
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

	$headers = "From: Foxdrop <kristopher.werlinder@telia.com>\r\n";
	$headers .= "Reply-To: <kristopher.werlinder@telia.com>\r\n";
	$headers .= "Content-type: text/html\r\n";

	//
	require_once('../PHPMailer/PHPMailerAutoload.php');
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '465';
	$mail->isHTML();
	$mail->Username = 'kristopher.werlind@gmail.com';
	$mail->Password = 'Werlinder99';
	$mail->SetFrom($headers); //Original: $mail->SetFrom('no-reply@howcode.org');
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);

	$mail->Send();
	//

	// mail($to, $subject, $message, $headers);	 // Need a mail server for this to be able to work. 

	header("Location: ../reset-password.php?reset=successful");

} 
else {
	header("Location: ../index.php");
}