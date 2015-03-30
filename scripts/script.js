$( document ).ready(function() {
  $('.movie').fadeIn();
  $('.pagination').fadeIn();
});

$(function() {
  var movieId = 1;


  $('.md-trigger').click(function() {
    movieId = $(this).data('id');
    $.get("display_movieinfo.php", {movieID:movieId}, function(results) {
      if(results != "") {
        $('#modalwindow').show().html(results);
        console.log(movieId);
      } else {
        $('#modalwindow').hide();
      }
    });
  });
});

function getMovies(value) {
	$.get("search.php", {search:value}, function(results) {
		//If the input field is empty, hide results div
		if(value != ""){
			//If the data is null, show no results message
			if(results == "") {
				$('#results').stop(true,true).fadeIn(200).html("No results found. Please try again.");
			} else {
				$('#results').stop(true,true).fadeIn(200).html(results);
			}
		} else {
			$('#results').hide();
		}
	});
}

$(function() {
  $( "#slider-range" ).slider({
    range: true,
    min: lowest_year,
    max: highest_year,
    values: [ $('#minyear').val(), $('#maxyear').val() ],
    slide: function( event, year ) {
      $( "#amount" ).val( year.values[ 0 ] + " - " + year.values[ 1 ] );
    }
  });

  $( "#amount" )
    .val( 
    	$( "#slider-range" ).slider( "values", 0 ) + " - " + 
    	$( "#slider-range" ).slider( "values", 1 ) );
		yearvalues = $( "#slider-range" ).slider( "option", "values" );
});


$(function() {
  $( "#slider-range-2" ).slider({
    range: true,
    min: 1,
    max: 10,
    values: [ $('#minrating').val(), $('#maxrating').val() ],
    slide: function( event, year ) {
      $( "#amount-2" ).val( year.values[ 0 ] + " - " + year.values[ 1 ] );
    }
  });

  $( "#amount-2" )
    .val( 
    	$( "#slider-range-2" ).slider( "values", 0 ) + " - " + 
    	$( "#slider-range-2" ).slider( "values", 1 ) );
		ratingvalues = $( "#slider-range-2" ).slider( "option", "values" );
});


$(function() {
  $( "#slider-range-3" ).slider({
    range: true,
    min: 1,
    max: 10,
    values: [ $('#min_imdbrating').val(), $('#max_imdbrating').val() ],
    slide: function( event, year ) {
      $( "#amount-3" ).val( year.values[ 0 ] + " - " + year.values[ 1 ] );
    }
  });

  $( "#amount-3" )
    .val( 
    	$( "#slider-range-3" ).slider( "values", 0 ) + " - " + 
    	$( "#slider-range-3" ).slider( "values", 1 ) );
		imdbratingvalues = $( "#slider-range-3" ).slider( "option", "values" );
});


$(function() {
  $( "#slider-range-4" ).slider({
    range: true,
    min: minruntime,
    max: maxruntime,
    values: [ $('#minruntime').val(), $('#maxruntime').val() ],
    slide: function( event, year ) {
      $( "#amount-4" ).val( year.values[ 0 ] + " - " + year.values[ 1 ] );
    }
  });

  $( "#amount-4" )
    .val( 
    	$( "#slider-range-4" ).slider( "values", 0 ) + " - " + 
    	$( "#slider-range-4" ).slider( "values", 1 ) );
		runtimevalues = $( "#slider-range-4" ).slider( "option", "values" );
});


function sendData() { 
  $('#st-container').removeClass('st-menu-open');
  setTimeout( function() {
    $('#minyear').val(yearvalues[0]);
    $('#maxyear').val(yearvalues[1]);
    $('#minrating').val(ratingvalues[0]);
    $('#maxrating').val(ratingvalues[1]);
    $('#min_imdbrating').val(imdbratingvalues[0]);
    $('#max_imdbrating').val(imdbratingvalues[1]);
    $('#minruntime').val(runtimevalues[0]);
    $('#maxruntime').val(runtimevalues[1]);
  }, 100 );
}

$('#submitbutton').click(function(event){
  event.preventDefault();
    $('#st-container').removeClass('st-menu-open');
    $('.movie').fadeOut();
    $('.pagination').fadeOut();
    setTimeout( function() {
      $('#minyear').val(yearvalues[0]);
      $('#maxyear').val(yearvalues[1]);
      $('#minrating').val(ratingvalues[0]);
      $('#maxrating').val(ratingvalues[1]);
      $('#min_imdbrating').val(imdbratingvalues[0]);
      $('#max_imdbrating').val(imdbratingvalues[1]);
      $('#minruntime').val(runtimevalues[0]);
      $('#maxruntime').val(runtimevalues[1]);
      $('form').submit();
    }, 500 );
});

$('#resetbutton').click(function(event){
  event.preventDefault();
  $('#st-container').removeClass('st-menu-open');
  $('.movie').fadeOut();
  $('.pagination').fadeOut();
  setTimeout( function() {
    window.location.href = '/select.php';
  }, 500 );
});