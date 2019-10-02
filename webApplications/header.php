<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Foxdrop"> <!-- This is an example of a meta description -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link class="img-test" rel="shortcut icon" type="image/png" href="../images/firefoxLogo.png">
		<title></title>
	</head>

	<header>
		<nav>
			<div class="header-wrapper">
				<ul>
					<li>
						<a href="../home.php">
							<img class="img-test" src="../images/firefoxLogo.png" alt="HTML5 Icon" style="padding: 5px; float:left; width:3.7rem; height:3.7rem;">
						</a>
					</li>
					<li><a class="button-test" href="../home.php">HOME</a></li>
					<li><a class="button-test" href="../portfolio.php">PORTFOLIO</a></li>
					<li><a class="button-test" href="../about.php">ABOUT</a></li>
					<li><a class="button-test" href="../contact.php">CONTACT</a></li>
				</ul>

				<div class="nav-login">
					<?php
						if (isset($_SESSION['u_id'])) {

							echo '<form action="../profilePage.php" method="POST""><button class="button-test" type="submit" name="submit" style="width: auto; outline:none;"><p><b>' . $_SESSION["u_uid"] . '    ' . '</b></p></button></form>';


							echo '<form action="../includes/logout.inc.php" method="POST">
								<button class="button-test" type="submit" name="submit">Logout</button>
							</form>';

						} else {
							echo '<form action="../includes/login.inc.php" method="POST">
							<input required type="text" name="uid" placeholder="Username/e-mail">
							<input required type="password" name="pwd" placeholder="Password">
							<button class="button-test" type="submit" name="submit">Login</button>
							</form>
							<form action="../signup.php" method="POST"> <button class="button-test">Sign up</button> </form>';
						}
					?>
				</div>
			</div>
		</nav>
	</header>
