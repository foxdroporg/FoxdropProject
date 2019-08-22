<?php
	include_once 'header.php';
?>

<main>
	<section class="main-container">
		<div class="main-wrapper">
		<div class="background-color">

			<h2 style="color:#FFFFFF">Last step for reseting your password</h2>
			<p align="center" style="color:#FFFFFF; font-size: 20px; padding-top: 1%">Input your new password twice.</p>
				<?php
					$selector = $_GET["selector"];
					$validator = $_GET["validator"];

					if (empty($selector) || empty($validator)) {
						echo "Could not validate your request!";
					}
					else {
						if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
				?>
								<form class="signup-form" action="includes/reset-password.inc.php" method="POST">
									<input type="hidden" name="selector" value="<?php echo $selector; ?>">
									<input type="hidden" name="validator" value="<?php echo $validator; ?>">
									<input type="password" name="pwd" placeholder="Enter a new password...">
									<input type="password" name="pwd-repeat" placeholder="Repeat new password...">
									<button type="submit" name="reset-password-submit">Reset password</button>
								</form>

							<?php
						}
					}
				?>
				</div>
		</div>
	</section>
</main>



<?php
	include_once 'footer.php';
?>
