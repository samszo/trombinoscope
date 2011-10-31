<html>
<head>
<title>Trombinoscope</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="photo.css" />

</head>
<body>
<div class="title">*************** TROMBINOSCOPE  THYP 11/12 ***************</div><br/>
 <?php
 //récuperation du flux rss
    $simple_xml = simplexml_load_file ( "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=en_US" );
	foreach ( $simple_xml->channel->item as $person ) {
		$tableau=split(", ",$person->title);
		$mail=$tableau[2];?>
			<div class="imge">
				<a href='mailto:<?php echo $mail;?>'><img src="<?php echo $person->enclosure['url'];?>" width="150" height="150" /></a>
				<div class="des">
					<?php echo $person->title; ?>
				</div>
			</div> 
	<?php } ?>
</body>
</html>