<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shie_special';

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

//connect database
$conn = mysqli_connect($host, $username, $password, $dbname);


//check if the connection was successful
if (!$conn) {
    die("Connection Failed" . mysqli_connect_error());
}

//
include_once "function.php";

//start a new session
session_start();

// Include sql_utilities.php file
include_once "sql_utilities.php";
