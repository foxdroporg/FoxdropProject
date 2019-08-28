<?php
	include '../../../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::create(dirname(dirname(dirname(__DIR__))));
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
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible"
            content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
crossorigin="anonymous">
            <link rel="shortcut icon" type="image/png" href="../../images/firefoxLogo.png">
            <script src="https://kit.fontawesome.com/dd01eeee16.js"></script>
            <title>Snake</title>
            
            <style>
                body {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: #202020;
                }
                button {
                    cursor: pointer;
                }
            </style>

            <script
                src="https://code.jquery.com/jquery-3.3.1.slim.js"
                integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
                crossorigin="anonymous"></script>
        </head>

        <body bgcolor="#202020">
            <section class="main-container">
                <div class="main-wrapper">
                <header class="bg-dark text-center text-white p-3 mb-5">
                    <h1>Snake Exclusive</h1>
                </header>

                <h1 style="color:#FFFFFF; text-align:center">Options</h1>
                <br>
                <!-- Buttons -->
                <div style="text-align:center; width: 10em; margin:0px auto;">
                    <form class="difficulty-form" action="lockedGame.php">
                        <select type="submit" name="snake" class="btn-info btn-lg btn-block">
                            <option value="red">Red Snake</option>
                            <option value="DarkBlue">Blue Snake</option>
                            <option value="orange">Orange Snake</option>
                            <option value="pink">Pink Snake</option>
                        </select>
                        <select type="submit" name="background" class="btn-info btn-lg btn-block">
                            <option value="green">Green Background</option>
                            <option value="Aquamarine">Light Blue Background</option>
                            <option value="yellow">Yellow Background</option>
                            <option value="DarkMagenta">Purpule Background</option>
                        </select>
                        <select type="submit" name="walls" class="btn-info btn-lg btn-block">
                            <option value="black">Black Walls</option>
                            <option value="silver">Silver Walls</option>
                            <option value="gold">Gold Walls</option>
                            <option value="Peru">Bronze Walls</option>
                        </select>
                        <select type="submit" name="food" class="btn-info btn-lg btn-block">
                            <option value="Chartreuse">Grass Food</option>
                            <option value="Indigo">Space Food</option>
                            <option value="OrangeRed">Fruit Food</option>
                            <option value="Tomato">Tomato Food</option>
                        </select>
                        <br>
                        <button type="submit" class="btn-success btn-lg btn-block">Start</button>
                        <br>
                    </form>
                </div>

                <!-- Highscores -->
                <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="card card-body bg-dark text-white">
                            <h5 style="text-align:center;"><b>Highscores (Exclusive Snake)</b></h5>
	                            <p style="text-align:center"> 
									<?php
										$sql = "SELECT * FROM scores WHERE game = 'snakeExclusive' ORDER BY user_score DESC";
										$result = mysqli_query($conn, $sql);

										$data = array();
										$uniqueUsername = array();
										while ($row = mysqli_fetch_row($result)) {
											if(!in_array($row[0], $uniqueUsername)) {
												$uniqueUsername[] = $row[0];
												$data[] = $row;
											}
										}
										$iterations = 0;
										$color = array("#ffd600", "#C0C0C0", "#cd7f32");
										foreach ($data as &$value) {
											if($iterations == 15) {
												return;
											}
											if($iterations < 3) {
												echo '<span style="color:'.$color[$iterations].';text-align:center;">'.($iterations+1).'. ' . $value[0] . ' - ' . $value[1] . ' points</span>';
												echo "<br>";
											} else {
												echo '<span style="color:#FFF;text-align:center;">'.($iterations+1).'. ' . $value[0] . ' - ' . $value[1] . ' points</span>';
												echo "<br>";
											}
											$iterations++;
										}
									?>
								</p>
                            </div>
                        </div>
                    </div>

                
                </div>
            </section>
        </body>
    
        