<?php
	include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sign Up</title>
	<style>
		#signupButton {
			font-weight: bold;
		}
		input {
			border: none;
			outline: none;
			text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
			border: 1px solid rgba(0,0,0,0.3);
			border-radius: 5px;
		}
	</style>
</head>
<body>
	<section class="main-container">
		<div class="main-wrapper">
		<div class="background-color">
				<h2 style="color:#FFFFFF">Sign up</h2>
				<form class="signup-form" action="includes/signup.inc.php" method="POST">
					<input required type="text" name="first" placeholder="First name">
					<input required type="text" name="last" placeholder="Last name">
					<input required type="email" name="email" placeholder="E-mail">
					<input required type="text" name="uid" placeholder="Username">
					<input required type="password" name="pwd" placeholder="Password">
					<br><center><label style="color:grey">Save your username & password somewhere, so you don't forget them.</label></center><br>
					<button type="submit" name="submit">Sign up</button>
				</form>
				<form class="signup-form" action="reset-password.php">
					<button type="submit" name="submit">Forgot your password?</button>
				</form>

				<?php
				if (isset($_GET["newpwd"])) {
					if ($_GET["newpwd"] == "passwordupdated") {
						echo '<p class"signupsuccess" style="color:green; font-size:20px; text-align: center; padding-top: 3%">Your password has been reset!</p>';
					}
				}
				if (isset($_GET["signup"])) {
					if ($_GET["signup"] == "success") {
						echo '<p class"signupsuccess" style="color:green; font-size:25px; text-align: center; padding-top: 3%">Sign up was successful!</p>';
					}
					else if ($_GET["signup"] == "empty"){
						echo '<p class"signupsuccess" style="color:red; font-size:25px; text-align: center; padding-top: 3%">Sign up failed, all fields must be filled.</p>';
					}
					else if ($_GET["signup"] == "invalidCharacter"){
						echo '<p class"signupsuccess" style="color:red; font-size:25px; text-align: center; padding-top: 3%">Sign up failed, only english letters are allowed in first and lastname.</p>';
					}
					else if ($_GET["signup"] == "invalidEmail"){
						echo '<p class"signupsuccess" style="color:red; font-size:25px; text-align: center; padding-top: 3%">Sign up failed, invalid email. You need to use: @</p>';
					}
					else if ($_GET["signup"] == "userTakenAlready"){
						echo '<p class"signupsuccess" style="color:red; font-size:25px; text-align: center; padding-top: 3%">Sign up failed, username already taken!</p>';
					}
				}
				?>
				
			</div>
		</div>
	</section>

</body>
</html>


<?php
	include_once 'footer.php';
?>


