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

    .link
    {
       color:white;
       text-decoration: none; 
       background-color: none;
    }

    .pimg1, .pimg2, .pimg3, .pimg4{
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
      min-height:60%;
    }

    .pimg3{
      background-image:url('images/image3.jpg');
      min-height:60%;
    }

    .pimg4{
      background-image:url('images/image5.jpg');
      min-height:100%;
    }

    .section{
      text-align:center;
      padding:50px 80px;
    }

    .section-light{
      background-color:#01050e;
      color:#ddd;
    }

    .section-dark{
      background-color:#01050e;
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
      color:#fff;
      padding:20px;
    }

    .ptext .border.trans{
      background-color:transparent;
    }

    @media(max-width:568px){
      .pimg1, .pimg2, .pimg3, .pimg4{
        background-attachment:scroll;
      }
    }

		hr {
			width: 100%;
			height: 4px;
			margin-left: auto;
			margin-right: auto;
			background-color: #051125; <!-- #FFFFFF -->
      color: #26012c;
      border: 0; border-top: 1px solid #26012c;
			margin-top: 100px;
			margin-bottom: 0px;
		}

  </style>
</head>

<body>

<section class="main-container">
  <div class="main-wrapper">
    <div class="background-color">
    <h2 style="color:#FFFFFF; font-size: 50px">Latest News</h2>

    <p style="text-align: center">
      <span style="color:white; text-align:center; font-size: 30px"></span><br>

      <span style="color:white; font-size: 20px"><b>1.</b> </span><span id="com0" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>2.</b> <span id="com1" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>3.</b> <span id="com2" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <!-- Three News items are enough -->
      <!-- <span style="color:white; font-size: 20px"><b>4.</b> <span id="com3" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br>
      <span style="color:white; font-size: 20px"><b>5.</b> <span id="com4" style="color:gold; text-align:center; font-size: 20px"></span> <br><br><br> -->
    </p>

  <script type="text/javascript">
    let mobileUser = false;
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      mobileUser = true;
    }
    async function getGithubCommits() {
      const response = await fetch('https://api.github.com/repos/ErikChHenriksson/FoxdropProject/commits');
      const data = await response.json();
      // The 5 latest commit messages from a repository.
      data[0] !== undefined ? document.getElementById('com0').textContent = data[0].commit.message : document.getElementById('com0').textContent = "";
      data[1] !== undefined ? document.getElementById('com1').textContent = data[1].commit.message : document.getElementById('com1').textContent = "";
      data[2] !== undefined ? document.getElementById('com2').textContent = data[2].commit.message : document.getElementById('com2').textContent = "";
      //data[3] !== undefined ? document.getElementById('com3').textContent = data[3].commit.message : document.getElementById('com3').textContent = "";
      //data[4] !== undefined ? document.getElementById('com4').textContent = data[4].commit.message : document.getElementById('com4').textContent = "";
      
    }
    getGithubCommits()
      .then(response => {
        console.log('Fetch successful!');
      })
      .catch(error => {
        console.error(error);
      });
  </script>
    </div>
  </div>
</section>

<hr>


<div class="pimg1">
    <div class="ptext">
      <span class="border">
        <a href="./signup.php">
          <div class="link">
            1. Sign Up
          </div>
        </a>
      </span>
    </div>
  </div>

  <section class="section section-light">
    <h2>Signing Up Gives You Access To:</h2>
    <p>
      A profile page with all your personal information, statistics of your high-scores in games and the website's forum to post in.
    </p>
  </section>

  <div class="pimg2">
    <div class="ptext">
      <span class="border trans">
        <a href="./portfolio.php">
          <div class="link">
            2. Navigate To Portfolio
          </div>
      </a>
      </span>
    </div>
  </div>

  <section class="section section-dark">
    <h2>Portfolio Is Provided With:</h2>
    <p>
      Classic games that you know and love, animations that will blow you away and web-applicaitons you wish you would have known about earlier!
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
      Enough with the reading, go and explore. Click on what looks exciting and have fun! 
    </p>
    <!-- The three games Snake, Maze and TTS are incorporated with a highscore system that remembers your scores forever. We have come a long way with this website now, go and explore. There is too much material created to see it all in one sitting, so click on what looks exciting and have fun! Like this website on Facebook if you are comfortable with doing so.   -->
  </section>

  <div class="pimg4">
    <div class="ptext">
      <span class="border">
        <a href="./home.php">
          <div class="link">
            Foxdrop
          </div>
        </a>
      </span>
    </div>
  </div>



<!-- <hr> -->

</body>
</html>





<?php
include_once 'footer.php';
?>
