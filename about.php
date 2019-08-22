<?php
include_once 'header.php';
?>

<!DOCTYPE html>
<html>
<section class="main-container">

	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="main-wrapper">
		<div class="background-color">
			<h2 style="color:#FFFFFF; font-size: 50px">About</h2>
			<br>
			<br>

			<div class="paragraph">
				Two KTH students started Foxdrop as a group project. Later, it transitioned into a fun hobby.
			</div>
			<div class="paragraph">
				The site has currently amassed a database of: 
				<?php
					/* dbh.inc.php has a path to autoload.php that does not work from this directory... This is why we have re-written the code from (dbh.inc.php) file here. */ 
						include 'vendor/autoload.php';
						$dotenv = Dotenv\Dotenv::create(__DIR__);
						$dotenv->load();
						// Local
						/*
						$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
						$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
						$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
						$dbName = $_ENV['DB_LOCAL_NAME'];
						*/
						// Online 
						
						$dbServername = $_ENV['DB_SERV_NAME']; 
						$dbUsername = $_ENV['DB_USERNAME'];
						$dbPassword = $_ENV['DB_PASSWORD'];
						$dbName = $_ENV['DB_NAME'];
						
						$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

					$sqlQuery = "SELECT COUNT(*) FROM scores";
					$result = mysqli_query($conn, $sqlQuery);
					$data = array();
					while ($row = mysqli_fetch_row($result)) {
						$data[] = $row;
					}
					foreach ($data as &$value) {
						echo '<span style="color:gold;text-align:center;">' . $value[0] . ' </span>';
					}
				?>
				scores in 
				<?php
					$sql = "SELECT game FROM scores";
					$result = mysqli_query($conn, $sql);
					$data = array();
					while ($row = mysqli_fetch_row($result)) {
						$data[] = $row;
					}
					$uniqueGames = 0;
					$uniqueArray = array();
					foreach ($data as &$value) {
						if(!in_array($value[0], $uniqueArray)) {
							$uniqueGames++;
							$uniqueArray[] = $value[0];
						}
					}
					echo '<span style="color:gold;text-align:center;">' . $uniqueGames . ' </span>';
				?>
				games by 
				<?php
					$sql = "SELECT COUNT(*) FROM users";
					$result = mysqli_query($conn, $sql);
					$data = array();
					while ($row = mysqli_fetch_row($result)) {
						$data[] = $row;
					}
					foreach ($data as &$value) {
						echo '<span style="color:gold;text-align:center;">' . $value[0] . ' </span>';
					}
				?>
				users and 
				<?php
					$sql = "SELECT COUNT(*) FROM posts";
					$result = mysqli_query($conn, $sql);
					$data = array();
					while ($row = mysqli_fetch_row($result)) {
						$data[] = $row;
					}
					foreach ($data as &$value) {
						echo '<span style="color:gold;text-align:center;">' . $value[0] . ' </span>';
					}
				?>
				posts by 
				<?php
					$sql = "SELECT username FROM posts";
					$result = mysqli_query($conn, $sql);
					$data = array();
					while ($row = mysqli_fetch_row($result)) {
						$data[] = $row;
					}
					$uniqueUsers = 0;
					$uniqueArray = array();
					foreach ($data as &$value) {
						if(!in_array($value[0], $uniqueArray)) {
							$uniqueUsers++;
							$uniqueArray[] = $value[0];
						}
					}
					echo '<span style="color:gold;text-align:center;">' . $uniqueUsers . ' </span>';
				?>
				users, in the website-forum.
			</div>


			<div class="row" style="padding-bottom: 5%; padding-left: 10%; padding-right: 10%;">
				<div class="column" style="text-align: center; font-size: 20px">
					<p style="color:orange">Kristopher Werlinder <p style="color:white">Role: Co-Founder <br><br>Proficiencies: PHP, MySQL, NodeJS, MongoDB, jQuery, Java, Python.</p></p>
				</div>
				<div class="column" style="text-align: center; font-size: 20px">
					<p style="color:orange">Erik Henriksson <p style="color:white">Role: Co-Founder <br><br>Proficiencies: HTML, Javascript, jQuery, CSS, React, Redux, Go. </p></p>
				</div>

			</div>
			<div class="row" style="padding-bottom: 5%; padding-left: 10%; padding-right: 10%; ">
				<h2 style="color:white; font-size: 25px; padding-top: 2%">Features: </h2>
				<p class="paragraph" style="color:white; text-align: left; padding-left: 30%">
				    ✓ Game leaderboards <br>
				    ✓ Secure database for user profiles <br>
				    ✓ Forgotten password service <br>
				    ✓ Extensive portfolio<br>
				    ✓ Profile page (by clicking on username) <br>
				    ✓ Contact form for suggestions and questions <br>
				    ✓ Open sourced code<br>
				    ✖ A quiz game about IMDb movies that of you have seen<br>
				    ✖ Search bar for finding things fast <br>
				    ✖ Trivia Game using jService Rest API <br>

				    
				</p>
			</div>

			<div class="header" style="color:white; text-align:center; padding-bottom: 3%;">
				Want to know more about us? <a style="color:orange; padding-top: 2%" href="https://github.com/foxdroporg/FoxdropProject" target="_blank">https://github.com/foxdroporg/FoxdropProject</a>
				<br>
				We welcome all student web designers and developers to join us in helping grow this site.
			</div>
		</div>
	</div>
</section>

<section class="main-container">
	<div class="main-wrapper">
	<div class="background-color">
		<h2 style="color:#FFFFFF; padding-bottom: 2%;">FAQ/Instructions</h2>
		
		<div class="paragraph">
			<p style="color:orange">Question:</p> Do you save my login password after I sign up on your website?
			<br>
			- Jacob
		</div>
		<div class="paragraph">
			<p style="color:green">Answer:</p> Yes, we have to save your password on our own database to let you login on Foxdrop. However, we do encrypt all sensitive data making it impossible for us or anyone else to see it.
		</div>

		<div class="paragraph">
			<p style="color:orange">Question:</p> How do I remove my account?
			<br>
			- Gustaf
		</div>
		<div class="paragraph">
			<p style="color:green">Answer:</p> You can do this by sending an e-mail to us with your request as well as your username.
		</div>

		<div class="paragraph">
			<p style="color:orange">Question:</p> When can I expect to see new updates for the website?
			<br>
			- Mikael
		</div>
		<div class="paragraph">
			<p style="color:green">Answer:</p> We try to be as consistent as possible with our Foxdrop updates. Our aim right now is to have new updates out Sundays 18:00.
		</div>

		<div class="paragraph">
			<p style="color:orange">Question:</p> How can I get my name up on the highscore tables?
			<br>
			- Marcus
		</div>
		<div class="paragraph">
			<p style="color:green">Answer:</p> Highscores are shown on the leaderboards if the user has signed up on Foxdrop and have beaten a previous record.
		</div>

		<div class="paragraph" style="padding-top: 3%">
			<p style="color:orange">Instruction: </p> If you have any further questions please go to "Contact" and send your questions to us via e-mail.
		</div>
	</div>
	</div>
</section>

</body>
</html>




<?php
include_once 'footer.php';
?>