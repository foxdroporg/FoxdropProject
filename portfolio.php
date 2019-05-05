<?php
	include_once 'header.php';
?>

<section class="main-container">
	<section class="main-wrapper">
		<div class="main-wrapperportfolio">
				<h2 style="color:#FFFFFF">Games</h2>
				<form class="portfolio-collection" action="games/snake/index.html" method="POST">
					<input type="text" placeholder="Search for game">
				</form>

			<div class="row">
				<div class="column">
				    <a href="games/pong/index.html" style="border:5px solid #ccc;">
					<img src="images/pong.png" alt="4thGame" style="width:95%; height:95%; ">
					
					</a>
				</div>
				<div class="column">
					<a href="games/tictactoe/difficulty.html" style="border:5px solid #ccc;">
				    <img src="images/TicTacToe.png" alt="2ndGame" style="width:80%; height:85%; ">
					</a>
				</div>
				<div class="column">
					<a href="games/snake/index.html" style="border:5px solid #ccc;">
				    <img src="images/snake.jpg" alt="3rdGame" style="width:75%; height:75%; ">
					</a>
				</div>
				<div class="column">
					<a href="games/maze/index.html" style="border:5px solid #ccc;">
				    <img src="images/maze.jpg" alt="4thGame" style="width:70%; height:100%; ">
					</a>
				</div>
			</div>

		</div>
	</section>
</section>

<section class="main-container">
	<section class="main-wrapper">
		<h2 style="color:#FFFFFF">Animations</h2>
		
		<div class="row">
			<div class="column">
			    <a href="mountain.php" style="border:5px solid #ccc;">
				<img src="images/mountain.png" alt="4thGame" style="width:70%; height:65%; ">
				</a>
			</div>
			<div class="column">
				<a href="stars.php" style="border:5px solid #ccc;">
			    <img src="images/stars.png" alt="2ndGame" style="width:70%; height:70%; ">
				</a>
			</div>
			<div class="column">
				<a href="transformingCube.php" style="border:5px solid #ccc;">
			    <img src="images/transformingCube.png" alt="3rdGame" style="width:90%; height:90%; ">
				</a>
			</div>
			<div class="column">
				<a href="musicDJ.php" style="border:5px solid #ccc;">
			    <img src="images/musicDJ.png" alt="4thGame" style="width:60%; height:60%; ">
				</a>
			</div>
		</div>
		
	</section>
</section>

<section class="main-container">
	<section class="main-wrapper">
		<h2 style="color:#FFFFFF">Videos</h2>
		<br>
		<br>
		<br>
			<video width="200" controls>
				<source src="videos/vid.mp4" type="video/mp4">
					Your browser does not support mp3 videos!
			</video>
		
	</section>
</section>


<?php
	include_once 'footer.php';
?>