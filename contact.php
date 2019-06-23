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
      <h2 style="color:#FFFFFF; font-size: 50px">Contact</h2>
        <br>
        <br>
      <div style="color:white; position: relative;"> 
        
        <div class="header" style="color:white; position: absolute; left: 10px bottom: 20px"> 
        You can reach us at: <br> <p style="color:orange">foxdrop.contact@gmail.com</p>
        </div>

      <br>
      <br>
      <br>
      <br>
      <br>

      
      <p style="color:white"><b>SEND E-MAIL<b></p>
        <br>
      <form class="contact-form" action="includes/contact.inc.php" method="post">
        <input type="text" name="name" placeholder="Fullname">
        <input type="text" name="mail" placeholder="Your e-mail">
        <input type="text" name="subject" placeholder="Subject">
        <textarea name="message" placeholder="Message"></textarea>
        <button type="submit" name="submit">SEND MAIL</button>
      </form>

      <?php
        if (isset($_GET["contact"])) {
          if ($_GET["contact"] == "mailWasSent") {
            echo '<p class"signupsuccess" style="color:green; font-size:20px; text-align: center; padding-top: 3%">Mail has been sent!</p>';
          } 
          else if ($_GET["contact"] !== "mailWasSent") {
            echo '<p class"signupsuccess" style="color:red; font-size:20px; text-align: center; padding-top: 3%">Mail has not been sent. <br> No empty fields or invalid e-mails are allowed!</p>';
          }
        }
      ?>
    </body>
  </div>
</section>


<?php
	include_once 'footer.php';
?>