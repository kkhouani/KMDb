<?php function displayMovie($row) {	
  $description_movie = preg_replace('/\s+?(\S+)?$/', '', substr($row['description_movie'], 0, 70));
?>

  <div class="movie">
		<div class="overlay">
			<a class="caption caption-3" href="<?=$row['url_movie']?>" data-title="<?=$row['title_movie']?>" data-description="<?=$description_movie?>">
				<img src="<?=$row['image_movie']?>" alt="<?=$row['title_movie']?>">
			</a>
		</div>
	</div>

		<?php /*	<div class="movieinfo">
			<h2><a href="<?=$row['url_movie']?>" alt="" target="_blank"><?=$row['title_movie']?></a></h2><br/>
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
			Rated <?=$row['date_rating']?><br/>
			<br/> 
		</div> 
	</div> */ ?>
<?php } ?>