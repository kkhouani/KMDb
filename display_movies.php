<?php function displayMovie($row) {	
  $description_movie = preg_replace('/\s+?(\S+)?$/', '', substr($row['description_movie'], 0, 70));
  $title_movie = substr($row['title_movie'], 0, 50);
?>

  <div class="movie">
		<div class="overlay">
			<div class="caption caption-3" data-title="<?=$title_movie?>" data-description="<?=$description_movie?>">
				<div class="myrating"><?=$row['user_rating']?></div>
				<img class="movieposter md-trigger" data-modal="modal-<?=$row['id']?>" src="<?=$row['image_movie']?>" alt="<?=$row['title_movie']?>">
			</div>
		</div>
	</div>

<?php } ?>