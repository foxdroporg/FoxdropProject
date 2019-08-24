<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Portfolio</title>
	<style>
		div .column a:hover {
			transition: 0.5s ease-in-out;
			transform: scale(1.2, 1.2);
			filter: saturate(250%);
			/* opacity: 0.5; */
		}
	</style>

</head>
<body>
	<section class="main-container">
		<section class="main-wrapper">
			<div class="background-color">
				<h2 style="color:#FFFFFF; font-size: 50px">Games</h2>

				<div class="row">
					<div class="column">
						<a href="games/typetosurvive/index.php" style="border:5px solid #ccc;">
							<img src="images/typeToSurvive.jpg" alt="1stSound" style="width:85%; height:85%; ">
						</a>
						<label style="color:grey">A game for those who can type fast on a keyboard</label>
					</div>
					<div class="column">
						<a href="games/snake/index.php" style="border:5px solid #ccc;">
							<img src="images/snake.jpg" alt="3rdGame" style="width:100%; height:100%; ">
						</a>
						<label style="color:grey">A game for people with fast reactions. (Does not work on Mobile)</label>
					</div>
				</div>
				<div class="row">
					<div class="column">
						<a href="games/hitthelight/index.html" style="border:5px solid #ccc;">
								<img src="images/hitTheLight.png" alt="2ndSound" style="width:100%; height:100%; ">
						</a>
						<label style="color:grey">A game for people with good vision</label>
					</div>
					<div class="column">
						<a href="games/maze/index.php" style="border:5px solid #ccc;">
							<img src="images/maze.jpg" alt="4thGame" style="width:100%; height:100%; ">
						</a>
						<label style="color:grey">A game for people who are fast with the arrow keys. (Does not work on Mobile)</label>
					</div>
				</div>
				<div class="row">
					<div class="column">
						<a href="games/tictactoe/difficulty.html" style="border:5px solid #ccc;">
							<img src="images/TicTacToe.png" alt="2ndGame" style="width:80%; height:85%; ">
						</a>
						<label style="color:grey">A game for people who wants to play a simple game vs. a friend</label>
					</div>
					<div class="column">
						<a href="games/gobblet/index.php" style="border:5px solid #ccc;">
							<img src="images/gobblet.jpg" alt="2ndSound" style="width:85%; height:100%; ">
						</a>
						<label style="color:grey">A game for people who wants to play a challenging game vs. friend</label>
					</div>
				</div>
				<div class="row">
					<div class="column">
						<a href="games/simonsays/menu.html" style="border:5px solid #ccc;">
							<img src="images/simonsays.jpg" alt="2ndGame" style="width:85%; height:100%; ">
						</a>
						<label style="color:grey">A game for those who have a good memory</label>
					</div>
					<div class="column">
						<a href="games/pong/index.html" style="border:5px solid #ccc;">
								<img src="images/pong.png" alt="1stGame" style="width:95%; height:95%; ">
						</a>
						<label style="color:grey">A game for people that are fast with the mouse. (Does not work on Mobile)</label>
					</div>
				</div>
			</div>
		</section>
	</section>

	<section class="main-container">
		<section class="main-wrapper">
			<div class="background-color">
			<h2 style="color:#FFFFFF; font-size: 50px">Web-Applications</h2>
			
			<div class="row">
				<div class="column">
					<a href="webApplications/MDBWebsite/index.html" style="border:5px solid #ccc;">
						<img src="images/IMDB.jpg" alt="1stSound" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 3/5. Back-End: 4/5 <br>(Axios, Bootstrap UI, JQuery)</label>
				</div>
				<div class="column">
					<a href="webApplications/travelAgency/index.html" style="border:5px solid #ccc;">
						<img src="images/travel.jpg" alt="2ndSound" style="width:100%; height:70%; ">
					</a>
					<label style="color:grey">Front-End: 5/5. Back-End: 2/5 <br>(Autocomplete, Smooth Scroll)</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="webApplications/YoutubeWebsite/index.html" style="border:5px solid #ccc;">
						<img src="images/Youtube.png" alt="1stSound" style="width:85%; height:85%; ">
					</a>
					<label style="color:grey">Front-End: 3/5. Back-End: 5/5 <br>(OAuth2 Login, Materialize UI)</label>
				</div>
				<div class="column">
					<a href="webApplications/geolocation.php" style="border:5px solid #ccc;">
						<img src="images/geolocation.png" alt="3rd" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 2/5. Back-End: 4/5 <br>(JS Leaflet Map)</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="webApplications/recipe.php" style="border:5px solid #ccc;">
						<img src="images/pancakes.jpg" alt="1stSound" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 2/5. Back-End: 3/5 <br>(Recipe Generator)</label>
				</div>
				<div class="column">
					<a href="webApplications/nasaImage.php" style="border:5px solid #ccc;">
						<img src="images/nasaImage.png" alt="2ndSound" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 1/5. Back-End: 2/5 <br>(PHP Unirest/Request)</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="webApplications/leagueSearch.php" style="border:5px solid #ccc;">
						<img src="images/leagueSearch.png" alt="4th" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 2/5. Back-End: 5/5 <br>(Inspired by OP.GG website)</label>
				</div>
				<div class="column">
					<a href="webApplications/musicDJ.php" style="border:5px solid #ccc;">
						<img src="images/musicRepresentation.jpg" alt="2ndSound" style="width:100%; height:70%; ">
					</a>
					<label style="color:grey">Front-End: 3/5. Back-End: 1/5 <br>(p5.js technology)</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="webApplications/booklist.php" style="border:5px solid #ccc;">
						<img src="images/bookListing.jpg" alt="4th" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 3/5. Back-End: 1/5 <br>(Local Storage, DOM Manipulation)</label>
				</div>
				<div class="column">
					<a href="https://ancient-reaches-50207.herokuapp.com/" style="border:5px solid #ccc;">
						<img src="images/apex.jpg" alt="2ndSound" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Front-End: 4/5. Back-End: 4/5 <br> (Node.js, Vue.js, Fullstack)</label>
				</div>
			</div>
			</div>
		</section>
	</section>

	<section class="main-container">
		<section class="main-wrapper">
			<div class="background-color">
			<h2 style="color:#FFFFFF; font-size: 50px">Animations</h2>

			<div class="row">
				<div class="column">
					<a href="animations/foodPoison.php" style="border:5px solid #ccc;">
						<img src="images/agentsAI.jpg" alt="3rdAnimation" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">An animation for those who are interested in DNA and genetic mutation</label>
				</div>
				<div class="column">
					<a href="animations/stars.php" style="border:5px solid #ccc;">
						<img src="images/stars.png" alt="2ndAnimation" style="width:70%; height:70%; ">
					</a>
					<label style="color:grey">An animation for those who love Star Wars</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="animations/transformingCube.php" style="border:5px solid #ccc;">
						<img src="images/transformingCube.png" alt="3rdAnimation" style="width:90%; height:90%; ">
					</a>
					<label style="color:grey">An animation for people who are facinated by ripple effects</label>
				</div>
				<div class="column">
					<a href="animations/issLocation.php" style="border:5px solid #ccc;">
						<img src="images/ISS.png" alt="4thAnimation" style="width:95%; height:95%; ">
					</a>
					<label style="color:grey">A real-time animation for people who enjoy space & satellites</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="animations/mountain.php" style="border:5px solid #ccc;">
						<img src="images/mountain.png" alt="1stAnimation" style="width:70%; height:65%; ">
					</a>
					<label style="color:grey">An animation for people who think mountains are beautiful</label>
				</div>
				<div class="column">
					<a href="animations/cube.html" style="border:5px solid #ccc;">
						<img src="images/4DTesseract.png" alt="4thAnimation" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">This is how a rotating 4D hypercube looks like when we project it into 3D</label>
				</div>
			</div>
			</div>
		</section>
	</section>


	<section class="main-container">
		<section class="main-wrapper">
			<div class="background-color">
			<h2 style="color:#FFFFFF; font-size: 50px">Relax</h2>

			<div class="row">
				<div class="column">
					<a href="relax/lava.php" style="border:5px solid #ccc;">
						<img src="images/lavaFlow.png" alt="1stSound" style="width:80%; height:85%; ">
					</a>
					<label style="color:grey">Relax to the natural and mellow sound of bubbling lava</label>
				</div>
				<div class="column">
					<a href="relax/cave.php" style="border:5px solid #ccc;">
						<img src="images/caveLife.png" alt="2ndSound" style="width:85%; height:85%; ">
					</a>
					<label style="color:grey">Relax to rhythmic and hushed dripping sounds captured from an underground cave</label>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<a href="relax/rain.php" style="border:5px solid #ccc;">
						<img src="images/rain.png" alt="3rdSound" style="width:100%; height:100%; ">
					</a>
					<label style="color:grey">Sit back and listen to the rain while it hits the ground and thunder reverberate and echo through the night</label>
				</div>
				<div class="column">
					<a href="relax/beach.php" style="border:5px solid #ccc;">
						<img src="images/beach.png" alt="4thSound" style="width:95%; height:95%; ">
					</a>
					<label style="color:grey">Listen to the staccato sound of waves crashing into the beach sand</label>
					
				</div>
			</div>
			</div>
		</section>
	</section>
</body>
</html>



<?php
include_once 'footer.php';
?>
