<?php
    include_once 'header.php';
?>



<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=\, initial-scale=1.0" />
			<meta http-equiv="X-UA-Compatible" content="ie=edge" />

			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
		    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/addons/p5.dom.min.js"></script>
		    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/addons/p5.sound.min.js"></script>
		    <script type="text/javascript" src="animations/iss.js"></script>

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
		        height: 600px;
		        width: 1000px;
		        position: relative;
			    top: 50%;
			    left: 25%;
		      }
		    </style>
	</head>


	<body>
		<br><br><br>
		<h1 style="color:white; font-size: 20px; text-align: center">Where is the International Space Station Right Now?</h1>
		<br>

		<p style="color:white; font-size: 15px; text-align: center">
			Latitude: <span id="lat"></span>° 
		<br>
			Longitude: <span id="lon"></span>°
		<br>
			Velocity: <span id="vel"></span>km/h
		<br>
			Altitude: <span id="alt"></span>km
		</p>	

		<br>

		<div id="issMap"></div>

		<br>
		<h2 style="color:white; font-size: 20px; text-align: center; padding: 1% 20% 0% 20%">
		The International Space Station (ISS) is a space station, or a habitable artificial satellite, in low Earth orbit. The ISS programme is a joint project between five participating space agencies: NASA (United States), Roscosmos (Russia), JAXA (Japan), ESA (Europe), and CSA (Canada). The ISS serves as a microgravity and space environment research laboratory in which crew members conduct experiments in biology, human biology, physics, astronomy, meteorology, and other fields.<br> [Wikipedia, "International Space Station"].
		</h2>

		<script>
			// Making a map and tiles
      		const mymap = L.map('issMap');
      		const attribution =
        	'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
        	const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
	      	const tiles = L.tileLayer(tileUrl, { attribution });
	      	tiles.addTo(mymap);


	      	// Making a marker with a custom icon
		    const issIcon = L.icon({
		        iconUrl: 'images/iss200.png',
		        iconSize: [50, 32],
		        iconAnchor: [25, 16]
		    });
		    const marker = L.marker([0, 0], { icon: issIcon }).addTo(mymap);
		    const apiUrl = 'https://api.wheretheiss.at/v1/satellites/25544';
		    let firstTime = true;

			async function getISS() {
				const response = await fetch(apiUrl);
				const data = await response.json();
				const { latitude, longitude, velocity, altitude } = data;

				marker.setLatLng([latitude, longitude]);
		        if (firstTime) {
		          mymap.setView([latitude, longitude], 2);
		          firstTime = false;
		        }

				document.getElementById('lat').textContent = latitude.toFixed(2);
				document.getElementById('lon').textContent = longitude.toFixed(2);
				document.getElementById('vel').textContent = velocity.toFixed(2);
				document.getElementById('alt').textContent = altitude.toFixed(2);
			}
			getISS();

			setInterval(getISS, 1000);
		</script>
	</body>


<?php
	include_once 'footer.php';
?>