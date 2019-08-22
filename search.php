<?php
	include 'vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(__DIR__);
	$dotenv->load();
	// Local
	/*
	$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
	$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
	$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
	$dbName = $_ENV['DB_LOCAL_NAME'];
	*/
	// Online 
	
	$dbServername = $_ENV['DB_SERV_NAME']; 
	$dbUsername = $_ENV['DB_USERNAME'];
	$dbPassword = $_ENV['DB_PASSWORD'];
	$dbName = $_ENV['DB_NAME'];
		
	$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	include_once 'header.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible"
		content="IE=edge">
		 <meta name=viewport content="width=device-width, initial-scale=1">

	      <link rel="stylesheet" type="text/css" href="style.css">
	    <title>Search</title>
      </style>
	</head>

	<body>
		
		<section class="main-container">
  			<div class="main-wrapper">
			  <div class="background-color">
  				<p>
				    <button onClick="goBack()" class="btn btn-primary">
				      <span class="glyphicon glyphicon-search"></span> Search
				    </button>
					<script type="text/javascript">
						function goBack() {
						  window.history.back();
						}
					</script> 
				</p>
  				<h2 style="color:#FFFFFF; font-size: 50px">Forum Search Query</h2>
  				<div class="posts" style="text-align:center; margin-top: 2rem;">
  				<?php
  					if (isset($_POST['submit-search'])) {
  						$search = mysqli_real_escape_string($conn, $_POST['search']);
  						$sql = "SELECT * FROM posts WHERE body LIKE '%$search%' OR posted_at LIKE '%$search%' OR username LIKE '%$search%' OR id LIKE '%$search%'";
  						$result = mysqli_query($conn, $sql);
  						$queryResult = mysqli_num_rows($result);

  						echo '<span style="color:#FFF;text-align:center;">There is/are '.$queryResult.' result/s!</span>';

  						$i=1;
  						if ($queryResult > 0) {
  							while ($row = mysqli_fetch_assoc($result)) {
  								echo '<br><hr><span style="color:#FFF;text-align:center;">' . htmlspecialchars($row["body"]) . ' <br>- ' . $row["username"] . ' '.$row["posted_at"].' (ID '.$row["id"].') - <span style="color:red">'.$row["hearts"].' HEARTS.</span></span>';
  							}
  						}
  						else {
  							echo "<span style='color:white'>There was no results matching your search!</span>";
  						}
  					}
  				?>
  				</div>
			  </div>
				</div>
  		</section>
		
	</body>
</html>









<?php
	include_once 'footer.php';
?>