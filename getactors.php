<?php

include ("connection.php");

global $connection;

$search = mysqli_real_escape_string($connection, $_GET['search']);
 
$query = "SELECT actors_movie FROM movieDatabase WHERE type_movie LIKE '%$search%'";
$result = mysqli_query($connection, $query);

$movieactors = array();
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['actors_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($movieactors, $item);
      	}
    	}
}

$movieactors = array_unique($movieactors);
sort($movieactors);

// Haal alle acteurs uit movieDatabase
$original_query = "SELECT actors_movie FROM movieDatabase";
$original_result = mysqli_query($connection, $original_query);

$actorslist = array();
if (mysqli_num_rows($original_result) > 0) {
  while($row = mysqli_fetch_assoc($original_result)) {
  	// array binnenhalen en exploden, in var
  	$temp = explode(', ', $row['actors_movie']);
  	foreach($temp as $item) {
  		// haalt unieke waardes uit de array
  		array_push($actorslist, $item);
  	}
	}
}

$actorslist = array_unique($actorslist);
sort($actorslist);

?>

<select>
	<?php if (sizeof($movieactors) > 0) { ?> 
		<?php foreach ($movieactors as $actors) { ?>
			<option class="filterresult"><?=$actors?></option>
		<?php } ?>
	<?php } else { ?> 
			<?php foreach ($actorslist as $all_actors) { ?>
	  <option class="filterresult"><?=$all_actors?></option>
		  <?php } ?>
	<?php } ?> 
</select>