<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
  <div class="background-color">
			<?php
				if (isset($_SESSION['u_id'])) {
          echo '<h2 id="welcome" style="color:#FFFFFF">Welcome to Foxdrop</h2>';
					echo '<br><div style="text-align:center"><span style="color:green; font-size:25px">You are logged in!</span></div>';
				}
				else if (isset($_GET['status'])){
          if($_GET['status'] === 'loggedout') {
            echo '<h2 id="welcome" style="color:#FFFFFF">We hope you´ll visit us again soon</h2>';
            echo '<br><div style="text-align:center"><span style="color:red; font-size:25px">You are logged out.</span></div>';
				  }
        }
        else {
          echo '<h2 id="welcome" style="color:#FFFFFF">Looks like there has been a typo!</h2>';
          echo '<br><div style="text-align:center"><span style="color:red; font-size:25px">Login failed.</span></div>';
        }
			?>
  </div>
  </div>
</section>

<?php 
  if (isset($_SESSION['u_id'])) { // Could add this to show highscore tables at log out as well>>>     || isset($_GET['status'])
?>
  <section class="main-container">
  <div class="main-wrapper">
    <div class="background-color">
      <h2 style="color:#FFFFFF; font-size: 50px">Highscore Tables</h2>
      <br>
      <?php
        include 'vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::create((__DIR__));
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

        function getHighscorePoints($sql, $conn) {
          $result = mysqli_query($conn, $sql);

          $data = array();
          $uniqueUsername = array();
          while ($row = mysqli_fetch_row($result)) {
            if(!in_array($row[0], $uniqueUsername)) {
              $uniqueUsername[] = $row[0];
              $data[] = $row;
            }
          }
          $iteration = 0;
          $color = array("#ffd600", "#C0C0C0", "#cd7f32");
          foreach ($data as &$value) {
            if($iteration==3) {
              return;
            }
            echo '<center><span style="color:'.$color[$iteration].';text-align:center;">'.($iteration+1).'. '. $value[0] . ' - ' . $value[1] . ' points</span></center>';
            $iteration++;
          }
        }

        $sql = "SELECT * FROM scores WHERE game = 'typetosurviveWPM' ORDER BY user_score DESC";
        echo '<center><span style="color:#FFF;text-align:center; font-size: 25px">Top words per minute: </span></center><br>';
        getHighscorePoints($sql, $conn);

        $sql = "SELECT * FROM scores WHERE game = 'typetosurvive' ORDER BY user_score DESC";
        echo '<br><center><span style="color:#FFF;text-align:center;font-size: 25px">Top scores in TypeToSurvive: </span></center><br>';
        getHighscorePoints($sql, $conn);

        $sql = "SELECT * FROM scores WHERE game = 'snake' ORDER BY user_score DESC";
        echo '<br><center><span style="color:#FFF;text-align:center;font-size: 25px">Top scores in Snake: </span></center><br>';
        getHighscorePoints($sql, $conn);

        $sql = "SELECT * FROM scores WHERE game = 'maze' ORDER BY user_score DESC";
        echo '<br><center><span style="color:#FFF;text-align:center;font-size: 25px">Top scores in Maze: </span></center><br>';
        getHighscorePoints($sql, $conn);

        $sql = "SELECT * FROM scores WHERE game = 'hitthelight' ORDER BY user_score DESC";
        echo '<br><center><span style="color:#FFF;text-align:center;font-size: 25px">Top scores in HitTheLight: </span></center><br>';
        getHighscorePoints($sql, $conn);
      ?>
    </div>
  </div>
</section>


<section class="main-container">
  <div class="main-wrapper">
  <div class="background-color">
    <?php
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
      echo '<p style="text-align: center"><span style="color:white;text-align:center;font-size:20px">' . $responseBody4 . '<br><br></span></p>';
    ?>
  </div>
  </div>
</section>


<?php
  }
	include_once 'footer.php';
?>
