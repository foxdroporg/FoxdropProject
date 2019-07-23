<?php
    include_once 'header.php';
    require '../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
	$dotenv->load();
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
		    <title></title>
		    <script
			  src="https://code.jquery.com/jquery-3.3.1.slim.js"
			  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
			  crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

<body>
<section class="main-container">
	<section class="main-wrapper">
		<div id="over">
		

		<h2 style="color:#FFFFFF">NASA - Image of the day<br><br></h2>
		<?php
			$API_KEY = $_ENV['RAPID_API_KEY'];
			$NASA_API_KEY = $_ENV['NASA_API_KEY'];
			$response = Unirest\Request::post("https://NasaAPIdimasV1.p.rapidapi.com/getPictureOfTheDay",
			  array(
			    "X-RapidAPI-Host" => "NasaAPIdimasV1.p.rapidapi.com",
			    "X-RapidAPI-Key" => $API_KEY,
			    "Content-Type" => "application/x-www-form-urlencoded"
			  )
			);
			
			$responseBody = $response->body;
			$explanation = $responseBody->{'contextWrites'}->{'to'}->{'explanation'};
			$image = $responseBody->{'contextWrites'}->{'to'}->{'url'};
			$imageData = base64_encode(file_get_contents("$image"));
			echo '<img src="data:image/jpeg;base64,'.$imageData.'" style="height:100%;width:100%"><br><br>';
			echo '<div style="margin:0% 5% 0% 5%"><span style="color:white;text-align:center;font-size:20px;margin:0% 0% 0% 5%">"' . $explanation . '"<br><br></span></div>';
		?>
		</div>

	   
	</section>
</section>
  </body>


<?php
	include_once 'footer.php';
?>


		