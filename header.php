<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="This is an example of a meta description">
		<meta name=viewport content="width=device-width, initial-scale=1">
		
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" type="image/png" href="images/firefoxLogo.PNG">
	</head>

	<header>
		<nav>
			<div class="main-wrapper">
				<ul>
					<li><a href="index.php">
						<img src="images/firefoxLogo.png" alt="HTML5 Icon" style="padding: 5px; float:left; width:50px; height:50px;">
					</a>
					</li>
					<li><a href="index.php">HOME</a></li>
					<li><a href="portfolio.php">PORTFOLIO</a></li>
					<li><a href="about.php">ABOUT</a></li>
					<li><a href="contact.php">CONTACT</a></li>
				</ul>
				<div class="nav-login">
					<?php
						if (isset($_SESSION['u_id'])) {
							echo '<form action="includes/logout.inc.php" method="POST">
								<button type="submit" name="submit">Logout</button>
							</form>';
						} else {
							echo '<form action="includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="Username/e-mail">
							<input type="password" name="pwd" placeholder="Password">
							<button type="submit" name="submit">Login</button>
							</form>
							<a href="signup.php">Sign up</a>';
						}
					?>
				</div>
			</div>
		</nav>
	</header>