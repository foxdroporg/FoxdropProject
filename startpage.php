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
				<h2 style="color:#FFFFFF">Latest News</h2>
		</div>

		<?php
			// Fix GitHub API
		$repositoryTest1 = file_get_contents("https://api.github.com/repos/ehenri/Project-Repository");
		$repositoryTest2 = file_get_contents("https://api.github.com/user/starred/kriwer/Project-Repository");
		$repositoryNews = file_get_contents("https://api.github.com/repos/ehenri/Project-Repository/issues?state=closed");	// ?query1=value1&query2=value2 // query parameters

		$getAllkriwerRepos = file_get_contents("https://api.github.com/users/Christofferos/repos?sort=pushed");

		?>



	</section>



</html>





<?php
	include_once 'footer.php';
?>