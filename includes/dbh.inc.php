<?php

// If we want to use online server we need to figure out the real servername!
$dbServername = "localhost";	

$dbUsername = "root";

$dbPassword = "";

$dbName = "loginsystem";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);