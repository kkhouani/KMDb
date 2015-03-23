<?php include ("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<title>Khalid's Movie Database</title>
	<link rel="stylesheet" href="style/jquery-ui.css">
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="style/menu.css">
	<script src="scripts/modernizr.custom.js"></script>

</head>
<body>
<div id="st-container" class="st-container">

<?php

global $connection;


/* 					*/
/* INCLUDES */
/* 					*/

include ("get_data.php");
include ("filter_form.php");
include ("display_movies.php");
include ("display_movieinfo.php");

/* 					  */
/* PAGINATION */
/* 		INFO		*/


// $max_items = maximaal aantal items
// die op pagina getoond wordt
$max_items 	= 18;
$page	= 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
$startnumber = ($page - 1) * $max_items;
$query = "SELECT * FROM movieDatabase WHERE 1 "; 



/* 	    GET	    */
/*   FILTERING  */
/*      DATA    */


//check of er genre data is
if (isset($_GET['genre'])) {
	//check of er checkboxes zijn aangevinkt
	//update sessie met nieuwe genres in selectedgenres
	$selectedgenres = $_GET['genre'];
}

//checkt hoeveelheid aangevinkte genres en plaatst ze in de query
for ($i=0; $i < count($selectedgenres); $i++) { 
		$query .= " AND genre_movie LIKE '%".mysqli_real_escape_string($connection, $selectedgenres[$i])."%'"; 
}


//check of er movietype data is
if (isset($_GET['type'])) {
	//check of radio is aangevinkt
	//update sessie met nieuwe movietype in selectedtype
	$selectedtype = mysqli_real_escape_string($connection, $_GET['type']);
	// print_r($selectedtype);
	if(isset($selectedtype)) {
		$query .= " AND type_movie LIKE '%".$selectedtype."%'"; 
	}
}

//check of er actor data is
if (isset($_GET['actors'])) {
	//check of acteur is geselecteerd
	//update sessie met nieuwe acteur in selectedactor
	$selectedactor = mysqli_real_escape_string($connection, $_GET['actors']);
	// print_r($_GET['actors']);
	if(isset($selectedactor)) {
		$query .= " AND actors_movie LIKE '%".$selectedactor."%'"; 
	}
}

//check of er actor data is
if (isset($_GET['directors'])) {
	//check of acteur is geselecteerd
	//update sessie met nieuwe acteur in selectedactor
	$selecteddirector = mysqli_real_escape_string($connection, $_GET['directors']);
	// print_r($_GET['directors']);
	if(isset($selecteddirector)) {
		$query .= " AND director_movie LIKE '%".$selecteddirector."%'"; 
	}
}


//check of er jaartallen geselecteerd zijn
if (!empty($_GET['minyear']) && !empty($_GET['maxyear'])) {

	//check of slider is geselecteerd
	$minyear = mysqli_real_escape_string($connection, $_GET['minyear']); 
	$maxyear = mysqli_real_escape_string($connection, $_GET['maxyear']);
		//checkt jaartallen in de slider en plaatst ze in de query
	$query .= " AND year_movie >= '".$minyear."' AND year_movie <= '".$maxyear."'"; 
}


//check of userrating geselecteerd is
if (!empty($_GET['minrating']) && !empty($_GET['maxrating'])) {

	//check of slider is geselecteerd
	$minrating = mysqli_real_escape_string($connection, $_GET['minrating']); 
	$maxrating = mysqli_real_escape_string($connection, $_GET['maxrating']);
		//checkt jaartallen in de slider en plaatst ze in de query
	$query .= " AND user_rating >= ".$minrating." AND user_rating <= ".$maxrating.""; 
}


//check of userrating geselecteerd is
if (!empty($_GET['min_imdbrating']) && !empty($_GET['max_imdbrating'])) {

	//check of slider is geselecteerd
	$min_imdbrating = mysqli_real_escape_string($connection, $_GET['min_imdbrating']); 
	$max_imdbrating = mysqli_real_escape_string($connection, $_GET['max_imdbrating']);

	//checkt jaartallen in de slider en plaatst ze in de query
	$query .= " AND imdb_rating >= ".$min_imdbrating." AND imdb_rating <= ".$max_imdbrating.""; 
}

//check of runtime geselecteerd is
if (!empty($_GET['minruntime']) && !empty($_GET['maxruntime'])) {

	//check of slider is geselecteerd
	$minruntime = mysqli_real_escape_string($connection, $_GET['minruntime']); 
	$maxruntime = mysqli_real_escape_string($connection, $_GET['maxruntime']);

	//checkt runtime in de slider en plaatst ze in de query
	$query .= " AND runtime_movie >= ".$minruntime." AND runtime_movie <= ".$maxruntime.""; 
}

/* 					   */
/*  SHOW FORM  */
/* 		    		 */

?>

	<nav class="st-menu st-effect-2" id="menu-2">
		<?php 
			// get form data vanuit get_data.php
			$data = getFormData();

			// verzend data naar filter_form.php
			displayForm(
				$data['genre'], 
				$data['type'], 
				$data['actor'], 
				$data['director'], 
				$data['minruntime'], 
				$data['maxruntime'], 
				$data['imdb_lowest_rating'], 
				$data['imdb_highest_rating'], 
				$data['minrating'], 
				$data['maxrating'], 
				$data['lowest_year'], 
				$data['highest_year']
			);
		?>

		<div class="inner-wrap">
			<input id="search" type="text" name="search" onkeyup="getMovies(this.value)" placeholder="Search movie" />
			<div id="results"></div>
		</div>
	</nav>
		
	<div class="st-pusher">
		<div class="st-content">
			<div class="st-content-inner"><!-- extra div for emulating position:fixed of the menu -->
				<div class="main clearfix">

					<!-- Button for the Menu -->
					<div id="st-trigger-effects" class="column">
						<button data-effect="st-effect-2">MENU</button>
					</div>

					<?php
			
/* 				     */
/*    SHOW     */
/* 	 MOVIES    */ 			

						$sql = $query . " ORDER BY date_id DESC LIMIT $startnumber, $max_items";
						$result = mysqli_query($connection, $sql);
						$khalidsrating = $data['minrating'];

						if($result === false){
							echo mysqli_error($connection);
						}

						echo "<div class='movies'>";
							if (mysqli_num_rows($result) > 0) {
							    // output data of each row
							    while($row = mysqli_fetch_assoc($result)) {
							    	displayMovie($row);
							    }
							} else {
							    echo "0 results";
							}
						echo "</div>";


/* 					  */
/* PAGINATION */
/* 		    		*/


						$result = mysqli_query($connection, $query);
						$row_count = mysqli_num_rows($result);
						$num_of_pages = ceil($row_count/$max_items); 
						$currentPage = isset ($_GET["page"]) ? $_GET["page"] : 1;

						$query = "";
						foreach ($_GET as $key => $value) {
							if ($key != 'page') {
								if ($key != 'genre') {
									$query = $query . "&". $key . "=" . $value;
								}	else {
									for ($i=0; $i < count($value); $i++) { 
										$query = $query . "&". $key . "%5B%5D=" . $value[$i]; 
									}
								}
							}
						}

						if ($num_of_pages > 1) {
							echo '<div class="pagination">';
							echo '<a href="/select.php?page=1'.$query.'" class="pagination_item first">First</a>';
								for ($i = 1; $i <= $num_of_pages; $i++) { 
									if ($i >= $currentPage - 2 && $i <= $currentPage + 2) {
										if ($i == $currentPage) {
											echo '<a href="#" class="pagination_item active">' . $i .' </a>';
										} else {
											echo '<a href="/select.php?page='.$i.''.$query.'" class="pagination_item">'.$i.' </a>';
										}
									}
								}
							echo '<a href="/select.php?page='.$num_of_pages.''.$query.'" class="pagination_item last">Last</a>';
							echo '</div>';
						} 
					?>

				</div>
			</div>
		</div>
	</div>

	<?php

	/* 				     */
	/*    SHOW     */
	/* 	MOVIEINFO	 */ 			

	$sql = "SELECT id FROM movieDatabase";
	$result = mysqli_query($connection, $sql);

	if($result === false){
		echo mysqli_error($connection);
	}

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {	
   	$movieid = $row['id'] ?>
      <div class="md-modal md-effect" id="modal-<?=$movieid?>">
	      <?displayMovieInfo($movieid);?>
			</div> <?php
		} 
	} ?>

	<div class="md-overlay"></div><!-- the overlay element -->

</div>




<?php
/* 					  */
/* 	   END  	*/
/* CONNECTION */

// sluit connectie
mysqli_close($connection);

?>
<script type="text/javascript">
	var lowest_year = <?php echo $data['lowest_year'] ?>;
	var highest_year = <?php echo $data['highest_year'] ?>;
	var imdb_lowest_rating = <?php echo $data['imdb_lowest_rating'] ?>;
	var imdb_highest_rating = <?php echo $data['imdb_highest_rating'] ?>;
	var minruntime = <?php echo $data['minruntime'] ?>;
	var maxruntime = <?php echo $data['maxruntime'] ?>;
	var yearvalues = [];
	var test_min;
	var ratingvalues = [];
	var imdbratingvalues = [];
</script>
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/classie.js"></script>
<script src="scripts/sidebarEffects.js"></script>
<script src="scripts/modalEffects.js"></script>
<script src="scripts/script.js"></script>
</body>
</html>