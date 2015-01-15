<?php function displayForm($genre, $type, $actor, $director, $minruntime, $maxruntime, $min_imdbrating, $max_imdbrating, $minrating, $maxrating, $minyear, $maxyear) { ?>
<form class="filter" action="" method="GET">

	<h2>Filter genre</h2>	
	<?php foreach ($genre as $genretype) { ?>
	  <?php if(in_array($genretype, $_GET['genre'], true)){ ?>
			<input type="checkbox" name="genre[]" id="genre" checked="checked" value="<?=$genretype?>"><?=$genretype?><br/>
    <?php } else { ?>
			<input type="checkbox" name="genre[]" id="genre" value="<?=$genretype?>"><?=$genretype?><br/>
		<?php } ?>
	<?php } ?>

	<h2>Filter movietypes</h2>
	<?php foreach ($type as $movietype) { ?>
    <?php if($_GET['type'] == $movietype){ ?>
  		<input type="radio" name="type" id="type" checked="checked" value="<?=$_GET['type']?>"><?=$_GET['type']?><br/>
    <?php } else { ?>
		  <input type="radio" name="type" id="type" value="<?=$movietype?>"><?=$movietype?><br/>
		<?php } ?>
	<?php } ?>

	<h2>Actorslist</h2>
	<select name="actors">
	<option value="">Choose an actor...</option>
	<?php foreach ($actor as $movieactor) {	?>
    <?php if($_GET['actors'] == $movieactor){ ?>
  		<option value="<?=$_GET['actors']?>" selected="selected"><?=$_GET['actors']?></option>
    <?php } else { ?>
			<option value="<?=$movieactor?>" ><?=$movieactor?></option>
		<?php } ?>
	<?php } ?>
	</select>

	<h2>Directorslist</h2>
	<select name="directors">
	<option value="">Choose a director...</option>
	<?php foreach ($director as $moviedirector) {	?>
    <?php if($_GET['directors'] == $moviedirector){ ?>
  		<option value="<?=$_GET['directors']?>" selected="selected"><?=$_GET['directors']?></option>
    <?php } else { ?>
			<option value="<?=$moviedirector?>" ><?=$moviedirector?></option>
		<?php } ?>
	<?php } ?>
	</select>

	<h2>Year range:</h2>
	<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
	<div id="slider-range"></div>
	<!-- Plaats min year -->
	<?php if($_GET['minyear'] == true){ ?>
		<input type="hidden" id="minyear" name="minyear" value="<?=$_GET['minyear']?>" />
  <?php } else { ?>
		<input type="hidden" id="minyear" name="minyear" value="<?=$minyear?>" />
	<?php } ?>

	<!-- Plaats max year -->
	<?php if($_GET['maxyear'] == true){ ?>
		<input type="hidden" id="maxyear" name="maxyear" value="<?=$_GET['maxyear']?>" />
  <?php } else { ?>
		<input type="hidden" id="maxyear" name="maxyear" value="<?=$maxyear?>" />
	<?php } ?>

	<h2>My rating:</h2>
	<input type="text" id="amount-2" readonly style="border:0; color:#f6931f; font-weight:bold;">
	<div id="slider-range-2"></div>
	<!-- Plaats min rating -->
	<?php if($_GET['minrating'] == true){ ?>
		<input type="hidden" id="minrating" name="minrating" value="<?=$_GET['minrating']?>" />
  <?php } else { ?>
		<input type="hidden" id="minrating" name="minrating" value="1" />
	<?php } ?>

	<!-- Plaats max rating -->
	<?php if($_GET['maxrating'] == true){ ?>
		<input type="hidden" id="maxrating" name="maxrating" value="<?=$_GET['maxrating']?>" />
  <?php } else { ?>
		<input type="hidden" id="maxrating" name="maxrating" value="10" />
	<?php } ?>

	<h2>IMDB rating:</h2>
	<input type="text" id="amount-3" readonly style="border:0; color:#f6931f; font-weight:bold;">
	<div id="slider-range-3"></div>
	<!-- Plaats min imdb rating -->
	<?php if($_GET['min_imdbrating'] == true){ ?>
		<input type="hidden" id="min_imdbrating" name="min_imdbrating" value="<?=$_GET['min_imdbrating']?>" />
  <?php } else { ?>
		<input type="hidden" id="min_imdbrating" name="min_imdbrating" value="1" />
	<?php } ?>

	<!-- Plaats max imdb rating -->
	<?php if($_GET['max_imdbrating'] == true){ ?>
		<input type="hidden" id="max_imdbrating" name="max_imdbrating" value="<?=$_GET['max_imdbrating']?>" />
  <?php } else { ?>
		<input type="hidden" id="max_imdbrating" name="max_imdbrating" value="10" />
	<?php } ?>

	<h2>Runtime in min</h2>
	<input type="text" id="amount-4" readonly style="border:0; color:#f6931f; font-weight:bold;">
	<div id="slider-range-4"></div>
	<!-- Plaats minruntime -->
	<?php if($_GET['minruntime'] == true){ ?>
		<input type="hidden" id="minruntime" name="minruntime" value="<?=$_GET['minruntime']?>" />
  <?php } else { ?>
		<input type="hidden" id="minruntime" name="minruntime" value="<?=$minruntime?>" />
	<?php } ?>

  <!-- Plaats maxruntime -->
	<?php if($_GET['maxruntime'] == true){ ?>
		<input type="hidden" id="maxruntime" name="maxruntime" value="<?=$_GET['maxruntime']?>" />
  <?php } else { ?>
		<input type="hidden" id="maxruntime" name="maxruntime" value="<?=$maxruntime?>" />
	<?php } ?>

	<input type="hidden" id="submitted" name="submitted" value="true" />
	<button type="submit" onclick="sendData()">Filter</button>

</form><br/>
<?php } ?>