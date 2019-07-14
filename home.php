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
	<!-- Parallax Scrolling -->
	<style type="text/css">
    body, html{
      height:100%;
      margin:0;
      font-size:16px;
      font-family:"Lato", sans-serif;
      font-weight:400;
      line-height:1.8em;
      color:#666;
    }
        .pimg1, .pimg2, .pimg3{
      position:relative;
      opacity:1.00;
      background-position:center;
      background-size:cover;
      background-repeat:no-repeat;

      /*
        fixed = parallax
        scroll = normal
      */
      background-attachment:fixed;
    }

    .pimg1{
      background-image:url('images/image1.jpg');
      min-height:100%;
    }

    .pimg2{
      background-image:url('images/image2.jpg');
      min-height:400px;
    }

    .pimg3{
      background-image:url('images/image3.jpg');
      min-height:400px;
    }

    .section{
      text-align:center;
      padding:50px 80px;
    }

    .section-light{
      background-color:#f4f4f4;
      color:#666;
    }

    .section-dark{
      background-color:#282e34;
      color:#ddd;
    }

    .ptext{
      position:absolute;
      top:50%;
      width:100%;
      text-align:center;
      color:#000;
      font-size:27px;
      letter-spacing:8px;
      text-transform:uppercase;
    }

    .ptext .border{
      background-color:#111;
      color:#fff;
      padding:20px;
    }

    .ptext .border.trans{
      background-color:transparent;
    }

    @media(max-width:568px){
      .pimg1, .pimg2, .pimg3{
        background-attachment:scroll;
      }
    }

		hr {
			width: 100%;
			height: 4px;
			margin-left: auto;
			margin-right: auto;
			background-color:#FFFFFF;
			border: 0 none;
			margin-top: 100px;
			margin-bottom: 0px;
		}

  </style>
</head>

<body>
<section class="main-container">
	<div class="main-wrapper">
		<h2 style="color:#FFFFFF; font-size: 50px">Latest News</h2>

		<p style="text-align: center">
			<span style="color:white; text-align:center; font-size: 30px"></span><br><br><br>

			<span id="com0" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com1" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com2" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com3" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
			<span id="com4" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
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

			$month = date("m");
			$day = date("d");
			$response4 = Unirest\Request::get("https://numbersapi.p.rapidapi.com/".$month."/".$day."/date",
			  array(
			    "X-RapidAPI-Host" => "numbersapi.p.rapidapi.com",
			    "X-RapidAPI-Key" => $API_KEY
			  )
			);
			$responseBody4 = $response4->body;
			echo '<h2 style="color:white;font-size:30px">Today\'s date in history</h2><br><br>';
			echo '<p style="text-align: center"><span style="color:gold;text-align:center;font-size:20px">' . $responseBody4 . '<br><br></span></p>';
		?>
	</div>
</section>
<hr>


<div class="pimg1">
    <div class="ptext">
      <span class="border">
        1. Sign Up

      </span>
    </div>
  </div>

  <section class="section section-light">
    <h2>Signing Up Gives You Access To:</h2>
    <p>
      A profile page with all your personal information, together with statistics of your best scores on games and best of all, exlusive content on this website.
    </p>
  </section>

  <div class="pimg2">
    <div class="ptext">
      <span class="border trans">
        2. Navigate To Portfolio
      </span>
    </div>
  </div>

  <section class="section section-dark">
    <h2>Portfolio Is Provided With:</h2>
    <p>
      Classic games that you know and love, animations that will blow you away, web-applicaitons that you wish you knew about earlier and much more!
    </p>
  </section>

  <div class="pimg3">
    <div class="ptext">
      <span class="border trans">
        3. Take Part Of The Games, Animations and Web-Applicaitons
      </span>
    </div>
  </div>

  <section class="section section-dark">
    <h2>What Else Needs To Be Said:</h2>
    <p>
      The two games Snake and Maze are incorporated with a highscore system that remembers your scores forever. Go and explore, we have come a long way now. There is too much material created to see it all in one sitting, so click on what looks exciting and have fun! Like this website on Facebook if you are comfortable with doing so. 
    </p>
  </section>

  <div class="pimg1">
    <div class="ptext">
      <span class="border">
        Foxdrop
      </span>
    </div>
  </div>
</body>
</html>





<?php
include_once 'footer.php';
?>
