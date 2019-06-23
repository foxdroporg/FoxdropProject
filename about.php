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
			<h2 style="color:#FFFFFF; font-size: 50px">About</h2>
			<br>
			<br>

			<div class="paragraph">
				Foxdrop started as a group project between two KTH students, but then transitioned into a fully functional website as a result of our continued development on our spare time. We love to share the things we work with and this is the perfect way to do just that. Hopefully, you find great joy in interacting with our website, and if so, we encourage you to share these experiences with friends and family.
			</div>
			<div class="paragraph">
				Do not hesitate to ask any questions or make requests about functionality that you'd like us to add. Go to 
				"Contact" for more information about how to get in touch with us.
			</div>
			<div class="paragraph">
				The site has currently amassed a database of ___ scores in ___ games by ___ users. We welcome all student web designers and developers to join us in helping grow this site.
			</div>

			<div class="row" style="padding-bottom: 5%; padding-left: 10%; padding-right: 10%;">
				<h2 style="color:white; font-size: 25px; padding-top: 2%; ">Administrators:</h2>
				<div class="column" style="text-align: center; font-size: 20px">
					<p style="color:orange">Kristopher W <p style="color:white">- Role: Co-Founder <br>- Qualities: SQL, MySQL, NodeJS, jQuery, Java, PHP, Python.</p></p>
				</div>
				<div class="column" style="text-align: center; font-size: 20px">
					<p style="color:orange">Erik H <p style="color:white">- Role: Co-Founder <br>- Qualities: HTML, Javascript, jQuery, CSS, React, Redux, Angular. </p></p>
				</div>

			</div>
			<div class="row" style="padding-bottom: 5%; padding-left: 10%; padding-right: 10%; ">
				<h2 style="color:white; font-size: 25px; padding-top: 2%">Features: </h2>
				<p class="paragraph" style="color:white; text-align: left; padding-left: 30%">
				    ✓ Game leaderboards <br>
				    ✓ Secure database for profiles <br>
				    ✓ Forgotten password service <br>
				    ✓ Game customisation options <br>
				    ✓ Facinating web animations <br>
				    ✓ Relaxing sounds recorded in nature <br>
				    ✓ Contact form for suggestions and questions <br>
				    ✓ Github Rest API to see latest changes on site<br>
				    ✓ OpenSource avaliable on Github<br>
				    ✖ MovieMinded a quiz game on movies of your choice <br>
				    ✖ Profile page with daily information <br>
				    ✖ Geolocation application for local weather forecasts<br>
				    ✖ Search bar for finding things fast <br>
				    ✖ Trivia Game using jService Rest API <br>

				    
				</p>
			</div>

			<div class="header" style="color:white; text-align:center; padding-bottom: 3%;">
				Want to know more about us? <a style="color:orange; padding-top: 2%" href="https://github.com/foxdroporg/FoxdropProject">https://github.com/foxdroporg/FoxdropProject</a>
			</div>
		</div>
	</body>
</section>

<section class="main-container">
	<div class="main-wrapper">
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
</section>

</html>




<?php
include_once 'footer.php';
?>