<html>
<head>
<title>ALA ATRASH PROJECT</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="photo.css" />

</head>
<body>
<div class="title">***************This is done by Ala ATRASH ***************</div><br/>
 <?php
 $simple_xml = simplexml_load_file ( "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=en_US" );
 foreach ( $simple_xml->channel->item as $x ) {
 ?>
<div class="imge"> 
    <img src="<?php echo $x->enclosure['url'];?>" width="150" height="150" />
    <div class="des">
     <?php echo $x->title;?>
    </div>
</div>    
<?php }?>
</body>
</html>