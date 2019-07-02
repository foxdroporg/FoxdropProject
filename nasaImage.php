<?php
    include_once 'header.php';
    require 'vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(__DIR__);
	$dotenv->load();
?>
<head>
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
			echo '<img src="data:image/jpeg;base64,'.$imageData.'"><br><br>';
			echo '<span style="color:white;text-align:center;font-size:25px;">' . $explanation . '<br><br></span>';
		?>
		</div>

	   
	</section>
</section>
  </body>


<?php
	include_once 'footer.php';
?>


		