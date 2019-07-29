<?php
  include 'vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::create(__DIR__);
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

  include_once 'header.php';
?>

<section class="main-container">
  <div class="main-wrapper">

    <head>
      <meta charset="utf-8">
      <meta name=viewport content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700">
      
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script src="https://kit.fontawesome.com/dd01eeee16.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" type="text/css" href="style.css">

      <style>
         /* Style buttons */
        .btn {
          background-color: black; /* Blue background */
          border: none; /* Remove borders */
          color: white; /* White text */
          cursor: pointer; /* Mouse pointer on hover */
        }

        /* Darker background on mouse-over */
        .btn:hover {
          background-color: white;
        } 
      </style>
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

      
      <p style="color:white"><b>SEND E-MAIL</b></p>
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

<section class="main-container">
  <div class="main-wrapper">
    <h2 style="color:#FFFFFF; font-size: 50px">Forum</h2>
    <br>
    <br>
    <?php 
      if(isset($_SESSION['u_uid'])) {
    ?>
      <form class="contact-form" action="includes/contactPost.inc.php" method="post">
        <textarea name="postbody" rows="6" cols="80" placeholder="Message..."></textarea>
        <button type="submit" name="post">POST</button>
        <input type="hidden" name="username" value="<?php echo $_SESSION['u_uid']; ?>" />
      </form>
    <?php
      }
      else {
        echo '<p style="color:red; font-size:20px; text-align: center; padding-top: 3%">Login is required to post anything on this forum.</p>';
      }
    ?>


    <div class="posts" style="text-align:center; margin: 2rem;">
      <?php
        $dbposts = "SELECT * FROM posts";
        $posts = mysqli_query($conn, $dbposts);
        
        $data = array();
        while ($row = mysqli_fetch_row($posts)) {
          $data[] = $row;
        }

        $i=1;
        foreach (array_reverse($data) as &$value) {
            echo '<br><hr><span style="color:#FFF;text-align:center;">' . htmlspecialchars($value[1]) . ' <br>- ' . $value[3] . ' '.$value[2].' (ID '.$value[0].') - <span style="color:red">'.$value[4].' HEARTS.</span></span>';

            $postid = $value[0];
            $username = $value[3];
            $dbposts = "SELECT username FROM postshearts WHERE post_id='$postid' AND username='$username'";
            $posts = mysqli_query($conn, $dbposts);
            $sqlUsername = '';
            while ($row = mysqli_fetch_row($posts)) {
              $sqlUsername = $row;
            }
            
            if (isset($_SESSION['u_uid']) && !isset($sqlUsername[0])) {
              echo '<form action="includes/contactHeart.inc.php" method="post">
                      <button class="btn" type="submit" name="post" value="Heart"><i class="fas fa-heart fa-2x" style="color:red"></i></button>
                      <input type="hidden" name="postid" value='.$value[0].' />
                      <input type="hidden" name="username" value='.$value[3].' />
                    </form>';
            }
            $i++;
            if($i > 20) {
              break;
            }
        }


      ?>
    </div>

  </div>
</section>






<?php
	include_once 'footer.php';
?>