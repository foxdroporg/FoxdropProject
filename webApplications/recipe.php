<?php
	include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible"
			content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous">
	    <title>Recipe Search</title>
	    <script
		  src="https://code.jquery.com/jquery-3.3.1.slim.js"
		  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
		  crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<section class="mobile-wrapper">
				<div class="jumbotron mt-5 text-black">
					<h2 class="font-weight-bold" style=" text-align:center; font-size:50px;">Find recipes</h2><!--text-capitalize-->

					<div class="row mt-5 ">
			 			<div class="col">
							<form style="text-align:center" action="recipeSearch.php" method="GET">
								<input type="text" name="searchQuery" id="searchQuery" placeholder="Search for recipe..." style="width:16rem; height: 3rem; font-size: 20px">
								<div class="w-100 mt-0"></div>
								<label>Optional: e.g. <b>scones</b></label>
								<div class="w-100 mt-3"></div>
								<input type="text" name="ingredients" id="ingredients" placeholder="Comma separated ingredients.." style="width:16rem; height: 3rem; font-size: 20px">	
								<div class="w-100 mt-0"></div>
								<label>Optional: e.g. <b>onion, tomato, cheese</b></label>
								<div class="w-100 mt-3"></div>
								<input type="text" name="page" id="page" placeholder="Numeric page in catalog..." style="width:16rem; height: 3rem; font-size: 20px">	
								<div class="w-100 mt-0"></div>
								<label>Optional: e.g. <b>7</b></label>
								<div class="w-100 mt-3"></div>
								<button class="btn btn-lg btn-primary" type="submit" onClick="recipeSearch" style="width:16rem; height:4rem;"><span class="glyphicon glyphicon-search"></span>  Search..</button>
							</form>
							<br><p style=" text-align:center; color:green; font-size: 15px">Generate a recipe by <br>leaving the fields empty.</p>
						</div>
					</div>
			</div>
		</section>
	</body>
</html>

<?php
	include_once 'footer.php';
?>