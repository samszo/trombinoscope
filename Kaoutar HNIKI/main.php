<?php 

$url = 'http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=fr';
$xml = simplexml_load_file($url);
 

foreach($xml->channel->item as $item) {
?>
    <img src="<?php echo $item->enclosure ['url'];?>" width="100" height="100" align="middle" /> 
	
<p style="font-family:Arial, Helvetica, sans-serif; text-align:left"><?php 
$a=$item->title;
// on transforme la chaine en tableau 
$array=explode(",",$a);
echo $array[0]; 
echo $array[1];
echo $array[2];
?>

<form action="contact.php" method="get"> 
<input type="submit" value="Envoyer un message"/>
<input type="hidden" value="<?php echo $array[2] ?>" name="ar"/>
</form>
 
</p>
<?php
}?>

