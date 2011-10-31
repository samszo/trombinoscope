<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>

</head>
<body>
<?php
include"entete.php";
$feedURL= "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=fr";
$sxml=simplexml_load_file($feedURL);
 echo"<table border =2>";
$n=0;
 	  foreach ( $sxml->channel->item as $x ){
         $title = $x->title;
	 
		

        $gphoto = $x->children('http://schemas.google.com/photos/2007');
        $size = $gphoto->size;
        $height = $gphoto->height;
        $width = $gphoto->width;

        $media = $x->children('http://search.yahoo.com/mrss/');
        $thumbnail = $media->group->thumbnail[1];
        $content = $media->group->content;
        $tags = $media->group->keywords;
         //$var=split("[ \n]",utf8_decode($x->title));
      
        echo"<div id='slideshow'>";
		
		
		echo"<td> <a rel=\"lightbox[999]\" href=\"".$content->attributes()->{'url'}."\">
           <img src=\"".$thumbnail->attributes()->{'url'}."\"   title=\"".$title."\"   style='margin-bottom:15px;' border=\"2\" ";
        echo "  width=\"".$thumbnail->attributes()->{'width'}."\" height=\"".$thumbnail->attributes()->{'height'}."\" "; 
		  
   
        echo " <td> </a>";
	echo "<div style='width:150px;font-family:arial,sans-serif;font-size:13px;' > $title";
		 $n++;
		 if($n==4)
              {
            echo"</tr><tr>";
               $n=0;
                }
			 
      }
    ?>
 
</body>
</html>