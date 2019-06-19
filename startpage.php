<?php
	include_once 'header.php';
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Start Page</title>
		<link rel="stylesheet" href="style.css">
	</head>

	<section class="main-container">
		<div class="main-wrapper">
				<h2 style="color:#FFFFFF; font-size: 50px">Latest News</h2>
		</div>
		

		<p style="text-align: center">
			<span style="color:white; text-align:center; font-size: 30px"></span><br><br><br>

			<span id="com0" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com1" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com2" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com3" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com4" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
		</p>

		<script type="text/javascript">

			async function getGithubCommits() {
		    		const response = await fetch('https://api.github.com/repos/ErikChHenriksson/FoxdropProject/commits');	
		    		const data = await response.json();
		    		
		    		// The 5 latest commit messages from a repository.
		    		data[0] !== undefined ? document.getElementById('com0').textContent = data[0].commit.message : document.getElementById('com0').textContent = "";
		    		data[1] !== undefined ? document.getElementById('com1').textContent = data[1].commit.message : document.getElementById('com1').textContent = "";
		    		data[2] !== undefined ? document.getElementById('com2').textContent = data[2].commit.message : document.getElementById('com2').textContent = "";
		    		data[3] !== undefined ? document.getElementById('com3').textContent = data[3].commit.message : document.getElementById('com3').textContent = "";
		    		data[4] !== undefined ? document.getElementById('com4').textContent = data[4].commit.message : document.getElementById('com4').textContent = "";
		    	}


		    	getGithubCommits()
		    	.then(response => {
		    		console.log('Fetch successful!');
		    	})
		    	.catch(error => {
		    		console.error(error);
		    	});
			
			// Getting data with JS Fetch 
			/*
			fetch('https://api.github.com/users/Christofferos/repos')
			  .then(handleResponse)
			  .then(data => console.log(data))
			  .catch(error => console.log(error))

			function handleResponse (response) {
			  let contentType = response.headers.get('content-type')
			  if (contentType.includes('application/json')) {
			    return handleJSONResponse(response)
			  } else if (contentType.includes('text/html')) {
			    return handleTextResponse(response)
			  } else {
			    // Other response types as necessary. I haven't found a need for them yet though.
			    throw new Error(`Sorry, content-type ${contentType} not supported`)
			  }
			}

			function handleJSONResponse (response) {
			  return response.json()
			    .then(json => {
			      if (response.ok) {
			        return json
			      } else {
			        return Promise.reject(Object.assign({}, json, {
			          status: response.status,
			          statusText: response.statusText
			        }))
			      }
			    })
			}
			function handleTextResponse (response) {
			  return response.text()
			    .then(text => {
			      if (response.ok) {
			        return json
			      } else {
			        return Promise.reject({
			          status: response.status,
			          statusText: response.statusText,
			          err: text
			        })
			      }
			    })
			}
			*/
			// Finished with getting data using fetch.

		</script>



		



	</section>



</html>





<?php
	include_once 'footer.php';
?>