<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
			<h2 style="color:#FFFFFF">Welcome to Foxdrop</h2>
			<?php
				if (isset($_SESSION['u_id'])) {
					echo '<br><div style="text-align:center"><span style="color:green; font-size:25px">You are logged in!</span></div>';
				}
				else {
					echo '<br><div style="text-align:center"><span style="color:red; font-size:25px">Login failed.</span></div>';
				}
			?>
	</div>

	<section class="main-container">
  <div class="main-wrapper">
    <h2 style="color:#FFFFFF; font-size: 50px">Latest News</h2>

    <p style="text-align: center">
      <span style="color:white; text-align:center; font-size: 30px"></span><br><br><br>

      <span style="color:white; font-size: 20px"><b>1.</b> </span><span id="com0" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>2.</b> <span id="com1" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>3.</b> <span id="com2" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>4.</b> <span id="com3" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>5.</b> <span id="com4" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
    </p>
  </div>

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
  </script>

</section>

<section class="main-container">
  <div class="main-wrapper">
    <?php
      require 'vendor/autoload.php';
      $dotenv = Dotenv\Dotenv::create(__DIR__);
      $dotenv->load();
      $API_KEY = $_ENV['RAPID_API_KEY'];

      $year = date("Y");
      $month = date("m");
      $day = date("d");
      $response4 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/".$month."/".$day."/date",
        array(
          "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
          "X-RapidAPI-Key" => $API_KEY
        )
      );
      $responseBody4 = $response4->body;
      $month = date("M");
      $day = date("d");
      echo '<h2 style="color:white;font-size:30px">Today\'s date in history ('.$month.' '.$day.')</h2><br><br>';
      echo '<p style="text-align: center"><span style="color:gold;text-align:center;font-size:20px">' . $responseBody4 . '<br><br></span></p>';
    ?>
  </div>
</section>


<?php
	include_once 'footer.php';
?>
