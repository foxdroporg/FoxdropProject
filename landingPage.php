<?php
  include_once 'header.php';
?>

<!DOCTYPE html> 
<head>
  <title>Starting Page</title>
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" type="text/css" href="landingPage_css/style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://m.w3newbie.com/you-tube.css">
  <link href="landingPage_css/animate.css" rel="stylesheet"/>
  <link href="landingPage_css/waypoints.css" rel="stylesheet"/>
  <script src="landingPage_js/jquery.waypoints.min.js" type="text/javascript"></script>
  <script src="landingPage_js/waypoints.js" type="text/javascript"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:800|Poppins:500');

    html, body {
      margin: 0;
      padding: 0;
      height: 96vh; /* 96% */
      width: 100%; /* 100% */
    }
    .cursor {
      pointer-events: none;
      width: 20px;
      height: 20px;
      border: 1px solid white;
      border-radius: 50%;
      position: absolute;
      transition-duration: 30ms;
      transition-timing-function: ease-out;
    }
    .cursor::after {
      content: "";
      width: 20px;
      height: 20px;
      position: absolute;
      border: 8px solid grey;
      border-radius: 50%;
      opacity: .5;
      top: -8px;
      left: -8px;
    }
    @keyframes cursorAnim3 {
      0% {
        tranform: scale(1);
      }
      50% {
        transform: scale(3);
      }
      100% {
        transform: scale(1);
        opacity: 0;
      }
    }
    .expand {
      animation: cursorAnim3 .5s forwards;
      border: 1px solid red;
    }
    .intro {
      height: 100%;
      width: 100%;  
      margin: auto;
      background: url(images/forest.jpg) no-repeat 50% 50%;
        background-size:cover;
        display: table;
        top: 0;
    }
    .intro .inner {
      display: table-cell;
      vertical-align: middle;
      text-align: center;
      padding-bottom: 20%;
    }
    .content h1 {
      font-family: 'Open Sans', sans-serif;
      color: #f9f3f4;
      font-size: 550%;
      text-shadow: 3px 3px #098fa8;
    }
    .btn {
      font-size: 150%;
      font-family: 'Poppins', sans-serif;
      text-decoration: none;
      color: #098fa8;
      border: 2px solid #098fa8;
      padding: 10px 20px;
      border-radius: 5px;
    }
    .btn:hover {
      color: #156377;
      border: 2px solid #156377;
    }
    @media (max-width: 768px) {
      .content h1 {
        font-size: 300%;
      }
      .btn {
        font-size: 110%;
        padding: 7px 15px;
      }
    }
    canvas {
      position: absolute;
      z-index: -1px;
      left: 0px;
      /*display: none;*/ 
    }

    /*  */
  </style>
</head>
<body>
  <!-- Cursor Particles-->
  <script src="landingPage_js/sketch.min.js"></script>
  <script src="landingPage_js/cursorParticles.js"></script>
  <section class="intro" style="height: 93vh"> <!-- 900px -->
    <div class="cursor"></div>
    <div class="inner">
      <div class="content">
        <section class="os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.3s"> <!-- 0.1 -->
          <h1>FOXDROP</h1>
        </section>  
        <br><br>
        <section class="os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.7s" style="margin: 0 auto; width: 200px"> <!-- 0.4 --> 
          <a class="btn" href="./signup.php">SIGN UP</a>
        </section>        
      </div>
    </div>

    <!-- Custom Cursor -->
    <script>
      const cursor = document.querySelector('.cursor');
      document.addEventListener('mousemove', e => {
        cursor.setAttribute("style", "top:"+(e.pageY - 10)+"px; left:"+(e.pageX - 10)+"px;")
      });
      document.addEventListener('click', () => {
        cursor.classList.add("expand");
        setTimeout(() => {
          cursor.classList.remove("expand");
        }, 500);
      });
    </script>

    

  </section>





</body>
</html>


<?php
  include_once 'footer.php';
?>