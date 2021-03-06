<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<title>Crawl only movies</title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
<div id="site-wrapper">

<?php

$request = "https://www.kimonolabs.com/api/abewqxu4?apikey=mS26wTFQFru3A8ICmwq3m7R4f1bOgrjr";
$response = file_get_contents($request);
$results = json_decode($response, TRUE);

global $connection;

// $max_items = maximaal aantal items
// die op pagina getoond wordt
$counter	= 0;
$max_items 	= 10;

// Door elke film / serie heen
foreach ( $results['results']['movieDatabase'] as $value ) {
	if ( $counter < $max_items ) {
		// URL Variable
		$url_movie 		= $value['movieTitle']['href'];
		$title_movie	= addslashes($value['movieTitle']['text']);				
		$id_movie			= substr($url_movie, -10, 9);

		// Checken of uit de functie false komt. Zo ja dan voer de rest uit
		if (!checkIfExists($url_movie)) {
				// Overige variabelen
				$year_movie 	= $value['releaseYear'];
				$user_rating 	= $value['myRating'];
				$imdb_rating 	= $value['imdbRating']; 
				$date_rating 	= $value['dateRating'];
				$type_movie		= $value['movieType'];

				// $data = file_get_contents('http://www.omdbapi.com/?i=' .$id_movie);
				$url = 'http://www.omdbapi.com/?i=' .$id_movie;
				$ch = curl_init();
		    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

		    $data = curl_exec($ch);
		    $data = json_decode($data, true);
		    curl_close($ch);

				$image = addslashes($data['Poster']);
				$description_movie = addslashes($data['Plot']);
				$runtime_movie = addslashes($data['Runtime']);
				$genre_movie = addslashes($data['Genre']);
				$director_movie = addslashes($data['Director']);
				$actors_movie = addslashes($data['Actors']);

				// Image ophalen en omzetten naar base64 binary code
				// aangezien het niet mogelijk is om direct naar een image van imdb te linken...
				$image_type = pathinfo($image, PATHINFO_EXTENSION);
				$image_data = file_get_contents($image);
				$image_movie = 'data:image/' . $image_type . ';base64,' . base64_encode($image_data);

				// Plaats film in de database
				$query = "INSERT INTO movieDatabase (title_movie, url_movie, year_movie, user_rating, imdb_rating, date_rating, type_movie, image_movie, runtime_movie, genre_movie, director_movie, actors_movie, description_movie)
				VALUES ('".$title_movie."', '$url_movie', '$year_movie', '$user_rating', '$imdb_rating', '$date_rating', '$type_movie', '$image_movie', '$runtime_movie', '$genre_movie', '$director_movie', '$actors_movie', '$description_movie')";

				if (mysqli_query($connection, $query)) {
				    echo "New record created successfully<br/>";

				} else {
				    echo mysqli_error($connection);
				}

				// Film/Serie tonen op webpagina, hieronder dus eigen stijl toepassen
				echo '<div class="movie">';
					echo '<img class="movieposter" src="' .$image_movie. '" width="50px"/>';
					echo '<div class="movieinfo">';
						echo '<h2><a href="' . $url_movie . '" alt="" target="_blank">' . $title_movie . '</a></h2><br/>';
						echo $description_movie. '<br/><br/>';
						echo 'Directed by ' . $director_movie .  '<br/>';
						echo 'Cast: ' . $actors_movie . '<br/>';
						echo '<br/>';
						echo 'Movietype: ' . $type_movie . '<br/>';
						echo 'Genre: ' . $genre_movie . '<br/>';
						echo 'Runtime: ' . $runtime_movie . '<br/>';
						echo 'Year: ' . $year_movie . '<br/>';
						echo '<br/>';
						echo 'My rating: ' . $user_rating . '<br/>';
						echo 'iMDB rating: ' . $imdb_rating . '<br/>';
						echo 'Rated ' . $date_rating .  '<br/>';
						echo '<br/>';
					echo '</div>';
				echo '</div>';
		} else {
			echo "De film <b>".$title_movie."</b> bestaat al in de database!<br />";
		}
		$counter++;
	}
}

function checkIfExists($url_movie) {
	// global plaatsen om connectie variablen aan te roepen van andere functie
	global $connection;
	$query = mysqli_query($connection, "SELECT url_movie FROM movieDatabase WHERE url_movie = '".$url_movie."' ");
	if ($query === false){
		// echo error
		echo mysqli_error($connection);
	} else {
		// tel aantal rijen van query
		$num_rows = mysqli_num_rows($query);

		if ($num_rows > 0) {
			return true;
		}
		else {
			return false;
		}
	}
}

// sluit connectie
mysqli_close($connection);

?>
</div>
</body>
</html>