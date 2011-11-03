<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Mater 2 THYP</title>
<link rel="stylesheet" href="main.css" />
</head>
<body>
<?php

$fluxrss="http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=fr";
$rss=simplexml_load_file($fluxrss);
 

          foreach ( $rss->channel->item as $x ){
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

      
        echo"<div id='slideshow'>";
        echo " <a title=\"".$summary."\" rel=\"lightbox[999]\" href=\"".$content->attributes()->{'url'}."\">";
        echo " <img src=\"".$thumbnail->attributes()->{'url'}."\" border=\"0\" ";
        echo "  width=\"".$thumbnail->attributes()->{'width'}."\" height=\"".$thumbnail->attributes()->{'height'}."\" "; 
                  
       echo "  alt=\"".$summary."\"  title=\"".$summary."\" />";
        echo " </a>";
                
        echo"</div>";
                 echo "$x->title";
                
                 
                 
      }
    ?>
 
</body>
</html>