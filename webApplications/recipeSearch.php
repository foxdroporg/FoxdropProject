<?php
	include_once 'header.php';
    require '../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
	$dotenv->load();
	$API_KEY = $_ENV['RAPID_API_KEY'];

	$recipeSamples = array('Chilli con carne', 'Lasagne', 'Vegetarian', 'Vegan', 'Chicken curry', 'Budget', 'Salmon', 'Steak', 'Beef', 'Tacos', 'Noodles', 'Pizza', 'Meatballs', 'Pasta');
	
	// Default: scones
	$searchQuery = '';
	$searchQuery = $_GET["searchQuery"];
	if ($searchQuery === '') $searchQuery = $recipeSamples[mt_rand(0, sizeof($recipeSamples))]; 

	// Default: none.
	$ingredients = '';
	$ingredients = $_GET["ingredients"];

	// Default : 1
	$page = $_GET["page"];
	if ($page === '') $page = 1;
	//var_dump($);

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
	    <title>Summoner Search</title>
	    <script
		  src="https://code.jquery.com/jquery-3.3.1.slim.js"
		  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
		  crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<section class="mobile-wrapper">
				<div class="jumbotron mt-5 text-black">
					<p style="text-align:center">
					    <button onClick="goBack()" class="btn btn-lg btn-primary mb-4">
					      <span class="glyphicon glyphicon-search"></span> Search..
					    </button>
						<script type="text/javascript">
							function goBack() {
							  window.history.back();
							}
						</script> 
					</p>
					<h2 class="font-weight-bold text-capitalize mb-3" style="text-align:center; font-size:50px;">Find recipe</h2>
					<p style="text-align:center; color:darkred">Note: <p style="text-align:center; color:black">Links are retrived from external sources.</p></p>
				
				<?php
					$response = Unirest\Request::get("https://recipe-puppy.p.rapidapi.com/?p=".$page."&i=".$ingredients."&q=".$searchQuery,
					  array(
					    "X-RapidAPI-Host" => "recipe-puppy.p.rapidapi.com",
					    "X-RapidAPI-Key" => $API_KEY
					  )
					);
					$responseBody = @$response->body->results; //[1]->{'thumbnail'};
					//echo '<pre>'.var_dump($responseBody).'</pre>';
					$title = '';
					$img = '';
					$ingredients = '';
					$href = '';
					for ($i=0; $i < @sizeof($responseBody); $i++) {
						
						if(isset($responseBody[$i]->{'title'})) {
							$title = $responseBody[$i]->{'title'};
						}
						if(isset($responseBody[$i]->{'thumbnail'})) {
							$img = $responseBody[$i]->{'thumbnail'};
						}
						if(isset($responseBody[$i]->{'ingredients'})) {
							$ingredients = $responseBody[$i]->{'ingredients'};
						}
						if(isset($responseBody[$i]->{'href'})) {
							$href = $responseBody[$i]->{'href'};
						}
						echo '<br><div class="card card-body bg-light text-white">',
							$title !== '' ? '<br><br><b><p style="color:black; text-align:center">'.$title.'</p></b>' : '',
						    $img !== '' ? '<img src="'.$img.'" style="padding:1rem 0rem 1rem 0rem;display:block;margin-left:auto;margin-right: auto;width: 30%;"</p>' : '',
							$ingredients !== '' ? '<p style="color:black; text-align:center"><b>Ingredients:</b><br>'.$ingredients.'<br></p>' : '',
							$href !== '' ? '<p style="color:black; text-align:center"><br><b>How to cook it:</b><br> <a target="_blank" href='.$href.'>Click here</a><br></p>' : '',
						'</div>';
					}
					

					/*
					$results = $responseBody->{'results'};
					echo '<pre>'.var_dump($results).'</pre>';
					for ($i=0; $i < sizeof($results); $i++) {
						if(isset($responseBody->{'results'}->{'thumbnail'})) {
							echo '<img src="'.$results->{'thumbnail'}.'" style="width:3rem;height:3rem;"</p>';
						}
						if(isset($responseBody->{'results'}->{'title'})) {
							echo '<p style="color:black; text-align:center">'.$results->{'title'}.'</p>';
						}
						if(isset($responseBody->{'results'}->{'ingredients'})) {
							echo '<p style="color:black; text-align:center">Ingredients: '.$results->{'ingredients'}.'<br></p>';
						}
						if(isset($responseBody->{'results'}->{'href'})) {
							echo '<p style="color:black; text-align:center">How to cook it, click the link: <a href='.$results->{'href'}.'>'.$results->{'href'}.'</a><br></p>';
						}
						
						echo '<p style="color:black; text-align:center">'.$results->{'title'}.'<br>Ingredients: '.$results->{'ingredients'}.'How to cook it, click the link: <a href='.$results->{'href'}.'>'.$results->{'href'}.'</a><p>';
						
					}
					*/
				?>


			</div>
		</section>
	</body>
</html>

<?php
	include_once 'footer.php';
?>