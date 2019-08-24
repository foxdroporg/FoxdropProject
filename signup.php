<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
	<div class="background-color">
			<h2 style="color:#FFFFFF">Sign up</h2>
			<form class="signup-form" action="includes/signup.inc.php" method="POST">
				<input type="text" name="first" placeholder="First name">
				<input type="text" name="last" placeholder="Last name">
				<input type="text" name="email" placeholder="E-mail">
				<input type="text" name="uid" placeholder="Username">
				<input type="password" name="pwd" placeholder="Password">
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
				if ($_GET["signup"] !== "success") {
					echo '<p class"signupsuccess" style="color:red; font-size:20px; text-align: center; padding-top: 3%">Sign up failed.</p>';
				}
				else {
					echo '<p class"signupsuccess" style="color:green; font-size:20px; text-align: center; padding-top: 3%">Sign up was successful!</p>';
				}
			}
			?>
			
		</div>
	</div>
</section>


<?php
	include_once 'footer.php';
?>


