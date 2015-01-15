<?php 
function getFormData(){
    global $connection;
    //define array empty
    $array = [];

    // Haal alle genre's op uit movieDatabase
    $query = "SELECT genre_movie FROM movieDatabase";
    $result = mysqli_query($connection, $query);
    $moviegenres = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['genre_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($moviegenres, $item);
      	}
    	}
    }

    // Haal alle movietypes uit movieDatabase
    $query = "SELECT type_movie FROM movieDatabase";
    $result = mysqli_query($connection, $query);
    $movietypes = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['type_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($movietypes, $item);
      	}
    	}
    }	

    // Haal alle acteurs uit movieDatabase
    $query = "SELECT actors_movie FROM movieDatabase";
    $result = mysqli_query($connection, $query);
    $movieactors = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['actors_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($movieactors, $item);
      	}
    	}
    }

    // Haal alle regisseurs uit movieDatabase
    $query = "SELECT director_movie FROM movieDatabase";
    $result = mysqli_query($connection, $query);
    $moviedirectors = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['director_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($moviedirectors, $item);
      	}
    	}
    }

    // Haal alle jaartallen uit movieDatabase
    $query = "SELECT year_movie FROM movieDatabase ORDER BY year_movie ASC";
    $result = mysqli_query($connection, $query);
    $movieyears = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['year_movie']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($movieyears, $item);
      	}
    	}
    }

    // Haal alle userratings uit movieDatabase
    $query = "SELECT user_rating FROM movieDatabase ORDER BY user_rating ASC";
    $result = mysqli_query($connection, $query);
    $userrating = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['user_rating']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($userrating, $item);
      	}
    	}
    }

    // Haal alle imdbratings uit movieDatabase
    $query = "SELECT imdb_rating FROM movieDatabase ORDER BY imdb_rating ASC";
    $result = mysqli_query($connection, $query);
    $imdbrating = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	$temp = explode(', ', $row['imdb_rating']);
      	foreach($temp as $item) {
      		// haalt unieke waardes uit de array
      		array_push($imdbrating, $item);
      	}
    	}
    }

    // Haal alle imdbratings uit movieDatabase
    $query = "SELECT runtime_movie FROM movieDatabase ORDER BY runtime_movie ASC";
    $result = mysqli_query($connection, $query);
    $runtimemovie = array();
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      	// array binnenhalen en exploden, in var
      	if ($row['runtime_movie'] == "N/A") {
      		continue;
      	}
    	  	$runtime_withoutmin = substr($row['runtime_movie'], 0, -4);
      		array_push($runtimemovie, $runtime_withoutmin);
      	}
    }

    /* VARIABLES */

    // plaats unieke genre in form
    $genre = array_unique($moviegenres);

    // plaats unieke type in form
    $type = array_unique($movietypes);

    // plaats unieke movietype in form
    $actor = array_unique($movieactors);
    sort($actor);

    // plaats unieke movietype in form
    $director = array_unique($moviedirectors);
    sort($director);

    // plaats unieke jaartallen in form
    $year = array_unique($movieyears);
    $lowest_year = min($year);
    $highest_year = max($year);

    // plaats unieke userratings in form
    $myrating = array_unique($userrating);
    $minrating = min($myrating);
    $maxrating = max($myrating);

    // plaats unieke imdbratings in form
    $imdb = array_unique($imdbrating);
    $imdb_lowest_rating = min($imdb);
    $imdb_highest_rating = max($imdb);

    // plaats unieke imdbratings in form
    $runtime = array_unique($runtimemovie);
    sort($runtime);
    $minruntime = min($runtime);
    $maxruntime = max($runtime);

    $array['genre'] = $genre;
    $array['type'] = $type;
    $array['actor'] = $actor;
    $array['director'] = $director;
    $array['year'] = $year;
    $array['lowest_year'] = $lowest_year;
    $array['highest_year'] = $highest_year;
    $array['minrating'] = $minrating;
    $array['maxrating'] = $maxrating;
    $array['imdb_lowest_rating'] = $imdb_lowest_rating;
    $array['imdb_highest_rating'] = $imdb_highest_rating;
    $array['runtime'] = $runtime;
    $array['minruntime'] = $minruntime;
    $array['maxruntime'] = $maxruntime;

    return $array;
}

?>