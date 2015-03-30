<?php 

$servername = "db.storyfighters.nl";
$username = "md296944db323970";
$password = "wnVw9tI8";
$dbname = "md296944db323970";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>