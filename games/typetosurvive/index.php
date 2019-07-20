<link rel="shortcut icon" type="image/png" href="../../images/firefoxLogo.png">
<?php session_start(); ?>

<section class="main-container">
	<div class="main-wrapper">
		<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<meta http-equiv="X-UA-Compatible"
					content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
					<!––<link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
				    <title>Type To Survive</title>

				    <style>
				    	body {
				    		display: flex;
				    		align-items: center;
				    		justify-content: center;
				    		background: #202020;
                        }
				    </style>
				    <script>
				    	var U_UID = "<?php if(isset($_SESSION['u_uid'])) echo $_SESSION['u_uid']; else echo "false"; ?>";
				    </script>

				    <script
					  src="https://code.jquery.com/jquery-3.3.1.slim.js"
					  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
					  crossorigin="anonymous"></script>

					<!–– <script src="main.js"></script>  
				</head>
                                
				<body bgcolor="#202020">
					<header class="bg-dark text-center text-white p-3 mb-5">
						<h1>Type To Survive</h1>
					</header>
					
					<h1 style="color:#FFFFFF; text-align:center">Difficulty</h1>
					<br>
                    <div style="text-align:center">
                        <form class="signup-form" action="index.html">
                            <button type="submit" class="btn-success btn-lg" name="difficulty" value="easy">Easy</button>
                        </form>
                        <form class="difficulty-form" action="index.html">
                            <button type="submit" class="btn-warning btn-lg" name="difficulty" value="medium" style="color:white">Medium</button>
                        </form>
                        <form class="difficulty-form" action="index.html">
                            <button type="submit" class="btn-danger btn-lg" name="difficulty" value="insane">Insane</button>
                        </form>
                    </div>

					 <!-- Instructions -->
                     <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="card card-body bg-dark text-white">
                            <h5 style="text-align:center">Instructions</h5>
                            <p>Type each word in the given amount of seconds to score. To play again, just type the current word. Your score
								will reset. 
							</p>
							<p style="text-align:center"> Easy: 5 sec <br>
								Medium: 3 sec <br>
								Insane: 1 sec
							</p>
                            </div>
                        </div>
                    </div>

                    <div style="color:white; text-align: center; padding: 5%; font-size: 25px;" id="highscoreTable"></div>


				</body>
			</html>
	</div>
</section>
