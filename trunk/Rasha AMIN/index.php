<?php
// Data retrieval
$user = 'thyp1112@gmail.com';
$album_title = 'Trombinoscope';
// the feed URLs from where album and photo information will be fetched
$album_feed = 'http://picasaweb.google.com/data/feed/api/user/' . $user . '?v=2';
$photo_feed = 'http://picasaweb.google.com/data/feed/api/user/' . $user . '/albumid/';
// read album feed into a SimpleXML object
$albums = simplexml_load_file($album_feed);
$result = array();
foreach ($albums->entry as $album):
	if ($album->title == $album_title):
		// get the number of photos for this album
		$photocount = (int) $album->children('http://schemas.google.com/photos/2007')->numphotos;
		// get the ID of the current album
		$album_id = $album->children('http://schemas.google.com/photos/2007')->id;
		// read photo feed for this album into a SimpleXML object
		$photos = simplexml_load_file($photo_feed . $album_id . '?v=2');
		foreach ($photos->entry as $photo):
			$temp = array();
			// get the photo and thumbnail information
			$media = $photo->children('http://search.yahoo.com/mrss/');
			// full image information
			$group_content = $media->group->content;
			$temp['summary'] = $photo->summary;
			$temp['full_url'] = $group_content->attributes()->{'url'};
			$temp['full_width'] = $group_content->attributes()->{'width'};
			$temp['full_height'] = $group_content->attributes()->{'height'};
			// thumbnail information, get the 3rd (=biggest) thumbnail version
			// change the [2] to [0] or [1] to get smaller thumbnails
			$group_thumbnail = $media->group->thumbnail[2];
			$temp['thumbnail_url'] = $group_thumbnail->attributes()->{'url'};
			$temp['thumbnail_width'] = $group_thumbnail->attributes()->{'width'};
			$temp['thumbnail_height'] = $group_thumbnail->attributes()->{'height'};

			$result[] = $temp;
		endforeach;
	endif;
endforeach;

// Send Email
if (@$_POST['sltDestination']):
	$header  = '';
	$header .= 'From: "' . $user . '" <' . $user . ">\r\n";
	$header .= 'Reply-To: "' . $user . '" <' . $user . ">\r\n";
	$header .= "X-Mailer: PHP/" . phpversion();
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-type: text/html; charset=utf-8";

	$sent = @mail($_POST['sltDestination'], @$_POST['txtSubject'], @$_POST['txtMessage'], $header);
	if ($sent)
		echo "Votre message a ete envoye avec succes";
	else
		echo "Votre message n'a pas pu etre envoye";
endif;
?>
<html>
<head>
	<title>Trombinoscope - Rasha</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="galleria-1.2.5.js" type="text/javascript"></script>
	<script src="theme/galleria.classic.js"></script>
</head>
<body>
	<div id="main">
		<div id="gallery" style="margin: 5px; float: left;">
			<?php foreach ($result as $item): ?>
			<?php @list($first_name, $last_name, $email) = explode(',', $item['summary']); ?>
			<a href="<?php echo $item['full_url']; ?>"><img src="<?php echo $item['thumbnail_url']; ?>" alt="<?php echo implode(' ', array($first_name, $last_name)); ?>" title="<?php echo implode(' ', array($first_name, $last_name)); ?>"></a>
			<?php endforeach; ?>
		</div>
		<script type="text/javascript">
		    $('#gallery').galleria({
		        width:500,
		        height:500
		    });
		</script>
		<div id="form" style="width: 500px; margin: 5px; float: left;">
			<form id="contact_form" name="contact_form" method="post" action="">
				<label for="sltDestination">Destination:</label>
				<select id="sltDestination" name="sltDestination">
				<?php foreach ($result as $item): ?>
				<?php @list($first_name, $last_name, $email) = explode(',', $item['summary']); ?>
					<?php if ($email): ?>
					<option value="<?php echo $email; ?>"><?php echo implode(' ', array($first_name, $last_name, '('.$email.')')); ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
				</select>
				<div style="clear: both;"></div>
				<label for="txtSubject">Sujet:</label>
				<input type="text" id="txtSubject" name="txtSubject" size="20" />
				<div style="clear: both;"></div>
				<label for="txtMessage">Message:</label>
				<textarea id="txtMessage" name="txtMessage" cols="40" rows="10"></textarea>
				<div style="clear: both;"></div>
				<button type="submit">Envoyer</button>
			</form>
		</div>
		<style>
			form label {				float: left;				width: 100px;			}
			form input, form select, form textarea {				float: left;			}
		</style>
	</div>
</body>
</html>
