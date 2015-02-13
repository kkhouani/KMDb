<?php

include ("connection.php");

global $connection;

$search = mysqli_real_escape_string($connection, $_GET['search']);
 
$query = "SELECT director_movie FROM movieDatabase WHERE actors_movie LIKE '%$search%'";
$result = mysqli_query($connection, $query);

$moviedirectors = array();
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['director_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($moviedirectors, $item);
      	}
    	}
}

$moviedirectors = array_unique($moviedirectors);
sort($moviedirectors);

?>

<select>
	<?php if (sizeof($moviedirectors) > 0) { ?> 
		<?php foreach ($moviedirectors as $director) { ?>
			<option class="filterresult"><?=$director?></option>
		<?php } ?>
	<?php } else { ?> 
	  <option class="filterresult">No Directors</option>
	<?php } ?> 
</select>