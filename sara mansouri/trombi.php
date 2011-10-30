<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>

</head>
<body>
<?php
include"entete.php";
$feedURL="http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=fr";
$sxml=simplexml_load_file($feedURL);
 
echo"<table border='0' cellspacing='5'>";
$n=0;

 	  foreach ( $sxml->channel->item as $x ){
        $title = $x->title;
        $summary = $x->summary;
		

        $gphoto = $x->children('http://schemas.google.com/photos/2007');
        $size = $gphoto->size;
        $height = $gphoto->height;
        $width = $gphoto->width;

        $media = $x->children('http://search.yahoo.com/mrss/');
        $thumbnail = $media->group->thumbnail[1];
        $content = $media->group->content;
        $tags = $media->group->keywords;

      ?>
       <div id='imge'>
	   <td> <a title="<?php echo "$summary";?>" href="<? echo $content->attributes()->{'url'} ;?>"
		  <img src="<?php echo $thumbnail->attributes()->{'url'};?>" width="150" height="150" />
		  
         
     <?php echo $title;?>
	 </td>
	
	</div>
	 
	<?php $n++;
 if($n==6)
 {
 echo"</tr><tr>";
 $n=0;
 }
 ?>
    	  
  <?php }?>
  
  
	
</body>
</html>