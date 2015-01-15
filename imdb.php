<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<title>Kelkhouani Ratings IMDB</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
<div id="site-wrapper">

<?php
/***
**		Auteur: Davey Kropf
**/

// Data ophalen
$request 	= "https://www.kimonolabs.com/api/crpcanzg?apikey=8235e8944537d5842157cd2df503ef95";
$response 	= file_get_contents($request);
$data 		= json_decode($response, TRUE);

// $max_items = maximaal aantal items
// die op pagina getoond wordt
$counter	= 0;
$max_items 	= 15;

// Door elke film / serie heen
foreach ( $data['results'] as $value ) {
	foreach ( $value as $key ) {
		if ( $counter < $max_items ) {
			// Kijken of we geen data op gaan halen van een lege film/serie
			if ( strlen( $key['title'] > 0 ) ) {

				// Variabelen
				$title 			= $key['title']['text'];
				$url_movie 		= $key['title']['href'];
				$year_movie 	= substr($key['year'], 1, 4);	// De '(' en ')' teken weghalen van jaartal
				$user_rating 	= $key['rating'];
				$description 	= $key['description']; 
				$persons 		= $key['persons'];

				// IMDB image omzetten naar juiste formaat (250 pixels breed)
				$image			= $key['image'];
				$image 			= str_replace('V1._SY209_CR0,0,140,209_.jpg', 'V1_SX150.jpg', $image);
				$image 			= str_replace('V1._SY209_CR1,0,140,209_.jpg', 'V1_SX150.jpg', $image);
				$image 			= str_replace('V1._SX140_CR0,0,140,209_.jpg', 'V1_SX150.jpg', $image);

				// Image ophalen en omzetten naar base64 binary code
				// aangezien het niet mogelijk is om direct naar een image van imdb te linken...
				$image_type = pathinfo($image, PATHINFO_EXTENSION);
				$image_data = file_get_contents($image);
				$image_base64 = 'data:image/' . $image_type . ';base64,' . base64_encode($image_data);

				// Film/Serie tonen op webpagina, hieronder dus eigen stijl toepassen
				echo '<div class="imdb-item">';
				echo '<b><a href="' . $url_movie . '" alt="" target="_blank">' . $title . '</a></b><br/>';
				echo '<img src="' . $image_base64 . '" alt="' . $title . ' cover" /><br/>';
				echo 'Year: ' . $year_movie . ', rating: ' . $user_rating . '<br/>';
				echo $description . '<br/>';

				// Eerste persoon uit de lijst plaatsen we als 'director'
				echo 'Director: <a href="' . $persons[0]['href'] . '" alt="" target="_blank">' . $persons[0]['text'] . '</a><br/>';

				// Andere personen uit de lijst komen onder gedeelte 'stars'
				echo 'Stars: ';
				for ( $i = 1; $i < ( sizeof($persons) - 1); $i++ ) {
					if ( $i != ( sizeof($persons) - 2) ) {
						echo '<a href="' . $persons[$i]['href'] . '" alt="" target="_blank">' . $persons[$i]['text'] . '</a>, ';
					} else {
						echo '<a href="' . $persons[$i]['href'] . '" alt="" target="_blank">' . $persons[$i]['text'] . '</a>.';
					}
				}

				echo '<br/>';
				echo '</div>
				';
			}
		}
		$counter++;
	}
}

?>

</div>
</body>
</html>