<?php
    include_once 'header.php';
?>

   <head>
    <meta charset="UTF-8">
     <title>Lava</title>

    <div style="width:1000px color:white">
        <!-- <img src="../images/rain.png" alt="4thGame" style="width:100%; height:70%; "> -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/p5.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.dom.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.sound.min.js"></script>
        <script type="text/javascript" src="rain.js"></script>
    </div>
    <style>
        body, html {
          background-position:center;
          background-image: url("../images/rain.png");
          background-size:cover;
          background-repeat:no-repeat;
          background-attachment:fixed;
          overflow: none;
          height: 100%;
          margin: 0;
        }
      </style>
  </head>
  


<?php
	include_once 'footer.php';
?>