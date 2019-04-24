<?php
	include_once 'header.php';
?>

<section class="main-wrapper">
	
	<div class="main-wrapperportfolio">
			<h2 style="color:#FFFFFF">Portfolio</h2>
			<form class="portfolio-collection" action="games/snake/index.html" method="POST">
				<input type="text" placeholder="Search for game">
			</form>
	</div>

	<div class="row">
		<div class="column">
		    <a href="games/pong/index.html" style="border:5px solid #ccc;">
			<img src="images/pong.png" alt="4thGame" style="width:95%; height:95%; border: #000000 6px outset">
			
			</a>
		</div>
		<div class="column">
			<a href="games/tictactoe/difficulty.html" style="border:5px solid #ccc;">
		    <img src="images/TicTacToe.png" alt="2ndGame" style="width:80%; height:85%; border: #000000 6px outset">
			</a>
		</div>
		<div class="column">
			<a href="games/snake/index.html" style="border:5px solid #ccc;">
		    <img src="images/snake.jpg" alt="3rdGame" style="width:75%; height:75%; border: #000000 6px outset">
			</a>
		</div>
		<div class="column">
			<a href="games/maze/index.html" style="border:5px solid #ccc;">
		    <img src="images/maze.jpg" alt="4thGame" style="width:70%; height:50%; border: #000000 6px outset">
			</a>
		</div>
	</div>


</section>



<?php
	include_once 'footer.php';
?>