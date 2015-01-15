<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "movie_db";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$search = mysqli_real_escape_string($connection, $_GET['search']);
 
$query = "SELECT * FROM movieDatabase WHERE title_movie LIKE '%$search%'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
		echo '<span class="movietitle">' .$row['title_movie']. '</span><br/>';
  }
} else {
  echo "0 results";
}
?>