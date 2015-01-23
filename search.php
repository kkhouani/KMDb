<?php

include ("connection.php");

global $connection;

$search = mysqli_real_escape_string($connection, $_GET['search']);
 
$query = "SELECT * FROM movieDatabase WHERE title_movie LIKE '%$search%'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
		echo '<span class="movietitle"><a href="'.$row['url_movie'].'">' .$row['title_movie']. '</a></span><br/>';
  }
} else {
  echo "0 results";
}
?>