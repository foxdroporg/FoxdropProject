<?php
	include_once 'header.php';
?>

<main>
	<div class="main-wrapper">
		<section class="main-container">
				<h2 style="color:#FFFFFF">Reset your password</h2>
				<p>An e-mail will be send to you with instructions on how to reset your password.</p>
				<form action="includes/reset-request.inc.php" method="POST">
					<input type="text" name="email" placeholder="Enter your e-mail address...">
					<button type="submit" name="reset-request-submit">Recieve new password by e-mail</button>
				</form>
				<?php
					if(isset($_GET["reset"])) {
						if ($_GET["reset"] == "success") {
							echo '<p class="signupsuccess">Check your e-mail!</p>';
						}
					}
				?>
		</section>
	</div>
</main>



<?php
	include_once 'footer.php';
?>
