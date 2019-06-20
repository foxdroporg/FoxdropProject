<?php
	include_once 'header.php';
?>



<main>
	<body>
		<section class="main-container">
			<div class="main-wrapper">
				
					<h2 style="color:#FFFFFF">Reset your password</h2>
					<p align="center" style="color:#FFFFFF; font-size: 20px; padding-top: 1%">An e-mail will be sent to you with instructions on how to reset your password. <br> (Works for gmail. Other emails may not be supported).</p>
					<form class="signup-form" action="includes/reset-request.inc.php" method="POST">
						<input type="text" name="email" placeholder="Enter your e-mail address...">
						<button type="submit" name="reset-request-submit">Recieve new password by e-mail</button>
					</form>
					<?php
						if(isset($_GET["reset"])) {
							if ($_GET["reset"] == "successful") {
								echo '<p class="signupsuccess" style="color:green; text-align:center; padding-top:3%">Check your e-mail!<br>(If e-mail does not appear, check spam mail) </p>';
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
