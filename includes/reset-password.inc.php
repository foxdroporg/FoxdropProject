<?php 

if (isset($_POST["reset-password-submit"])) {

	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passwordRepeat = $_POST["pwd-repeat"];

	if (empty($password) || empty($passwordRepeat)) {
		header("Location: ../create-new-password.php?newpwd=empty");
		exit();
	}
	else if ($password != $passwordRepeat) {
		header("Location: ../create-new-password.php?newpwd=pwdnotsame");
		exit();
	}

	$currentDate = date("U");

	require 'dbh.inc.php';

	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "Error occured!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate); //$currentDate somewhere here. DÒ NOT FORGET. 1.09.00
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "You need to re-submit your reset request.";
			exit();
		}
		else {

			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

			if ($tokenCheck == false) {
				echo "You need to re-submit your reset request.";
				exit();
			}
			elseif ($tokenCheck == true) {
				$tokenEmail = $row['pwdResetEmail'];

				$sql = "SELECT * FROM users WHERE user_email=?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "Error occured!";
					exit();
				} else {
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
						echo "ERROR occured.";
						exit();
					}
					else {

						$sql = "UPDATE users SET user_pwd=? WHERE user_email=?";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "Error occured!";
							exit();
						} else {
							$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
							mysqli_stmt_execute($stmt);

							$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "Error occured!";
								exit();
							}
							else {
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../signup.php?newpwd=passwordupdated");
							}
						}

					}
					
				}


			}
		}
	}

} 
else {
	header("Location: ../login.php");
}