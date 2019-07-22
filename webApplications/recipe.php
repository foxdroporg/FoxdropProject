<?php
	include_once 'header.php';
    require '../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
	$dotenv->load();
	$API_KEY = $_ENV['RAPID_API_KEY'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible"
			content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
		<section class="main-container">
			<div class="main-wrapper">
				
				<?php
					$response = Unirest\Request::get("https://recipe-puppy.p.rapidapi.com/?p=10&i=onions%2Cgarlic&q=pasta",
					  array(
					    "X-RapidAPI-Host" => "recipe-puppy.p.rapidapi.com",
					    "X-RapidAPI-Key" => $API_KEY
					  )
					);
					$responseBody = $response->body;
				?>


			</div>
		</section>
	</body>
</html>

<?php
	include_once 'footer.php';
?>