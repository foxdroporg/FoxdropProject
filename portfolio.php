<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapperportfolio">
			<h2 style="color:#FFFFFF">Portfolio</h2>
			<form class="portfolio-collection" action="games/index.html" method="POST">
				<input type="text" placeholder="Games">
			</form>
	</div>

	<div class="row">
		<div class="column">
		    <img src="images/cartoonish.jpg" alt="1stGame" style="width:75%; height:75%; border: #000000 6px outset">
		</div>
		<div class="column">
		    <img src="images/futureShip.jpg" alt="2ndGame" style="width:75%; height:75%; border: #000000 6px outset">
		</div>
		<div class="column">
		    <img src="images/chicagoNight.jpg" alt="3rdGame" style="width:75%; height:75%; border: #000000 6px outset">
		</div>
	</div> 
</section>



<?php
	include_once 'footer.php';
?>