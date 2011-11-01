<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Trombinoscope</title>

</head>
<body>

<p align="center">
<table width='100%' bgcolor='black'>
<tr>
<td align='center'> <font size ='6' color="white" >
Tromboniscope <sub>thyp1112</sub> </font></td>
<td align='center'> <font  color="blue"></font></td><tr>
</table>

<?php

$feedURL= "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=fr";
$sxml=simplexml_load_file($feedURL);

     echo"<table border =5 align='center'>";
       $n=0;
 	  foreach ( $sxml->channel->item as $x )
	  {
        $title = $x->title;
	    $var = preg_split('/,/', $title);
 
        $gphoto = $x->children('http://schemas.google.com/photos/2007');
        $media = $x->children('http://search.yahoo.com/mrss/');
        $thumbnail = $media->group->thumbnail[1];
        $content = $media->group->content;
        
        
     
		echo"<div> <td> <a  href=\"".$content->attributes()->{'url'}."\">
                <img src=\"".$thumbnail->attributes()->{'url'}."\"  title=\"".$title."\"  ; hspace='17'; style='margin-bottom:5px;' border=\"2\""  ;
        echo "  width=\"".$thumbnail->attributes()->{'width'}."\" height=\"".$thumbnail->attributes()->{'height'}."\" "; 
		echo " </a>";
		
		echo @"<div style='width:150px;font-family:arial,sans-serif;font-size:13px;' >$var[0]  $var[1] <a href='mailto:$var[2]'>$var[2]</a></div>";
		
		  $n++;
		  if($n==5)
              {
                echo"</tr><tr>";
               $n=0;
              }
			 
      }
 ?>
 
</body>
</html>