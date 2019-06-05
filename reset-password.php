<?php
	include_once 'header.php';
?>



<main>
	<body>
		<section class="main-container">
			<div class="main-wrapper">
				
					<h2 style="color:#FFFFFF">Reset your password</h2>
					<p align="center" style="color:#FFFFFF">An e-mail will be sent to you with instructions on how to reset your password.</p>
					<form class="signup-form" action="includes/reset-request.inc.php" method="POST">
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
					
			</div>
		</section>
	</body>
</main>





<?php
	include_once 'footer.php';
?>
