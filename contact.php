<?php
    include_once 'header.php';
?>



<section class="main-container">
  <div class="main-wrapper">

    <head>
      <meta charset="utf-8">
      <meta name=viewport content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700">
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
      <h2 style="color:#FFFFFF">Contact</h2>
        <br>
        <br>
      <div style="color:white; position: relative;"> 
        <div class="header" style="color:white; position: absolute; left: 10px bottom: 20px"> 
        You can reach us at: <br> foxdrop.contact@gmail.com
        </div>
      <br>
      <br>
      <br>
      <br>
      <br>

      
      <p style="color:orange"><b>SEND E-MAIL<b></p>
        <br>
      <form class="contact-form" action="contactform.php" method="post">
        <input type="text" name="name" placeholder="Fullname">
        <input type="text" name="mail" placeholder="Your e-mail">
        <input type="text" name="subject" placeholder="Subject">
        <textarea name="mesage" placeholder="Message"></textarea>
        <button type="submit" name="submit">SEND MAIL</button>
        
        
      </form>
      
    
    </body>
  </div>
</section>
  




<?php
	/*
	<section class="main-container">
		<div class="row">
			<div class="column">
					    <img src="images/cartoonish.jpg" alt="1stGame" style="width:150%; height:150%">
			</div>
		</div>
	</section>
	*/
	include_once 'footer.php';
?>