<?php
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
$dotenv->load();

// Local
/*
$dbServername = $_ENV['DB_LOCAL_SERV_NAME']; 
$dbUsername = $_ENV['DB_LOCAL_USERNAME'];
$dbPassword = $_ENV['DB_LOCAL_PASSWORD'];
$dbName = $_ENV['DB_LOCAL_NAME'];
*/
// Public

$dbServername = $_ENV['DB_SERV_NAME']; 
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
