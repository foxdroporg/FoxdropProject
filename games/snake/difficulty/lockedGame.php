<?php # session_start(); ?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible"
            content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" type="image/png" href="../../../images/firefoxLogo.png">
            <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
            <title>Snake</title>
            <style>
                body {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: #202020;
                }
                .endgame {
                    display: none;
                    width: 200px;
                    top: 25%;
                    background-color: rgba(205, 133, 63, 0.8);
                    position: absolute;
                    left: 50%;
                    margin-left: -100px;
                    padding-top: 50px;
                    padding-bottom: 50px;
                    text-align: center;
                    border-radius: 5px;
                    color: white;
                    font-size: 20px;
                }
                .draw-player {
                    background-color: <?php echo $_GET['snake']; ?>;
                }
                .draw-point {
                    background-color: <?php echo $_GET['food']; ?>;
                }
            </style>
            <script
                src="https://code.jquery.com/jquery-3.3.1.slim.js"
                integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
                crossorigin="anonymous"></script>
        </head>

        <body bgcolor="#202020">
            <script>
                var U_UID = "<?php if(isset($_SESSION['u_uid'])) echo $_SESSION['u_uid']; else echo "false"; ?>";
            </script>

            <script src="locked.js"></script>
            
            <section class="main-container">
            <div class="main-wrapper">

                <table id="game-area" align="center"></table>
                <div class="endgame">
                <div class="text">
                </div>
                <button onClick="reloadPage()">Play Again</button>
                </div>

                <p id="game-status" align="center"> <font color="green">Good luck!</font></p>
                <p class="game-score" align="center"> <font color="green">Your score is:</font> <span id="game-score" style="color: lightgreen"></span></p>

                <div style="color:white; text-align: center; padding: 5%; font-size: 25px;" id="highscoreTable"></div>
                </div>
            </section>
        </body>
    </html>

