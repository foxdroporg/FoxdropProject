<?php
  include_once 'header.php';
?>

<!DOCTYPE html> 
<head>
  <title>Starting Page</title>
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
      height: 96%;
      width: 100%;
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
  </style>
</head>
<body>
  <section class="intro">
    <div class="inner">
      <div class="content">
        <section class="os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s">
          <h1>FOXDROP</h1>
        </section>  
        <br><br>
        <section class="os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.4s" style="margin: 0 auto; width: 200px">
          <a class="btn" href="./signup.php">SIGN UP</a>
        </section>        
      </div>
    </div>
  </section>





</body>
</html>


<?php
  include_once 'footer.php';
?>