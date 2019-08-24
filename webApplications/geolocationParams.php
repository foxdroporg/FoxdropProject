<?php
	include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous">
  <script
	  src="https://code.jquery.com/jquery-3.3.1.slim.js"
	  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
	  crossorigin="anonymous">
  </script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link class="img-test" rel="shortcut icon" type="image/png" href="images/firefoxLogo.png">
  

	<link
	  rel="stylesheet"
	  href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
	  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
	  crossorigin=""
	/>
	<script
	  src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
	  integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
	  crossorigin=""
	></script>
	<style>
	  #issMap {
	    height: 400px;
	    width: 400px;
	    position: relative;
	    margin: auto;
	  }
	</style>
</head>



<body bgcolor="">
	<section class="mobile-wrapper">
		<div style="background:black" class="jumbotron mt-5 text-white border">
		  <h2 style="text-align:center; font-size:40px; padding-top: 5%">3-Hour-Forecast</h2>

		  <script>
		  	let lat, lon, lat2, lon2, altitude, heading, speed, weather, air;  
		  	// Geolocation is avaliable as soon as website is deployed on a (https) hosting service.
		  	if('geolocation' in navigator) {
		  		console.log('geolocation avaliable');
		  		navigator.geolocation.getCurrentPosition(async position => {
		  			lat = position.coords.latitude;
		  			lon = position.coords.longitude;
		  			document.getElementById('lat').textContent = lat;
		  			document.getElementById('lon').textContent = lon;
		  			
		  		});
		  	}
		  	else {
		  		console.log('geolocation IS NOT avaliable');
		  	}
		  </script>

		  <br><br>

		  <?php
			$city = $_GET["city"];
			if(!isset($city)) {
				$city = 'stockholm';
			}
			$city = preg_replace('/\s+/', '+', $city);
			$city = strtolower($city);
			$lat = $_GET["lat"];
			if(!isset($lat)) {
				$lat = '?';
			}
			$lon = $_GET["lon"];
			if(!isset($lon)) {
				$lon = '?';
			}
			require '../vendor/autoload.php';
			$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
			$dotenv->load();
			$API_KEY = $_ENV['RAPID_API_KEY'];

		  	$response = Unirest\Request::get("https://community-open-weather-map.p.rapidapi.com/forecast?lat=".$lat."&lon=".$lon."&q=".$city."",
			  array(
			    "X-RapidAPI-Host" => "community-open-weather-map.p.rapidapi.com",
			    "X-RapidAPI-Key" => $API_KEY
			  )
			);
			$responseBody = $response->body;

			$description = $responseBody->{'list'}[0]->{'weather'}[0]->{'description'};
			$icon = $responseBody->{'list'}[0]->{'weather'}[0]->{'icon'};
			$temp = $responseBody->{'list'}[0]->{'main'}->{'temp'};
			$temp = intval($temp) - 272; 
			$humidity = $responseBody->{'list'}[0]->{'main'}->{'humidity'};
			$windSpeed = $responseBody->{'list'}[0]->{'wind'}->{'speed'};
			$windDegree = $responseBody->{'list'}[0]->{'wind'}->{'deg'};
			$windDegree = round($windDegree/45);
			$windDir;
			switch($windDegree) {
				case 0: $windDir = "S";
				break;
				case 1: $windDir = "SW";
				break;
				case 2: $windDir = "W";
				break;
				case 3: $windDir = "NW";
				break;
				case 4: $windDir = "N";
				break;
				case 5: $windDir = "NE";
				break;
				case 6: $windDir = "E";
				break;
				case 7: $windDir = "SE";
				break;
				default: $windDir = "S";
				break;
			}
			
			$rainLast3h = '0';
			if(isset($responseBody->{'list'}[0]->{'rain'}->{'3h'})) {
				$rainLast3h = $responseBody->{'list'}[0]->{'rain'}->{'3h'};
			}
			$cloudProcentage = $responseBody->{'list'}[0]->{'clouds'}->{'all'};
			$date = $responseBody->{'list'}[0]->{'dt_txt'};

			echo '<p style="text-align:center"><img src="http://openweathermap.org/img/wn/'.$icon.'@2x.png" style="width:7em;height:7em;"/><span style="color:gold;text-align:center;font-size:30px"><br>' . $description . '</p><br><br></span></p>';

			echo '<center>';
			echo '<p style="color:white">Temperature: </p> <p style="color:gold">'.$temp.'°C</p>';
			
			echo '<br><p style="color:white">Humidity: </p> <p style="color:gold">'.$humidity.'%</p>';

			echo '<br><p style="color:white">Rain: </p> <p style="color:gold">'.$rainLast3h.'mm</p>';

			echo '<br><p style="color:white">Wind direction: </p> <p style="color:gold">'.$windDir.'</p>';

			echo '<br><p style="color:white">Wind speed: </p> <p style="color:gold">'.$windSpeed.' m/s</p>';

			echo '<br><p style="color:white">Sky is filled with: </p> <p style="color:gold">'.$cloudProcentage.'% clouds</p>';
			

			$tempDate = $date;
			$tempHour = substr($tempDate, 10);
			$tempDate = substr($tempDate, 0, 10);
			$date = substr($date, -8);
			$threeHourAdded = intval(substr($date, 0, 1) === '0' ? substr($date, 1, 2) : substr($date, 0, 2)) + 3;
			$date = substr($date, 2);
			$newHour = strval($threeHourAdded);
			$date = $newHour . "" . substr($date, -3);
			$tempHour = substr($tempHour, 0, -3);

			echo '<br><p style="color:white">Forecast: </p> <p style="color:gold">'.$tempHour.' - '.$date.'   ('.$tempDate.')</p>';

			echo '<br>
			<p style="color:white">Location: </p> <p style="color:gold">' .ucwords($city).' '.$lat.'°, '.$lon.'°</p>';
			echo '</center>';



		?>

		<center>
		<button onClick="goBack()" class="btn btn-lg btn-primary mt-5">
			<span class="glyphicon glyphicon-search"></span> Go Back..
		</button>
		<script type="text/javascript">
			function goBack() {
				window.history.back();
			}
		</script> 
		</center>
		</div>
		


		<!--  
		<h2 style="text-align:center; color:white; font-size:40px; padding-top: 3%">You are here</h2>
		<div id="issMap"></div>


		<script type="text/javascript">
			/* Might be good to use Google Maps to spread the rate limit on 
			function showPosition(position) {
			  var latlon = position.coords.latitude + "," + position.coords.longitude;

			  var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=400x300&sensor=false&key=YOUR_:KEY";

			  document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
			}
			*/

			// Making a map and tiles
			const mymap = L.map('issMap');
			const attribution =
			'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
			const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		  	const tiles = L.tileLayer(tileUrl, { attribution });
		  	tiles.addTo(mymap);


		  	// Making a marker with a custom icon
		    const issIcon = L.icon({
		        iconUrl: '../images/personIcon.png',
		        iconSize: [32, 32],
		        iconAnchor: [25, 16]
		    });
		    const marker = L.marker([0, 0], { icon: issIcon }).addTo(mymap);
		    let firstTime = true;

			async function getISS() {
				const latitude = lat;
				const longitude = lon;

				marker.setLatLng([latitude, longitude]);
		        if (firstTime) {
		          mymap.setView([latitude, longitude], 13); 
		          firstTime = false;
		        }

		        /*
				document.getElementById('lat').textContent = latitude.toFixed(2);
				document.getElementById('lon').textContent = longitude.toFixed(2);
				*/
			}
			getISS();

			setInterval(getISS, 1000);
		</script>
		<br><br>
		-->

		

				
	</section>
</body>

</html>