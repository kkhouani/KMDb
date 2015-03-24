<?php
	
	include ("connection.php");

	global $connection;

	$movieid = 1;

	$movieid = mysqli_real_escape_string($connection, $_GET['movieid']);

	$sql = "SELECT * FROM movieDatabase WHERE id LIKE $movieid";
	$result = mysqli_query($connection, $sql);

  echo '<div class="md-modal md-effect" id="modal-'.$movieid.'">';
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {	?> 
      <div class="md-content">	
				<div class="movieinfo clearfix">
					<div class="image">
						<img src="<?=$row['image_movie']?>" alt="<?=$row['title_movie']?>">
					</div>	
					<div class="text">	
						<h2><a href="<?=$row['url_movie']?>" alt="" target="_blank"><?=$row['title_movie']?></a></h2>
						<?='"'.$row['description_movie'].'"'?><br/><br/>
						Directed by <?=$row['director_movie']?><br/>
						Cast: <?=$row['actors_movie']?><br/>
						<br/>
						Movietype: <?=$row['type_movie']?><br/>
						Genre: <?=$row['genre_movie']?><br/>
						Runtime: <?=$row['runtime_movie']?><br/>
						Year: <?=$row['year_movie']?><br/>
						<br/>
						My rating: <?=$row['user_rating']?><br/>
						iMDB rating: <?=$row['imdb_rating']?><br/>
						<br/> 
					</div>

					<div class="icons">
						<button class="md-close">Close</button>
					</div>
				</div>
			</div> <?
		} 
	}
	echo '</div>'; 
?>