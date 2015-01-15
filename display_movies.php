<?php function displayMovie($row) {	?>

  <div class="movie">
		<img class="movieposter" src="<?=$row['image_movie']?>" width="50px"/>
		<div class="movieinfo">
			<h2><a href="<?=$row['url_movie']?>" alt="" target="_blank"><?=$row['title_movie']?></a></h2><br/>
	<?php /*		<?='"'.$row['description_movie'].'"'?><br/><br/>
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
			<br/> */ ?>
		</div>
	</div>
<?php } ?>