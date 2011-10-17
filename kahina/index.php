<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">

	<title>AnythingSlider</title>
	<link rel="shortcut icon" href="demos/images/favicon.ico">
	<link rel="apple-touch-icon" href="demos/images/apple-touch-icon.png">

	<!-- jQuery (required) -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>

	<!-- Anything Slider optional plugins -->
	<script src="js/jquery.easing.1.2.js"></script>
	<!-- http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js -->
	<script src="js/swfobject.js"></script>

	<!-- Demo stuff -->
	<link rel="stylesheet" href="demos/css/page.css" media="screen">

	<!-- AnythingSlider -->
	<link rel="stylesheet" href="css/anythingslider.css">
	<script src="js/jquery.anythingslider.js"></script>

	<!-- AnythingSlider video extension; optional, but needed to control video pause/play -->
	<script src="js/jquery.anythingslider.video.js"></script>

	<!-- Ideally, add the stylesheet(s) you are going to use here,
	 otherwise they are loaded and appended to the <head> automatically and will over-ride the IE stylesheet below -->
	<link rel="stylesheet" href="css/theme-metallic.css">
	<link rel="stylesheet" href="css/theme-minimalist-round.css">
	<link rel="stylesheet" href="css/theme-minimalist-square.css">
	<link rel="stylesheet" href="css/theme-construction.css">
	<link rel="stylesheet" href="css/theme-cs-portfolio.css">

	<!-- Older IE stylesheet, to reposition navigation arrows, added AFTER the theme stylesheet above -->
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="css/anythingslider-ie.css" type="text/css" media="screen" />
	<![endif]-->

	<script>
		// Demo functions
		// **************
		$(function(){

			// External Link with callback function
			$("#slide-jump").click(function(){
				$('#slider2').anythingSlider(4, function(slider){ /* alert('Now on page ' + slider.currentPage); */ });
				return false;
			});

			// External Link
			$("a.muppet").click(function(){
				$('#slider1').anythingSlider(5);
				$(document).scrollTop(0); // make the page scroll to the top so you can watch the video
				return false;
			});

			// Report Events to console & features list
			$('#slider1, #slider2').bind('before_initialize initialized swf_completed slideshow_start slideshow_stop slideshow_paused slideshow_unpaused slide_init slide_begin slide_complete', function(e, slider){
				// show object ID + event (e.g. "slider1: slide_begin")
				var txt = slider.$el[0].id + ': ' + e.type + ', now on panel #' + slider.currentPage;
				$('#status').text(txt);
				if (window.console && window.console.firebug){ console.debug(txt); } // added window.console.firebug to make this work in Opera
			});

			// Theme Selector (This is really for demo purposes only)
			var themes = ['minimalist-round','minimalist-square','metallic','construction','cs-portfolio'];
			$('#currentTheme').change(function(){
				var theme = $(this).val();
				$('#slider1').closest('div.anythingSlider')
					.removeClass( $.map(themes, function(t){ return 'anythingSlider-' + t; }).join(' ') )
					.addClass('anythingSlider-' + theme);
				$('#slider1').anythingSlider(); // update slider - needed to fix navigation tabs
			});

			// Add a slide
			var imageNumber = 1;
			$('button.add').click(function(){
				$('#slider1')
					.append('<li><img src="demos/images/slide-tele-' + (++imageNumber%2 + 1)  + '.jpg" alt="" /></li>')
					.anythingSlider(); // update the slider
			});
			$('button.remove').click(function(){
				$('#slider1 > li:not(.cloned):last').remove();
				$('#slider1').anythingSlider(); // update the slider
			});

		});
	</script>

	<script>
		// Set up Sliders
		// **************
		$(function(){

			$('#slider1').anythingSlider({
				theme           : 'metallic',
				easing          : 'easeInOutBack',
//				autoPlayLocked  : true,  // If true, user changing slides will not stop the slideshow
//				resumeDelay     : 10000, // Resume slideshow after user interaction, only if autoplayLocked is true (in milliseconds).
				onSlideComplete : function(slider){
					// alert('Welcome to Slide #' + slider.currentPage);
				}
			});

			$('#slider2').anythingSlider({
				resizeContents      : false, // If true, solitary images/objects in the panel will expand to fit the viewport
				navigationSize      : 3,     // Set this to the maximum number of visible navigation tabs; false to disable
				navigationFormatter : function(index, panel){ // Format navigation labels with text
					return ['Recipe', 'Quote', 'Image', 'Quote #2', 'Image #2'][index - 1];
				},
				onSlideComplete: function(slider) {
					// keep the current navigation tab in view
					slider.navWindow( slider.currentPage );
				},
			});

		});
	</script>
</head>

<body id="main">
<?php
	if ($_POST){
		$target_path = "uploads/";
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))

		$list_photo = fopen("list_photo.txt", a);
		fputs($list_photo, "$target_path"); // on écrit le nom et email dans le fichier
		fputs($list_photo, "\n"); // on va a la ligne
		fclose($list_photo);
		}
$tableau = array();
$handle = @fopen("list_photo.txt", "r" );
if ($handle)
{
 while (!feof($handle))
    {
      $buffer = fgets($handle, 4096);
      $tableau[] = $buffer;
    }
    fclose($handle);
 }
 ?>
 <div class="header">
 <h1>Trombinoscope</<h1>
 </div>
 
 
	<div id="page-wrap">
		<!-- AnythingSlider #2 -->
		<ul id="slider2">
		
		<?php	for($i = 0; $i<sizeof($tableau)-1; $i++){
			echo "
			<li class='panel1'>
				<div>
					<div class='textSlide'>
						<img src='".$tableau[$i]."' alt='' style='float: right; margin: 0 0 2px 10px;' width=200px; height=220px />
						<h3></h3>
						<h4></h4>
						<ul>
						<br><br><br><br><br><br><br><br><br><br><br>
						</ul>
					</div>
				</div>
			</li>";}
		?>
		</ul>
	</div><!-- END AnythingSlider #2 -->
	
	<div class = form>
	<form enctype="multipart/form-data" action="index.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		Ajouter une photo: <input name="uploadedfile" type="file" /><br />
		Nom: <input name="nom" type="" style="margin-left:76px; margin-top:10px" /><br />
		Prénom: <input name="prenom" type="" style="margin-left:60px; margin-top:10px" /><br />
		Email: <input name="email" type="" style="margin-left:70px; margin-top:10px"/><br />
		<input type="submit" value="envoyer" style="margin-left:260px ;margin-top:10px" />
	</form>
	</div>

<div class="listphoto">
<?php for($i = 0; $i<sizeof($tableau)-1; $i++){echo"<img src='".$tableau[$i]."'alt='' style='margin:3px' width=100px; height=100px />";}?>
</div>
	
</body>

</html>