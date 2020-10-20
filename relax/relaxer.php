<?php
    include_once 'header.php';
?>

<head>
    <meta charset="UTF-8">
     <title>Relaxer</title>

    <div style="width:1000px color:white">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/p5.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.dom.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.sound.min.js"></script>
        <script type="text/javascript" src="rain.js"></script>
    </div>
    <link rel="stylesheet" type="text/css" href="relaxer.css">
    <style>
        body, html {
          background-position:center;
        background-image: url("../images/relaxer.png");
          background-size:cover;
          background-repeat:no-repeat;
          background-attachment:fixed;
          overflow: none;
          height: 100%;
          margin: 0;
        }
      </style>
  </head>

  <body>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
      <div class="container">

      <div class="circle"></div>

      <p class="text">Breathe In!</p>

      <div class="pointer-container">
          <div class="pointer"></div>
        </div>

        <br/>
        <div class="gradient-circle"></div>
      </div>
      <script src="relaxer.js"></script>
      
  </body>



<?php
	include_once 'footer.php';
?>