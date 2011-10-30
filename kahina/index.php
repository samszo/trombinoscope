<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Trombinoscope Thyp 11/12</title>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	<link rel="stylesheet" href="css/page.css" media="screen">

	<!-- AnythingSlider -->
	<link rel="stylesheet" href="css/anythingslider.css">
	<script src="js/jquery.anythingslider.js"></script>

	<!-- Older IE stylesheet, to reposition navigation arrows, added AFTER the theme stylesheet above -->
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="css/anythingslider-ie.css" type="text/css" media="screen" />
	<![endif]-->
</head>

<body id="main">
<?php
// lecture d'un flux RSS 2.0 valide (ici celui du blog de LaMoooche...)
$handle = fopen("http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=fr", "rb");
// buffer contenant les données du flux
$flux = '';
// si la lecture du flux RSS est ok
if (isset($handle) && !empty($handle)) {
while (!feof($handle)) {
// on charge les données de notre flux RSS par paquet
$flux .= fread($handle, 4096);
}

// test avec la classe SimpleXML
// on construit notre parser RSS avec notre flux RSS
$RSS2Parser = simplexml_load_string($flux);
// on se positionne sur la balise (racine de notre flux RSS)
$racine = $RSS2Parser->channel;
// declaration des tableaux
$persons = array();
// pour chaque item
foreach($racine ->item as $element) {
// on récupère les différents attributs qui nous intéressent
$person['photo']=utf8_decode((string)$element->enclosure['url']);
// on transforme la chaine en tableau (  split() séparateur de chaine)
$var=split("[ \n]",utf8_decode((string)$element->title));
$person['name']=$var[0];
$last_element=end($var);
$person['name_suite']='';
if ($last_element==$var[1]){
$person['email']='';
$person['fname']=$var[1];
}
elseif ($last_element==$var[2]){
$person['email']=$var[2];
$person['fname']=$var[1];
}else{
$person['email']=$var[3];
$person['fname']=$var[1];
$person['name_suite']=$var[2];
}
array_push($persons,$person);
}	
}
fclose($handle);

?>
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
				navigationSize      : 1,     // Set this to the maximum number of visible navigation tabs; false to disable
				navigationFormatter : function(index, panel){ // Format navigation labels with text
					return [<?php foreach($persons as $nom){echo("'".$nom[name]."',");}?>][index - 1];
				},
				onSlideComplete: function(slider) {
					// keep the current navigation tab in view
					slider.navWindow( slider.currentPage );
				},
			});

		});
	</script>

 <div class="header">
 <h1>Trombinoscope</<h1>
 </div>
 
 
	<div id="page-wrap">
		<!-- AnythingSlider #2 -->
		<ul id="slider2">
		
		<?php	foreach($persons as $person){ 
			echo "
			<li class='panel1'>
				<div>
					<div class='textSlide'>
						<img src='$person[photo]' alt='' style='float: right; margin: 0 0 2px 10px;' width=200px; height=220px />
						<ul>
							$person[name]
							$person[fname]
							$person[name_suite]
							$person[email]
							<br><br><br><br><br><br><br><br><br><br><br><br>
						</ul>
					</div>
				</div>
			</li>";}
		?>
		</ul>
	</div><!-- END AnythingSlider #2 -->
	
	

<div class="listphoto">
<?php foreach($persons as $person) {echo ("<img src='$person[photo]' alt='' style='margin:3px' width=100px; height=100px />");}?>
</div>
	
</body>

</html>